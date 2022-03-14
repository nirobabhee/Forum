<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index()
    {
        $pageTitle = "Referral Manage";
        $referral = Referral::orderBy('id', 'desc')->first();
        return view('admin.referral.index', compact('referral','pageTitle'));
    }
    public function update(Request $request)
    {
        $referral = Referral::first();
        $request->validate([
            'point' => 'required',
        ]);
        $referral->point = $request->point;
        $referral->save();
        $notify[] = ['success', ' Point updated'];
        return redirect()->back()->withNotify($notify);
    }

}
