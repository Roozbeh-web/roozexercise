<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Requests\CustomRequest;
use DateTime;

class UserController extends Controller
{
    
    public function index(CustomRequest $request)
    {
        $name = $request->name;
        $now = new DateTime(Date("y-m-d"));
        $birthdate = new DateTime($request->age);
        $age = $now->diff($birthdate);

        return view("users", ["name"=>$name, "age"=>$age->y]);
    }

    public function download(Request $request){
        if($request->has("key") && $request->key == 1){
            $file = storage_path("app/public/Document - Roozbeh Kamalzadeh - 2022-07-27.pdf");
            return response()->download($file);
        }
        else{
            return redirect()->route("home", ["msg"=>"no cheating!"]);
        }
    }

    public function show(Request $request){
        if($request->has("key") && $request->key == 1){
            $file = storage_path("app/public/Document - Roozbeh Kamalzadeh - 2022-07-27.pdf");
            return response()->file($file);
        }
        else{
            return redirect()->route("home", ["msg"=>"no cheating!"]);
        }
    }

}
