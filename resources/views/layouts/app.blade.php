@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@include('sweetalert::alert')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

    <meta name="csrf-token" content="{{ csrf_token() }}">
   @stop

@section('content')
<body class="font-sans antialiased">
<!-- Page Content 
    <div class="min-h-screen bg-gray-100">


        
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        -->

        <main>
            <div class="container">
                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('modals')
</body>
@stop

@section('css')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    -->

    @livewireStyles
@stop

@section('js')
    <script src="{{ mix('js/app.js') }}" defer></script>

    
<!--<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script> JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    {{--<script type="text/javascript">
        window.livewire.on({
            $('#exampleModal').modal('hide');
        });
    </script>--}}
@stop

