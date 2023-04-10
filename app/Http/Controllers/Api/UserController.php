<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    // function to get all user
    public function index()
    {
        $users = User::all();
        return response()->json([
            'status'=>true,
            'users'=>$users
        ]);
    }

    // function create_user

    // function to show user
    public function show(Request $request)
    {
        $user =User::findOrFail($request->id);
        return response()->json([
            'status'=>true,
            'user'=>$user
        ]);
    }

    // function to update user
    public function update(Request $request ,$id)
    {
          $request->validate( [
            'name'          => 'required',
            'email'         => 'email|max:255|unique:users,email',
            'phone'        => 'numeric|nullable',
        ]);
        $user = User::findOrFail($id);
            $user->update(
                [
                    'name'=>$request->name ? $request->name : $user->name,
                    'email'=>$request->email ? $request->email : $user->email,
                    'phone'=>$request->phone ? $request->phon :$user->phone,
                ]
                );

                return response()->json([
                    'status'=>true,
                    'data'=>$user,
                    'message' => 'User Updated Successfully',
                ]);
    }


    // function to delete user
    public function delete(Request $request)
    {
        $user = User::where('id', $request->id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'User deleted Successfully',
        ]);
    }

    // function to change_password
    public function change_password(Request $request , $id)
    {
          $request->validate([
            'current_password'  => 'required',
            'password'          => 'required|confirmed'
        ]);

        $user = User::findOrFail($id);
        if (Hash::check($request->current_password, $user->password)) {
            $update = $user->update([
                'password' => bcrypt($request->password),
            ]);

            if ($update) {
                return response()->json([
                    'status' => true,
                    'message' => 'User cahnge_password  Successfully',
                ], 200);
            }


        }
    }
}

