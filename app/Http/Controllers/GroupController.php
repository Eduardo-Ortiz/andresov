<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //



    public function index($ruta)
    {
        $grupo =  Group::where('direccion','=',$ruta)->first();


        return view('group',compact('grupo'));
    }
}
