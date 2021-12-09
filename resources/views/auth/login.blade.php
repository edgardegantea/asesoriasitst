
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
@livewireStyles
@stop

@section('js')
<script src="{{ mix('js/app.js') }}" defer></script>

<script type="text/javascript">
    window.livewire.on('userStore', () => {
        $('#exampleModal').modal('hide');
    });
</script>
@stop

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{  asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{  asset('adminlte/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

<body class="hold-transition login-page" style="background-color: #0F192A">


<div class="login-box">
    <div class="login-logo">
        <a href="#"><b></b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <h3 class="login-box-msg">Sistema de Asesorías</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3 input-group">
                    <input id="numeroControl" type="text" class="form-control @error('numeroControl') is-invalid @enderror" placeholder="Número De control"
                           name="numeroControl" value="{{ old('numeroControl') }}" required autocomplete="numeroControl" autofocus>

                    @error('numeroControl')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 input-group">
                    <input id="password" type="password" placeholder="Contraseña"
                           class="form-control @error('password') is-invalid @enderror" name="password" required
                           autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Recordarme
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Ingresar') }}
                        </button>


                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>

            <!--
            <div class="mb-3 text-center social-auth-links">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="mr-2 fab fa-facebook"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="mr-2 fab fa-google-plus"></i> Sign in using Google+
                </a>
            </div>
            -->

            <!-- /.social-auth-links -->


        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
</body>