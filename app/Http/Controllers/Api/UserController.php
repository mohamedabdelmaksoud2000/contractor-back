<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json([
            'status'=>true,
            'users'=>$users
        ]);
    }

    public function store(StoreUserRequest $request)
    {

        $data['name'] =$request->name ;
        $data['email'] =$request->email;
        $data[ 'phone']=$request->phone ;
        $data['birth_day'] =$request->birth_day ? $request->birth_day : Carbon::now();
        $data['password']= bcrypt($request->password);
        if($request->file('image'))
        {
            $image_user=$request->file('image')->store('user_image','public');
            $data['image'] = $image_user;
        }

        $user= User::create($data);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'user' => $user,
            ]);
    }


    public function show(Request $request)
    {
        $user =User::with(['employee'])->findOrFail($request->id);
        return response()->json([
            'status'=>true,
            'user'=>$user,
        ]);
    }

    public function update(Request $request)
    {
        //

        $user = User::findOrFail($request->id);
            if($user)
            {
                $data['name'] = $request->name ? $request->name : $user->name;
                $data['email'] =$request->email ? $request->email : $user->email;
                $data[ 'phone']=$request->phone ? $request->phon :$user->phone ;
                $data['birth_day'] =$request->birth_day ? $request->birth_day : Carbon::now();

                if ($request->file('image'))
                {
                        if ($user->image != '')
                        {
                            if (File::exists('storage/user_image/' . $user->image))
                            {
                                unlink('storage/user_image/' .$user->image);
                            }
                        }

                        $image_user=$request->file('image')->store('user_image','public');
                        $data['image'] = $image_user;

                }

            }

            $user->update($data);
                return response()->json([
                    'status'=>true,
                    'data'=>$user,
                    'message' => 'User Updated Successfully',
                ]);
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'User deleted Successfully',
        ]);
    }

    // function to change_password
    public function change_password(Request $request)
    {
        $request->validate([
            'current_password'  => 'required',
            'password'          => 'required|confirmed'
        ]);

        $user = User::findOrFail($request->id);
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
