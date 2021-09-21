
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>@yield('title'){{config('app.name')}}</title>



    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


</head>
<body>

@include('frontend.partials.header')

<main>
    @if (session()->has('message'))
        <p class="alert alert-{{session()->get('alert')}}">{{session()->get('message')}}</p>
    @endif
@yield('main')
</main>

@include('frontend.partials.footer')


<script src="{{asset('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
@yield('script')
</body>
</html>
