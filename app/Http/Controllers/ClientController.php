<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Resources\ClientResource;
use App\Models\Client;
class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::get();
        if($clients->count()>0){
            return ClientResource::collection($clients);
        }else{
            return response()->json(['message'=>'No record available'],200);

        }
    }
}
