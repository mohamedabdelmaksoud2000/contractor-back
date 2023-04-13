<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfessionRequest;
use App\Http\Requests\UpdateProfessionRequest;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professions = Profession::all();
        return response()->json($professions);
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
    public function store(StoreProfessionRequest $request)
    {
        $data['name'] = $request->name ;
        $data['describe'] = $request->describe ;
        $data['company_id'] = $request->company_id ;

            $profession_image = $request->file('image')->store('profession_image','public');
            $data['image']  =$profession_image;

         $profession = Profession::create($data);
         return response()->json([
            'status'=>true,
            'date' =>$profession,
            'message' => 'Profession  Added Successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $profession = Profession::findOrFail($request->id);
        return response()->json($profession);
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
    public function update(UpdateProfessionRequest $request, $id)
    {    $profession = Profession::findOrFail($id);
        if($profession)
        {
            $data['name'] = $request->name ? $request->name : $profession->name;
            $data['describe'] = $request->describe ? $request->describe : $profession->describe ;
            $data['company_id'] = $request->company_id ?$request->company_id : $profession->company_id ;

            if ($request->file('image'))
            {
               if ($profession->image != '')
               {
                   if (File::exists('storage/profession_image/' . $profession->image))
                    {
                       unlink('storage/profession_image/' . $profession->image);
                   }
               }
               $profession_image = $request->file('image')->store('$profession_image','public');
               $data['image']  =$profession_image;
            }

            $profession->update($data);
            return response()->json([
                'status'=>true,
                'data' => $profession,
                'message' => '$profession Updated Successfully',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Profession::where('id' , $request->id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Profession deleted Successfully',
        ]);
    }
}
