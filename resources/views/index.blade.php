@extends('layouts.master')

@section('content')

    @if(Session::has('error'))
        <div class="notification is-danger">
            <button onclick="dimiss(this)" class="delete"></button>
            <i class="fas fa-times-circle"></i> {!! session('error') !!}
        </div>
    @endif

    <div id="app">

        <form>
            <div style="text-align: center">
                <img src="{{URL::asset('images/logo_big.png')}}" width="250" alt="Conalep">
                <hr>
                <h1 class="title is-4">Ingresa el codigo de tu grupo:</h1>
                <div class="columns">
                    <div class="column is-4 is-offset-4">
                        <div class="control">
                            <input v-model="codigo" style="text-align: center;font-size: 20px" class="input is-hovered" type="text" placeholder="Escribe el codigo de tu grupo aquí">
                        </div>
                    </div>
                </div>
                <div class="columns" style="margin-top: -25px">
                    <div class="column is-4 is-offset-4">
                        <button type="submit" class="button is-medium is-fullwidth is-black" v-on:click="enviarCodigo()">
                            <span>Ingresar</span>
                            <span class="icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </span>
                        </button>
                    </div>
                </div>
                <hr>
            </div>
        </form>
    </div>

@stop

@section('footer')
    <script type="text/javascript" src="{{URL::asset('js/axios.min.js')}}"></script>

    <script>
        const app = new Vue({
            el: '#app',
            data: {
                codigo : null
            },
            methods: {
                enviarCodigo : function () {
                    event.preventDefault();
                    axios.post('<?php echo route('group_code') ?>', {
                        codigo : app.codigo
                    }).then(function (response) {
                        window.location = response.data.redirect;
                    });
                },
            },
        })
    </script>
@stop