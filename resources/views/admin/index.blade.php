@extends('layouts.master')

@section('content')

    <div id="app">
        <h1 class="title is-3">Panel de Administrador</h1>
        <a class="button is-medium is-fullwidth" v-on:click="crearGrupo=true">Crear Nuevo Grupo</a>

        <hr>


        <div class="modal"  v-bind:class="{'is-active': crearGrupo }">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Crear Nuevo Grupo</p>
                    <button class="delete" aria-label="close" v-on:click="crearGrupo=false"></button>
                </header>
                <section class="modal-card-body">
                    <div class="content">

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Nombre:</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input v-model="nombreGrupo" class="input" type="text" placeholder="Nombre del Grupo">
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Materia:</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input v-model="materiaGrupo" class="input" type="text" placeholder="Materia del Grupo">
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Enlace:</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input v-model="direccionGrupo" class="input" type="text" placeholder="Dirección publica">
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button v-bind:class="{ 'is-loading': cargandoGrupos }" class="button is-black" v-on:click="guardarGrupo()">Crear Grupo</button>
                    <button class="button" v-on:click="crearGrupo=false">Cancelar</button>
                </footer>
            </div>
        </div>


        <div class="modal"  v-bind:class="{'is-active': subirArchivo }">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Subir Archivo</p>
                    <button class="delete" aria-label="close" v-on:click="subirArchivo=false"></button>
                </header>
                <section class="modal-card-body">
                    <div class="content">

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Grupo:</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input v-model="grupoArchivo" disabled class="input" type="text" placeholder="Nombre del Grupo">
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="file has-name is-fullwidth">
                            <label class="file-label">
                                <input class="file-input" type="file" name="archivo" v-model="file" id="archivo">
                                <span class="file-cta">
                                  <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                  </span>
                                  <span class="file-label">
                                    Buscar…
                                  </span>
                                </span>
                                <span class="file-name">
                                  @{{file}}
                                </span>
                            </label>
                        </div>

                        <div class="field is-horizontal" style="margin-top: 12px">
                            <div class="field-label is-normal">
                                <label class="label">Nombre:</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input v-model="nombreArchivo" class="input" type="text" placeholder="Nombre del archivo">
                                    </p>
                                </div>
                            </div>
                        </div>


                        <div class="field is-horizontal" style="margin-top: 12px">
                            <div class="field-label is-normal">
                                <label class="label">Paginas:</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <input v-model="nombreArchivo" class="input" type="text" placeholder="Desde" style="width: 80px;text-align: center">
                                    <input v-model="nombreArchivo" class="input" type="text" placeholder="Hasta" style="width: 80px">
                                </div>

                            </div>
                        </div>

                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button v-bind:class="{ 'is-loading': cargandoGrupos }" class="button is-black" v-on:click="guardarArchivo()">Crear Grupo</button>
                    <button class="button" v-on:click="subirArchivo=false">Cancelar</button>
                </footer>
            </div>
        </div>



            <template v-for="(value, index) in datosGrupos">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Grupo: @{{value.nombre}} - @{{value.materia}}
                        </p>
                        <a href="#" class="card-header-icon" aria-label="more options">
      <span class="icon" v-on:click="datosGrupos[index].expandido=true">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span>
                        </a>
                    </header>
                    <div class="card-content" v-show="value.expandido==true">
                        <div class="content">
                            <button class="button is-pulled-left" v-on:click="modalArchivo(index)">Subir Archivo</button>
                            <button class="button is-pulled-right">Eliminar</button>
                            <button class="button is-pulled-right" style="margin-right: 10px">Limpiar</button>

                            <div class="is-clearfix">

                            </div>

                            <table  class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" style="margin-top: 15px">
                                <thead>
                                <tr>
                                    <th style="width: 1px !important">#</th>
                                    <th style="min-width: 200px">Archivo</th>
                                    <th style="min-width: 200px">Extension</th>
                                    <th style="min-width: 200px">Descargas</th>
                                    <th style="width: 25px">Ver</th>
                                    <th style="width: 25px">Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(user,index) in users">
                                    <td>@{{user.id}}</td>
                                </tr>
                                </tbody>
                            </table>




                        </div>
                    </div>
                </div>
            </template>











    </div>


@stop

@section('footer')


    <script type="text/javascript" src="{{URL::asset('js/axios.min.js')}}"></script>



    <script>
        var grupos = <?php echo json_encode($grupos) ?>;

        const app = new Vue({
            el: '#app',
            data: {

                datosGrupos : [],

                crearGrupo : false,
                cargandoGrupos : false,

                subirArchivo : false,
                grupoArchivo : null,
                grupoSelect : 0,
                nombreArchivo : null,

                file : null,

                nombreGrupo : null,
                materiaGrupo : null,
                direccionGrupo : null
            },
            methods: {
                guardarGrupo : function () {

                    axios.post('<?php echo route('groups_store') ?>', {
                        nombre : app.nombreGrupo,
                        materia : app.materiaGrupo,
                        direccion : app.direccionGrupo
                    }).then(function (response) {
                        window.location = response.data.redirect;
                    });
                },

                guardarArchivo : function () {
                    var archivo = document.getElementById('archivo').files[0];


                    var data = new FormData();
                    var settings = { headers: { 'content-type': 'multipart/form-data' } };

                    data.append('archivo', archivo);
                    data.append('nombre', this.nombreArchivo);
                    data.append('group_id', this.datosGrupos[app.grupoSelect].id);

                    axios.post('<?php echo route('files_store') ?>', data,settings).
                    then(function (response) {
                       // window.location = response.data.redirect;
                    });
                },

                modalArchivo : function (index)
                {
                    this.grupoSelect = index;
                    this.subirArchivo = true;
                    this.grupoArchivo = this.datosGrupos[index].nombre + " - "+ this.datosGrupos[index].materia;
                }
            },
            mounted: function ()
            {
                this.datosGrupos = grupos;
            }
        })
    </script>

@stop