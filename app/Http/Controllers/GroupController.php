<?php

namespace App\Http\Controllers;

use App\Download;
use App\File;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GroupController extends Controller
{
    //

    public function index($ruta)
    {
        $grupo =  Group::where('direccion','=',$ruta)->first();
        return view('group',compact('grupo'));
    }

    public function download(File $file)
    {
        $download = new Download();
        $download->ip =  request()->ip();
        $download->file_id = $file->id;
        $download->save();

        return Storage::download($file->ruta);
    }

    public function code(Request $request)
    {
        $data = request();

        $grupo = Group::where('direccion', '=', $data["codigo"])->first();

        if(!is_null($grupo))
        {
            return ['redirect' => url('/'.$data["codigo"])];
        }
        else
        {
            $request->session()->flash('error', 'El codigo ingresado no coincide con ningún grupo, verifíquelo e intente de nuevo.');
            return ['redirect' => url('/')];
        }
    }
}
