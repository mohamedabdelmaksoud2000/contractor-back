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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'status'=>true,
            'users'=>$users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {

        $data['name'] =$request->name ;
        $data['email'] =$request->email;
        $data[ 'phone']=$request->phone ;
        $data['birth_day'] =$request->birth_day ? $request->birth_day : Carbon::now();

        if ($user_image = $request->file('image'))
        {
                $filename = Str::slug($request->name).'.'.$user_image->getClientOriginalExtension();
                $path = public_path('storage/user_image/'. $filename);
                Image::make($user_image->getRealPath())->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $data['image']  = $filename;
        }
        $user= User::create($data);
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'user' => $user,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user =User::findOrFail($request->id)->get();
        return response()->json([
            'status'=>true,
            'user'=>$user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

                if ($user_image = $request->file('image'))
                {
                        if ($user->image != '')
                        {
                            if (File::exists('storage/image_user/' . $user->image))
                            {
                                unlink('storage/image_user/' .$user->image);
                            }
                        }
                        $filename = Str::slug($request->name).'.'.$user_image->getClientOriginalExtension();
                        $path = public_path('storage/image_user/'. $filename);
                        Image::make($user_image->getRealPath())->resize(300, 300, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($path, 100);
                        $data['image']  = $filename;
                }

            }
                $user->update($data);

                return response()->json([
                    'status'=>true,
                    'data'=>$user,
                    'message' => 'User Updated Successfully',
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
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
