<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conalep</title>
    <link rel="icon"
          type="image/png"
          href="{{URL::asset('favicon.ico')}}" />
    <link rel="stylesheet" href="{{URL::asset('css/bulma.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/all.min.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>


<!-- Navigation -->
@include('layouts.navbar')
<section class="section">
    <div class="container">
        @yield('content')
    </div>
</section>
</body>


<footer>
<!-- <script type="text/javascript" src="{{URL::asset('js/vue.min.js')}}"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.22/dist/vue.js"></script>

    @yield('footer')

    <script>
        function dimiss(sender) {
            sender.parentNode.style.display = 'none';
        }
    </script>
</footer>


</html>