<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\GeneralSetting;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function create()
    {
        $pageTitle = 'Create Post';
        $categories = Category::with('subcategories')->whereHas('subcategories', function ($subcategories) {
            $subcategories->where('status', 1);
        })->where('status', 1)->get();
        return view($this->activeTemplate . 'user.post.create', compact('pageTitle', 'categories'));
    }

    public function store(Request $request)
    {
        $this->validation($request);

        $user = auth()->user();
        $general = GeneralSetting::first();
        if ($user->point < $general->post_point) {
            $notify[] = ['error', 'You don\'t have sufficient point'];
            return back()->withNotify($notify);
        }

        $user->point -= $general->post_point;
        $user->save();

        $post = new Post();
        $post->user_id = $user->id;
        $this->savePost($post, $request);

        $notify[] = ['success', 'Post created successfully'];
        return redirect()->route('user.home')->withNotify($notify);
    }


    public function update(Request $request, $id)
    {
        $this->validation($request);

        $post =  Post::findOrFail($id);

        $this->savePost($post, $request);

        $notify[] = ['success', 'Post updated successfully'];
        return redirect()->route('user.home')->withNotify($notify);
    }

    protected function savePost($post, $request)
    {
        $post->category_id = $request->category;
        $post->sub_category_id = $request->subcategory;
        $post->title = $request->title;
        $post->tags = $request->tags;
        $post->description = $request->description;
        $post->save();
    }


    protected function validation($request)
    {
        $request->validate([
            'category'      => 'required|exists:categories,id',
            'subcategory'   => 'nullable|exists:sub_categories,id',
            'tags'          => 'required|array|min:1',
            'tags.*'        => 'string|max:40',
            'title'         => 'required|string|max:255',
            'description'   => 'required|string'
        ]);
    }

    public function switchStatus(Request $request)
    {
        $post = Post::where('user_id', auth()->id())->findOrFail($request->id);

        if($post->status) {
            $post->status = 0;
            $notify[] = ['success', 'Post deactivated successfully'];
        } else {
            $post->status = 1;
            $notify[] = ['success', 'Post activated successfully'];
        }

        $post->save();
        return back()->withNotify($notify);
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Thread';
        $post = Post::findOrFail($id);
        $categories = Category::with('subcategories')
        ->whereHas('subcategories', function ($subcategories) {
            $subcategories->where('status', 1);
        })
        ->where('status', 1)
        ->get();
        return view($this->activeTemplate . 'user.post.edit', compact('pageTitle', 'categories', 'post'));
    }


    //Post-Related-Comment//
    public function comment(Request $request)
    {
        $request->validate([
            'comment' => 'required|max:255',
            'post' => 'required|numeric',
        ]);

        $post = Post::findOrFail($request->post);

        $comment = new Comment();
        $comment->post_id = $request->post;
        $comment->user_id = auth()->user()->id;
        $comment->comment = $request->comment;
        $comment->save();

        $user = auth()->user();
        $general = GeneralSetting::first();

        if ($comment->user_id != $post->user_id) {
            $user->point +=  $general->comment_point;
            $user->save();
        }

        $comments = Comment::where('post_id', $comment->post_id)->where('user_id', '!=', $comment->user_id)->with('user')->groupBy('user_id')->get();
        foreach ($comments as $user_email) {
            $email = $user_email->user->email;
            notify($user_email->user, 'POST_COMMENT', [
                'comment_user' => $user->username,
                'get_email_users' =>  $email,
            ]);
        }
        $notify[] = ['success', ' Comment stored'];
        return back()->withNotify($notify);
    }
}
