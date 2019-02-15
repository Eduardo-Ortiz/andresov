<?php

namespace App\Http\Controllers;

use App\File;
use App\Group;
use App\Http\Resources\GroupResource;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $grupos =  GroupResource::collection(Group::all());


        return view('admin/index',compact('grupos'));
    }

    public function storeGroup(Request $request)
    {
        $data = request();
        $user = new Group();
        $user->nombre = $data["nombre"];
        $user->materia = $data["materia"];
        $user->direccion = $data["direccion"];
        $user->save();
        //$request->session()->flash('success', 'Acceso <b> '.$user->username.'</b> creado correctamente');
        return ['redirect' => route('admin')];
        //return view('admin/index');
    }

    public function storeFile(Request $request)
    {
        $data = request();
        $file = new File();
        $file->nombre = $data["nombre"];
        $file->group_id = $data["group_id"];

        $file->extension =  strtolower($request->file('archivo')->clientExtension());

        $path = $request->file('archivo')->storeAs(
            'public/archivos', $file->group_id."-".$file->nombre.".". $file->extension
        );

        $file->ruta = $path;

        $file->save();
    }
}
