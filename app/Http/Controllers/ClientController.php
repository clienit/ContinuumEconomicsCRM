<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use App\Http\Requests\StoreClient;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::latest()->paginate(10);

        return $clients;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClient $request)
    {
        $requestData = $request->all();

        if($request->hasFile('avatar'))
        {
            // Get image file
            $image = $request->file('avatar');
            // Upload image
            $path = $this->uploadFile($image);
            // Update request data image path
            $requestData['avatar'] = $path;
        }

        Client::create($requestData);

        return response()->json('Client created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClient $request, Client $client)
    {
        $requestData = $request->all();

        if($request->hasFile('avatar'))
        {
            // Get image file
            $image = $request->file('avatar');
            // Upload image
            $path = $this->uploadFile($image);
            // Update request data image path
            $requestData['avatar'] = $path;
        }

        $client->update($requestData);
  
        return response()->json('Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json('Client deleted successfully');
    }
}
