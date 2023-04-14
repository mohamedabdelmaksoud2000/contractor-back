<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
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
    public function store(StoreItemRequest $request)
    {
        $data['name'] = $request->name ;
        $data['type'] = $request->type ;
        $data['describe'] = $request->describe ;
        $data['price'] = $request->price ;
        $data['company_id'] = $request->company_id ;

            $item_image = $request->file('image')->store('item_image','public');
            $data['image']  =$item_image;

         $item = Item::create($data);
         return response()->json([
            'status'=>true,
            'date' =>$item,
            'message' => 'Item  Added Successfully',
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
        $item = Item::findOrFail($request->id);
        return response()->json($item);
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
    public function update(UpdateItemRequest $request, $id)
    {
        $item = Item::findOrFail($id);
        if($item)
        {
            $data['name'] = $request->name ? $request->name : $item->name;
            $data['type'] = $request->type ? $request->type : $item->type ;
            $data['describe'] = $request->describe ? $request->describe : $item->describe ;
            $data['price'] = $request->price ? $request->price : $item->price ;
            $data['company_id'] = $request->company_id ?$request->company_id : $item->company_id ;

            if ($request->file('image'))
            {
               if ($item->image != '')
               {
                   if (File::exists('storage/item_image/' . $item->image))
                    {
                       unlink('storage/item_image/' . $item->image);
                   }
               }
               $item_image = $request->file('image')->store('item_image','public');
               $data['image']  =$item_image;
            }

            $item->update($data);
            return response()->json([
                'status'=>true,
                'data' => $item,
                'message' => 'Item Updated Successfully',
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
       $item= Item::where('id' , $request->id)->delete();
       if ($item) {
        return response()->json([
            'status'=>true,
            'message' => 'Item deleted Successfully',
        ]);
       }
       else
       {
        return response()->json([
            'status'=>false,
            'message' => ' Error Item not deleted',
        ]);
       }


    }
}
