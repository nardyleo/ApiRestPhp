<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

class ClientsController extends Controller
{
    // utlizamos javascript
    public function index(){
       return son_response()->make(Client::all());
               // return Client::all(); // colection do eloquent, laravel transforma pra json
    }

    public function show($id){
        if(!($client = Client::find($id))){
            throw new ModelNotFoundException("Cliente requisitado não existe");
        }
        return son_response()->make($client);
    }


    public function store(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);
        
        $client = Client::create($request->all());
        return son_response()->make($client,201);
    }

    public function update(Request $request,$id){
        if(!($client = Client::find($id))){
            throw new ModelNotFoundException("Cliente requisitado não existe");
        }

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        $client->fill($request->all());
        $client->save();
        return son_response()->make($client,200);
    }

    public function destroy($id){
        if(!($client = Client::find($id))){
            throw new ModelNotFoundException("Cliente requisitado não existe");
        }
        $client->delete();
        return son_response()->make("",204);
    }


}
