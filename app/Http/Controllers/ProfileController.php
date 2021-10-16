<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('auth.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10',
            'profile' => 'mimes:jpg,jpeg,png',
        ]);

        $user = User::find(Auth::user()->id);
        $filename = $user->profile;
        $prev_image_path = public_path('profile/user_images/').$filename;


        if (request()->hasFile('profile')) {
            if($filename != ''){
                unlink($prev_image_path);
            }
            $file = request()->file('profile');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('profile/user_images/', $filename);
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->profile = $filename;
        $user->save();
        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }
}
