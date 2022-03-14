<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $pageTitle = 'Forum List';
        $emptyMessage = 'No forum created yet';
        $forums = Forum::orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.forum.index', compact('pageTitle', 'emptyMessage', 'forums'));
    }
    public function Store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'icon' => 'required',
            ]
        );
        $forumCreate = Forum::where('name', $request->name)->first();
        if ($forumCreate) {
            $notify[] = ['error', 'Forum already exist, Please try new one!'];
            return back()->withNotify($notify);
        }
        $forumCreate = new Forum();
        $forumCreate->name = $request->name;
        $forumCreate->icon = $request->icon;
        $forumCreate->save();
        $notify[] = ['success', $forumCreate->name . ' Forum has been added.'];
        return back()->withNotify($notify);
    }
    public function update(Request $request, $id)
    {
        $forumUpdate = Forum::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
        ]);
        $forumUpdate->name = $request->name;
        $forumUpdate->icon = $request->icon;
        $forumUpdate->status = $request->status ? 1 : 0;
        $forumUpdate->save();

        $notify[] = ['success', $forumUpdate->name . ' Forum has been updated'];
        return redirect()->back()->withNotify($notify);
    }
}
