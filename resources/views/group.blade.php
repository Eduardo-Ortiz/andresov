@extends('layouts.master')

@section('content')

    <div id="app">
        <h1 class="title is-3">{{$grupo->nombre}} - {{$grupo->materia}}</h1>
    </div>

    <table  class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" style="margin-top: 15px">
    <thead>
    <tr>
        <th style="width: 1px !important;text-align: center">#</th>
        <th style="min-width: 200px">Archivo</th>
        <th style="width: 1px !important">Fecha</th>
        <th style="width: 1px !important">Tipo</th>
        <th style="width: 1px !important;">Descargar</th>
    </tr>
    </thead>
    <tbody>

    @foreach($grupo->files as $indexKey => $file)
        <tr>
            <td style="padding-top: 14px"><span >{{$indexKey+1}}</span></td>
            <td style="padding-top: 14px">{{$file->nombre}}</td>
            <td style="padding-top: 14px">{{$file->created_at->format('d/m/Y')}}</td>
            <td>
                @if($file->extension==="docx"||$file->extension==="doc")
                    <img style="margin-top: 5px" src="{{URL::asset('images/doc.png')}}" width="35" alt="Word">
                @elseif($file->extension==="pdf")
                    <img style="margin-top: 5px" src="{{URL::asset('images/pdf.png')}}" width="35" alt="PDF">
                @elseif($file->extension==="xlsx"||$file->extension==="xls")
                    <img style="margin-top: 5px" src="{{URL::asset('images/xls.png')}}" width="35" alt="Excel">
                @endif
            </td>
            <td style="padding-top: 8px">
                <a class="button is-black" href="{{route('descargar', $file->id)}}">
                    <span>Descargar</span>
                    <span class="icon">
                        <i class="fas fa-file-download"></i>
                    </span>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>

@stop

@section('footer')

@stop