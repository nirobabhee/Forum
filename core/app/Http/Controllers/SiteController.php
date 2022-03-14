<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\Category;
use App\Models\Forum;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Page;
use App\Models\Post;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\UpdownLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $reference = @$_GET['reference'];

        if ($reference) {
            session()->put('reference', $reference);
        }

        $pageTitle = 'Home';
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->firstOrFail();
        $emptyMessage = 'No Forum Post';

        $forums = Forum::with([
            'categories',
            'categories.posts','categories.posts.user'])

        ->WhereHas('categories', function ($categories) {
            $categories->where('status', 1)->whereHas('posts', function ($posts) {
                $posts->where('status', 1);
            });
        })->orderBy('id', 'DESC')->where('status', 1)->paginate(getPaginate());
        return view($this->activeTemplate . 'home', compact('pageTitle', 'sections', 'forums', 'emptyMessage'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);
        $pageTitle = 'Search';
        $emptyMessage = 'No data found';
        $search =  $request->input('search');
        $posts = Post::with('user', 'comments')->where('status', 1)
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orderBy('id', 'DESC')->paginate(getPaginate());
        return view($this->activeTemplate . 'search_posts', compact('posts', 'pageTitle', 'emptyMessage'));
    }

    public function postsForum($id)
    {
        $pageTitle = 'Forum Posts';
        $emptyMessage = 'No Forum Posts';
        $forums = Forum::with('categories.posts.user', 'categories.posts.comments')->where('id', $id)->whereHas('categories.posts', function ($query) {
            $query->where('status', 1);
        })->get();
        return view($this->activeTemplate . 'forum_posts', compact('pageTitle', 'forums', 'emptyMessage'));
    }

    public function postsCategory($id)
    {
        $pageTitle = 'Category Posts';
        $emptyMessage = "No Category Post";
        $categories = Category::with('posts.user', 'posts.comments')->where('id', $id)->whereHas('posts', function ($query) {
            $query->where('status', 1);
        })->paginate(getPaginate());
        return view($this->activeTemplate . 'category_posts', compact('pageTitle', 'categories', 'emptyMessage'));
    }

    public function postDetails($id)
    {
        $pageTitle  = 'Post Details';
        $post       = Post::where('id', $id)->with('comments.user', 'category', 'forum', 'user')->firstOrFail();

        if (Auth::id() != $post->user_id) {

            if($id != session('post_view_id')){
                session()->put('post_view_id', $id);
                $post->increment('view');
            }
        }

        return view($this->activeTemplate . 'post_details', compact('pageTitle', 'post'));
    }

    public function pages($slug)
    {
        $page = Page::where('tempname', $this->activeTemplate)->where('slug', $slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
    }

    public function forum()
    {
        $pageTitle = "Forum";
        $emptyMessage = "No forum post";
        $posts = Post::orderBy('id', 'DESC')->where('status', 1)->with('comments', 'user', 'category.forum')->paginate(getPaginate());
        return view($this->activeTemplate . 'forum', compact('pageTitle', 'posts', 'emptyMessage'));
    }
    public function user($id)
    {
        $pageTitle = "Post User Profile";
        $user = User::where('id', $id)->firstOrFail();
        return view($this->activeTemplate . 'profile_bio', compact('pageTitle', 'user'));
    }
    public function userPosts($id)
    {
        $pageTitle = "Post User Profile";
        $emptyMessage = 'No Data Found';
        $user = User::where('id', $id)->firstOrFail();
        $posts = Post::orderBy('id', 'DESC')->where('user_id', $id)->with('category.forum', 'comments', 'user')->paginate(getPaginate());
        return view($this->activeTemplate . 'user_posts', compact('pageTitle', 'emptyMessage', 'posts', 'user'));
    }
    public function userAnswered($id)
    {
        $pageTitle = "Post User Answered";
        $emptyMessage = 'No Data Found';
        $user = User::where('id', $id)->firstOrFail();

          $posts = Post::orderBy('id', 'DESC')->with('category.forum', 'comments', 'user')->whereHas(
            'comments',
            function ($comments) use ($id) {
                $comments->where('user_id', $id);
            }
        )->paginate(getPaginate());
        return view($this->activeTemplate . 'answered', compact('pageTitle', 'emptyMessage', 'posts', 'user'));
    }

    public function userUpVote($id)
    {
        $pageTitle = "Post User Up Vote";
        $emptyMessage = 'No Data Found';
        $user = User::where('id', $id)->firstOrFail();
        $upVotes = UpdownLog::where('user_id', $id)->where('up_vote', '!=', 0)->with('post.category.forum', 'post.comments', 'post.user')->paginate(getPaginate());

        return view($this->activeTemplate . 'up_vote', compact('pageTitle', 'emptyMessage', 'upVotes', 'user'));
    }
    public function userDownVote($id)
    {
        $pageTitle = "Post User Down Vote";
        $emptyMessage = 'No Data Found';
        $user = User::where('id', $id)->firstOrFail();
        $downVotes = UpdownLog::where('user_id', $id)->where('up_vote', '!=', 1)->with('post.category.forum', 'post.comments','post.user')->paginate(getPaginate());

        return view($this->activeTemplate . 'down_vote', compact('pageTitle', 'emptyMessage', 'downVotes', 'user'));
    }

    public function contact()
    {
        $pageTitle = "Contact";
        return view($this->activeTemplate . 'contact', compact('pageTitle'));
    }

    public function contactSubmit(Request $request)
    {

        $attachments = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');

        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);

        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;

        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'ticket created successfully!'];

        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function blogDetails($id, $slug)
    {
        $blog = Frontend::where('id', $id)->where('data_keys', 'blog.element')->firstOrFail();
        $pageTitle = $blog->data_values->title;
        return view($this->activeTemplate . 'blog_details', compact('blog', 'pageTitle'));
    }
    public function policyPage($id, $slug)
    {
        $policyPage    = Frontend::where('id', $id)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $pageTitle = $policyPage->data_values->title;
        return view($this->activeTemplate . 'policy_page', compact('policyPage', 'pageTitle'));
    }
    public function cookieAccept()
    {
        session()->put('cookie_accepted', true);
        $notify[] = ['success', 'Cookie accepted successfully'];
        return back()->withNotify($notify);
    }

    public function placeholderImage($size = null)
    {
        $imgWidth = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }
}
