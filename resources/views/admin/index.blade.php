@extends('layouts.master')

@section('content')

    <div id="app">
        <h1 class="title is-3">Panel de Administrador</h1>
        <button class="button is-medium is-fullwidth is-black" v-on:click="crearGrupo=true">
            <span>Crear Grupo</span>
            <span class="icon">
                <i class="fas fa-folder-plus"></i>
            </span>
        </button>

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
                    <button v-bind:class="{ 'is-loading': loading }" class="button is-black" v-on:click="guardarGrupo()">Crear Grupo</button>
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

                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button v-bind:class="{ 'is-loading': loading }" class="button is-black" v-on:click="guardarArchivo()">Crear Grupo</button>
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
                        <a class="card-header-icon" aria-label="more options" v-on:click="datosGrupos[index].expandido=!datosGrupos[index].expandido">

      <span class="icon" v-if="datosGrupos[index].expandido">
        <i class="fas fa-angle-up" aria-hidden="true"></i>
      </span>
                            <span class="icon" v-else>
        <i class="fas fa-angle-down" aria-hidden="true"></i>
      </span>
                        </a>
                    </header>
                    <div class="card-content" v-show="value.expandido==true">
                        <div class="content">




                            <button class="button is-pulled-left" v-on:click="modalArchivo(index)">
                                <span>Subir Archivo</span>
                                <span class="icon">
                                   <i class="fas fa-file-upload"></i>
                                </span>
                            </button>
                            <button class="button is-pulled-right" v-on:click="eliminarGrupo(value.id)">
                                <span>Eliminar Grupo</span>
                                <span class="icon">
                                   <i class="fas fa-trash-alt"></i>
                                </span>
                            </button>
                            <button class="button is-pulled-right" style="margin-right: 10px">
                                <span>Limpiar Archivos</span>
                                <span class="icon">
                                   <i class="fas fa-broom"></i>
                                </span>
                            </button>

                            <div class="is-clearfix">


                            </div>

                            <div class="field has-addons" style="margin-top: 15px">
                                <p class="control">
                                    <a class="button">
                                        Dirección del Grupo
                                    </a>
                                </p>
                                <p class="control is-expanded">
                                    <input class="input" type="text" placeholder="Amount of money" disabled v-model="value.ruta">
                                </p>
                                <p class="control">
                                    <button v-on:click="copiarGrupo(value.ruta)" class="button is-black"><span>Copiar</span>
                                        <span class="icon">
                                          <i class="fas fa-copy"></i>
                                    </span>
                                    </button>
                                </p>
                            </div>

                            <table  class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" style="margin-top: -12px">
                                <thead>
                                <tr>
                                    <th style="width: 1px !important">#</th>
                                    <th style="min-width: 200px">Archivo</th>
                                    <th style="width: 1px !important">Fecha</th>
                                    <th style="width: 1px !important;">Tipo</th>
                                    <th style="width: 1px !important">Des.Uni.</th>
                                    <th style="width: 1px !important">Des.Tot.</th>
                                    <th style="width: 1px !important">Descargar</th>
                                    <th style="width: 1px !important">Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(archivo,index) in value.archivos">
                                    <td style="padding-top:8px">@{{index+1}}</td>
                                    <td style="padding-top:8px">@{{archivo.nombre}}</td>
                                    <td style="padding-top:8px">@{{archivo.fecha}}</td>
                                    <td style="text-align: center">
                                        <img v-if="archivo.extension=='doc'||archivo.extension=='docx'" style="margin-top: 5px" src="{{URL::asset('images/doc.png')}}" width="20" alt="Word">
                                        <img v-if="archivo.extension=='pdf'" style="margin-top: 5px" src="{{URL::asset('images/pdf.png')}}" width="20" alt="PDF">
                                        <img v-if="archivo.extension=='xls'||archivo.extension=='xlsx'" style="margin-top: 5px" src="{{URL::asset('images/xls.png')}}" width="20" alt="Excel">
                                    </td>
                                    <td style="padding-top:8px;text-align: center">@{{archivo.descargas_unicas}}</td>
                                    <td style="padding-top:8px;text-align: center">@{{archivo.descargas_totales}}</td>
                                    <td style="padding-top:6px">
                                        <a class="button is-black is-small" v-bind:href="rutaDescargas+'/'+archivo.id">
                                            <span>Descargar</span>
                                            <span class="icon">
                                                <i class="fas fa-file-download"></i>
                                            </span>
                                        </a>
                                    </td>
                                    <td style="padding-top:6px">
                                        <a class="button is-small" v-on:click="eliminarArchivo(archivo.id)">
                                            <span>Eliminar</span>
                                            <span class="icon">
                                                <i class="fas fa-trash-alt"></i>
                                            </span>
                                        </a>
                                    </td>
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


        var rutaDescargas = '<?php echo url('admin/files') ?>';

        const app = new Vue({
            el: '#app',
            data: {

                datosGrupos : [],
                rutaDescargas : null,

                crearGrupo : false,
                cargandoGrupos : false,

                subirArchivo : false,
                grupoArchivo : null,
                grupoSelect : 0,
                nombreArchivo : null,

                file : null,

                nombreGrupo : null,
                materiaGrupo : null,
                direccionGrupo : null,

                loading :false
            },
            methods: {
                guardarGrupo : function () {

                    this.loading = true;
                    axios.post('<?php echo route('groups_store') ?>', {
                        nombre : app.nombreGrupo,
                        materia : app.materiaGrupo,
                        direccion : app.direccionGrupo
                    }).then(function (response) {
                        app.datosGrupos = response.data;
                        app.crearGrupo = false;
                        app.loading = false;
                    });
                },

                guardarArchivo : function () {
                    var archivo = document.getElementById('archivo').files[0];
                    var data = new FormData();
                    var settings = { headers: { 'content-type': 'multipart/form-data' } };

                    data.append('archivo', archivo);
                    data.append('nombre', this.nombreArchivo);
                    data.append('group_id', this.datosGrupos[app.grupoSelect].id);

                    this.loading = true;

                    axios.post('<?php echo route('files_store') ?>', data,settings).
                    then(function (response) {
                        app.datosGrupos = response.data;
                        app.subirArchivo = false;
                        for(i=0;i<app.datosGrupos.length;i++)
                        {
                            app.datosGrupos[app.grupoSelect].expandido = true;
                        }
                        app.loading = false;
                    });
                },

                copiarGrupo : function(value) {
                    var tempInput = document.createElement("input");
                    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
                    tempInput.value = value;
                    document.body.appendChild(tempInput);
                    tempInput.select();
                    document.execCommand("copy");
                    document.body.removeChild(tempInput);
                },

                modalArchivo : function (index)
                {
                    this.grupoSelect = index;
                    this.subirArchivo = true;
                    this.grupoArchivo = this.datosGrupos[index].nombre + " - "+ this.datosGrupos[index].materia;
                },
                eliminarGrupo : function (id)
                {
                    this.loading = true;
                    axios.post('<?php echo route('groups_delete') ?>', {
                        id : id
                    }).then(function (response) {
                        app.datosGrupos = response.data;
                        app.loading = false;
                    });
                },
                eliminarArchivo : function (id)
                {
                    this.loading = true;
                    axios.post('<?php echo route('files_delete') ?>', {
                        id : id
                    }).then(function (response) {
                        app.datosGrupos = response.data;
                        for(i=0;i<app.datosGrupos.length;i++)
                        {
                            app.datosGrupos[app.grupoSelect].expandido = true;
                        }
                        app.loading = false;
                    });
                }
            },
            mounted: function ()
            {
                this.datosGrupos = grupos;
                this.rutaDescargas = rutaDescargas;
            }
        })
    </script>

@stop