<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
//        dd(auth()->user()->role);
        if(!auth()->user()->role == 'admin'){
            return abort(404);
        }

        if($request->isMethod('post')){

            if($request->has('reject')){
                $user = User::findOrFail($request->user_id);
                $user->status = 'rejected';
                $user->save();
            }else if($request->has('accept')){
                $user = User::findOrFail($request->user_id);
                $user->status = 'accept';
                $user->save();
            }

            return back();
        }
        $users = User::where('id', '!=', auth()->id())->get();
        return view('pages.admin.users', compact('users'));
    }
}
