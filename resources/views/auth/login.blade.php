<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <!-- META SECTION -->
        <title>H2P</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="/joli/img/bpnlogo.png"/>
        <link rel="stylesheet" type="text/css" id="theme" href="/joli/css/theme-default.css"/>
    </head>
    <body>
        <div class="login-container">
            <div class="login-box animated fadeInDown">
                <img src="/joli/img/bpnlogo.png" width="100px;" class="img img-responsive" style="margin:auto;">
                <br><br>
                <div class="login-body">
                    <div class="login-title"><strong>Hay</strong>, Silahkan Login</div>
                    <form method="POST" action="{{ route('login') }}" autocomplete="on">
                    @csrf
                        <div class="form-group">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Username" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <input id="emailasli" type="hidden" name="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ingatkan saya') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-info btn-block">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2019 H2P, Kantah Kabupaten Bogor
                    </div>
                    <div class="pull-right">
                        <a href="kantahkabbogor.id">Contact Us</a>
                    </div>
                </div>
            </div>

        </div>
        <script type="text/javascript" src="/joli/js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/joli/js/plugins/bootstrap/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                $(document).on('blur','#email',function () {
                    var email = $(this).val();
                    var Username = $('#emailasli').val();
                    $('#emailasli').val(email+"@gmail.com");
                });
                $('#emailasli').val($('#email').val()+"@gmail.com");
            })
        </script>
    </body>
</html>






