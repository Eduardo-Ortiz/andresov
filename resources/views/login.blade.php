<!DOCTYPE html>
<html style="background-color: #00937f">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conalep | Ingresar</title>
    <link rel="icon"
          type="image/png"
          href="{{URL::asset('favicon.ico')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
    <link rel="stylesheet" href="{{URL::asset('css/dashboard.css')}}">

</head>
<body>
<!-- Navigation -->
<div class="container" style="margin-top: 30px">

</div>

<div id="app" class="container" style="margin-top: 75px">
    <div class="has-text-centered" style="margin-bottom: 10px">
        <span class="title has-text-white">Panel de Administrador</span>
    </div>
    <div class="columns">



        <div class="column is-4 is-offset-4" style="margin-top: 10px">
            <div class="box">
                <form  data-vv-scope="form-register" method="POST" action="{{ route('login')}}">
                    @if($errors->any())
                        <div class="notification is-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>&middot;{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="has-text-centered" style="margin-bottom:15px">
                        <img src="{{URL::asset('images/logo.png')}}" alt="Conalep" width="260">
                    </div>

                    {{ csrf_field() }}
                    <div class="field">
                        <label class="label">Correo Electronico</label>
                        <p class="control is-expanded has-icons-left has-icons-right">
                            <input value="{{ old('email') }}" data-vv-as="Correo Electronico" :class="{'input': true, 'is-danger': errors.has('form-register.email') }" v-validate="'required'"  name="email" id="email" class="input" type="email" placeholder="Ingresar Correo Electronico" @keyup.enter="checkForm()">
                            <i v-show="errors.has('form-register.email')" class="fa fa-warning"></i>
                            <span v-show="errors.has('form-register.email')" class="help is-danger">@{{errors.first('form-register.email')}}</span>
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Contraseña</label>
                        <p class="control is-expanded has-icons-left has-icons-right">
                            <input data-vv-as="Contraseña" :class="{'input': true, 'is-danger': errors.has('form-register.password') }" v-validate="'required'" name="password" id="password" class="input" type="password" placeholder="Ingresar Contraseña" @keyup.enter="checkForm()">
                            <i v-show="errors.has('form-register.password')" class="fa fa-warning"></i>
                            <span v-show="errors.has('form-register.password')" class="help is-danger">@{{errors.first('form-register.password')}}</span>
                            <span class="icon is-small is-left">
                                <i class="fas fa-key"></i>
                            </span>
                        </p>
                    </div>

                    <div>
                        <button type="submit" v-on:click="checkForm()" class="button is-fullwidth is-black is-large">
                            <span>Ingresar</span>
                            <span class="icon">
                                <i class="fas fa-share-square"></i>
                            </span>
                        </button>
                    </div>

                    <div class="has-text-centered" style="margin-top: 10px">
                        <span class="title is-5">Volver al inicio: <a href="{{url('/')}}">Pagina Principal</a></span>
                    </div>

                </form>
            </div>
        </div>
    </div>



</div>
</body>

<footer>
    <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.13/dist/vue.js"></script>
    <script src="https://unpkg.com/vee-validate@2.0.0-rc.7/dist/vee-validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bulma-accordion@2.0.1/dist/js/bulma-accordion.min.js"></script>


    <script>
        Vue.use(VeeValidate, {
            locale: 'es',
            dictionary: {
                es: {  messages:{
                    _default : (field) => `El campo ${field} no es valido.`,
                    confirmed : (field) => `La confirmación de ${field} no coincide.`,
                required : (field) => `El campo ${field} es requerido.` }

        }
        }
        });


        var app = new Vue({
            el: '#app',
            data: {

            },
            methods: {
                checkForm: function () {

                    app.$validator.validateAll('form-register');
                    if (this.errors.any()) {
                        event.preventDefault();
                    }
                }
            }
        })

    </script>
</footer>
</html>