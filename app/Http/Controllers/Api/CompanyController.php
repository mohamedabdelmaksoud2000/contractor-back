<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class CompanyController extends Controller
{
    //

    public function index()
    {
        $company = Company::all();
        return response()->json($company);
    }

    public function store(Request $request)
    {
        $request->validate( [
            'name'          => 'required|max:100',
            'logo'          =>'image|max:20000,mimes:jpeg,jpg,png,svg|max:2048',
            'phone'         => 'required|numeric',
            'email'          => 'email|max:255|unique:companies,email',
            'link_website'   =>'nullable|url',
            'link_facebook'    =>'nullable|url',
            'link_twitter'      =>'nullable|url',
            'link_youtube'       =>'nullable|url',
            'link_linkedin'      =>'nullable|url',
            'address_1'         =>'required|string|max:255',
            'address_2'          =>'nullable|string|max:255',
            'country'            =>'required|string|max:30',
            'governorate'       =>'required|string|max:30',
            'city'              =>'required|string|max:30',
            'zip_code'          =>'required|max:25',
        ]);

         $data['name']               =$request->name;
            $data['phone']             =$request->phone;
            $data['email']              =$request->email;
            $data['link_website' ]      =$request->link_website;
            $data['link_facebook']       =$request->link_facebook;
            $data[ 'link_twitter' ]      =$request->link_twitter;
            $data[ 'link_youtube' ]       =$request->link_youtube;
            $data['link_linkedin']       =$request->link_linkdin;
            $data['address_1' ]          =$request->address_1;
            $data['address_2' ]          =$request->address_2;
            $data[  'country' ]           =$request->country;
            $data['governorate']       =$request->governorate;
            $data[ 'city'    ]           =$request->city;
            $data['zip_code' ]          =$request->zip_code;
            $data['user_id'  ]          = auth()->user()->id;

            if ($logo_image = $request->file('logo')) {
                $filename = Str::slug($request->name).'.'.$logo_image->getClientOriginalExtension();
                $path = public_path('storage/logo/'. $filename);
                Image::make($logo_image->getRealPath())->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $data['logo']  = $filename;
            }

            $company=Company::create($data);
            return response()->json([
                'status'=>true,

                'message' => 'Company Information Added Successfully',
            ]);

    }




    public function update(Request $request ,$id)
    {
        $request->validate( [
            'name'          => 'max:100',
            'logo'          =>'image|max:20000,mimes:jpeg,jpg,png,svg|max:2048',
            'phone'         => 'numeric',
            'email'          => 'email|max:255|unique:companies,email',
            'link_website'   =>'nullable|url',
            'link_facebook'    =>'nullable|url',
            'link_twitter'      =>'nullable|url',
            'link_youtube'       =>'nullable|url',
            'link_linkedin'      =>'nullable|url',
            'address_1'         =>'string|max:255',
            'address_2'          =>'nullable|string|max:255',
            'country'            =>'string|max:30',
            'governorate'       =>'string|max:30',
            'city'              =>'string|max:30',
            'zip_code'          =>'max:25',
        ]);
        $company = Company::findOrFail($id);
        if($company)
        {
            $data['name']  = $request->name ? $request->name : $company->name;
            $data['phone']  =$request->phone ? $request->phone : $company->phone;
            $data['email'] =$request->email ? $request->email : $company->email;
            $data['link_website' ]   =$request->link_website;
            $data['link_facebook']    =$request->link_facebook;
            $data[ 'link_twitter' ]        =$request->link_twitter;
            $data[ 'link_youtube' ]      =$request->link_youtube;
            $data['link_linkedin']    =$request->link_linkedin;
            $data['address_1' ]    = $request->address_1 ? $request->address_1 : $company->address_1;
            $data['address_2' ]      = $request->address_2;
            $data['country' ]         =$request->country ? $request->country : $company->country;
            $data['governorate']      =$request->governorate ? $request->governorate : $company->governorate;
            $data[ 'city']   =$request->city ? $request->city : $company->city;
            $data['zip_code' ]        = $request->zip_code ? $request->zip_code : $company->zip_code;
           $data['user_id'  ]      = auth()->user()->id;
           if ($logo_image = $request->file('logo'))
           {
              if ($company->logo != '')
              {
                  if (File::exists('storage/logo/' . $company->logo))
                   {
                      unlink('storage/logo/' . $company->logo);
                  }
              }
              $filename = Str::slug($request->name).'.'.$logo_image->getClientOriginalExtension();
              $path = public_path('storage/logo/'. $filename);
              Image::make($logo_image->getRealPath())->resize(300, 300, function ($constraint) {
                  $constraint->aspectRatio();
              })->save($path, 100);
              $data['logo']  = $filename;
           }
               $company->update($data);
           return response()->json([
               'status'=>true,
               'data' => $company,
               'message' => 'Company Information Updated Successfully',
           ]);
        }
    }

    public function show(Request $request)
    {
        $company = Company::findOrFail($request->id);
        return response()->json($company);
    }

    public function delete(Request $request)
    {
         Company::where('id' ,$request->id)->delete();
            return response()->json([
            'status'=>true,
            'message' => 'Company Information deleted Successfully',
        ]);
    }

}
