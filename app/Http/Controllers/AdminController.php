<?php

namespace App\Http\Controllers;

use App\File;
use App\Group;
use App\Http\Resources\GroupResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return json_encode(GroupResource::collection(Group::all()));
        //return view('admin/index');
    }

    public function deleteGroup(Request $request)
    {
        $data = request();
        $grupo = Group::find($data["id"]);
        $grupo->delete();
        return json_encode(GroupResource::collection(Group::all()));
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

        return json_encode(GroupResource::collection(Group::all()));
    }

    public function deleteFile(Request $request)
    {
        $data = request();
        $archivo = File::find($data["id"]);
        $archivo->delete();
        return json_encode(GroupResource::collection(Group::all()));
        //return view('admin/index');
    }

    public function download(File $file)
    {
        return Storage::download($file->ruta);
    }
}
