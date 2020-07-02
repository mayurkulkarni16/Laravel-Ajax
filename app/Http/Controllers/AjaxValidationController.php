<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AjaxValidationController extends Controller
{
    public function FormAjaxValidation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'image' => 'required|image'
        ]);

        if ($validator->passes()) {
            $request->file('image')->storeAs(
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
            return response()->json(['success'=>'Added new records.']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function UpdatePage()
    {
        $users = User::all();
        return view('ajax_update', compact('users'));
    }

    public function GetUser(Request $request)
    {
        return User::find($request->id);
    }

    public function ShowDelete()
    {
        $users = User::all();
        return view('ajax_delete', compact('users'));
    }

    public function DeleteUser(Request $request)
    {
//        User::destroy($request->user);
        $user = User::find($request->user);
        $name = $user->first_name."_".$user->last_name.".jpg";
        Storage::disk('public')->delete("/avatars/".$name);
        $user->delete();
        return response()->json(['success'=>'Successfully deleted the record.']);
    }
}
