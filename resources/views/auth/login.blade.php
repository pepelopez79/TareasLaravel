<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Iniciar sesión') }}</div>

                    <div class="card-body">
                        <form id="loginForm" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">{{ __('Correo electrónico') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Contraseña') }}</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <a href="{{ route('password') }}">{{ __('¿Olvidaste tu contraseña?') }}</a>
                            </div>                            

                            <button type="submit" class="btn btn-primary">{{ __('Iniciar sesión') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rememberCheckbox = document.getElementById('remember');
            var emailInput = document.getElementById('email');
            var passwordInput = document.getElementById('password');

            rememberCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    document.cookie = "remember=true; expires=Fri, 31 Dec 9999 23:59:59 GMT";
                } else {
                    document.cookie = "remember=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
                }
            });

            var rememberCookie = document.cookie.split(';').find(cookie => cookie.trim().startsWith('remember='));
            if (rememberCookie) {
                var rememberValue = rememberCookie.split('=')[1];
                if (rememberValue === "true") {
                    var savedEmail = localStorage.getItem('savedEmail');
                    var savedPassword = localStorage.getItem('savedPassword');
                    if (savedEmail) {
                        emailInput.value = savedEmail;
                    }
                    if (savedPassword) {
                        passwordInput.value = savedPassword;
                    }
                }
            }

            document.getElementById('loginForm').addEventListener('submit', function() {
                if (rememberCheckbox.checked) {
                    localStorage.setItem('savedEmail', emailInput.value);
                    localStorage.setItem('savedPassword', passwordInput.value);
                }
            });
        });
    </script>
</body>
</html>