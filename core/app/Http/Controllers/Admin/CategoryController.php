<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Forum;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $pageTitle = 'Category List';
        $forums = Forum::orderBy('id', 'DESC')->where('status', 1)->get();
        $emptyMessage = 'No category create yet.';
        $categories = Category::orderBy('id', 'desc')->with('forum')->paginate(getPaginate());
        return view('admin.category.index', compact('pageTitle', 'emptyMessage', 'categories', 'forums'));
    }
    public function Store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'fourm' => 'required',
                'icon' => 'required',
            ]
        );
        $CategoryCreate = Category::where('name', $request->name)->first();
        if ($CategoryCreate) {
            $notify[] = ['error', 'Category already exist, Please try new one!'];
            return back()->withNotify($notify);
        }
        $CategoryCreate = new Category();
        $CategoryCreate->forum_id = $request->fourm;
        $CategoryCreate->name = $request->name;
        $CategoryCreate->icon = $request->icon;
        $CategoryCreate->status =  1;
        $CategoryCreate->save();
        $notify[] = ['success', $CategoryCreate->name . ' Category has been added.'];
        return back()->withNotify($notify);
    }
    public function update(Request $request, $id)
    {

        $categoryUpdate = Category::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'fourm' => 'required',
            'icon' => 'required',
        ]);
        $categoryUpdate->forum_id = $request->fourm;
        $categoryUpdate->name = $request->name;
        $categoryUpdate->icon = $request->icon;
        $categoryUpdate->status = $request->status ? 1 : 0;
        $categoryUpdate->save();

        $notify[] = ['success', $categoryUpdate->name . ' Category has been updated'];
        return redirect()->back()->withNotify($notify);
    }
}
