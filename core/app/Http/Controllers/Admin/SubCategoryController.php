<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $pageTitle = 'Sub-Category List';
        $emptyMessage = 'No create sub category yet.';
        $categories = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $subCategories = SubCategory::orderBy('id', 'desc')->with('category')->paginate(getPaginate());
        return view('admin.category.sub_category', compact('pageTitle', 'emptyMessage', 'subCategories', 'categories'));
    }
    public function Store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'category' => 'required',
                'icon' => 'required',
            ]
        );
        $subCategoryCreate = SubCategory::where('name', $request->name)->first();
        if ($subCategoryCreate) {
            $notify[] = ['error', 'Subcategory already exist, Please try new one!'];
            return back()->withNotify($notify);
        }
        $subCategoryCreate = new SubCategory();
        $subCategoryCreate->name = $request->name;
        $subCategoryCreate->category_id = $request->category;
        $subCategoryCreate->status = 1;
        $subCategoryCreate->icon = $request->icon;
        $subCategoryCreate->save();
        $notify[] = ['success', $subCategoryCreate->name . ' Subcategory has been added.'];
        return back()->withNotify($notify);
    }
    public function update(Request $request, $id)
    {
        $subCategoryUpdate = SubCategory::findOrFail($id);
        $request->validate([
            'name' => 'required',
                'category' => 'required',
                'icon' => 'required',
        ]);
        $subCategoryUpdate->name = $request->name;
        $subCategoryUpdate->category_id = $request->category;
        $subCategoryUpdate->icon = $request->icon;
        $subCategoryUpdate->status = $request->status ? 1 : 0;
        $subCategoryUpdate->save();
        $notify[] = ['success', $subCategoryUpdate->name . ' Sub Category has been updated'];
        return redirect()->back()->withNotify($notify);
    }
}
