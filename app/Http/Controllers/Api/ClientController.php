<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->all());
        return response()->json($client);
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        return response()->json($client);
    }

    public function update(Request $request,$id)
    {
        $client = Client::find($id);
        if($client)
        {
            $data['first_name']  = $request->first_name ? $request->first_name : $client->first_name;
            $data['last_name']  = $request->last_name ? $request->last_name : $client->last_name;
            $data['name_company']  = $request->name_company ? $request->name_company : $client->name_company;
            $data['phone']  =$request->phone ? $request->phone : $client->phone;
            $data['email'] =$request->email ? $request->email : $client->email;
            $data['link_webiste']   =$request->link_webiste;
            $data['link_facebook']    =$request->link_facebook;
            $data[ 'link_twitter' ]        =$request->link_twitter;
            $data[ 'link_youtube' ]      =$request->link_youtube;
            $data['link_linkedin']    =$request->link_linkedin;
            $data['address_1' ]    = $request->address_1 ? $request->address_1 : $client->address_1;
            $data['address_2' ]      = $request->address_2 ? $request->address_2 : $client->address_2;
            $data['country' ]         =$request->country ? $request->country : $client->country;
            $data['governorate']      =$request->governorate ? $request->governorate : $client->governorate;
            $data[ 'city']          =$request->city ? $request->city : $client->city;
            $data['zip_code' ]        = $request->zip_code ? $request->zip_code : $client->zip_code;
        
            $client->update($data);
            return response()->json($client);
        }
        else
        {
            return response()->json('no found client');
        }
    }


    public function destroy($id)
    {
        $client = Client::destroy($id);
        return response()->json('deleted client successfully');
    }
}
