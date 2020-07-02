<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FormValidationController extends Controller
{
    public function FormValidation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'profile_image' => 'required|image|mimes:jpg,jpeg'
        ]);

        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }

        $request->file('profile_image')->storeAs(
            '/public/avatars', $request->first_name . "_" . $request->last_name . ".jpg"
        );

        User::updateOrCreate([
            'email'   => $request->email,
        ],[
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'profile_image' => $request->first_name . "_" . $request->last_name,
        ]);
        return view('welcome');
    }

    public function UpdatePage()
    {
        $users = User::all();
        return view('edit', compact('users'));
    }

    public function GetUser(Request $request)
    {
//        dd($request);
//        dd(User::find($request->user));
        $user = User::find($request->user);
        return view('edit_user', compact('user'));
    }

    public function ShowDelete()
    {
        $users = User::all();
        return view('delete_user', compact('users'));
    }

    public function DeleteUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required'
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
//        User::destroy($request->user);
        $user = User::find($request->user);
        $name = $user->first_name."_".$user->last_name.".jpg";
        Storage::disk('public')->delete("/avatars/".$name);
        $user->delete();
        return redirect(route('delete-user-show'));
    }

}
