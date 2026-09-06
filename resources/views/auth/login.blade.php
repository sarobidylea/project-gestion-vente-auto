<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Connexion - LUXORA MOTORS</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            background:
                radial-gradient(circle at top left, #3b0000, transparent 35%),
                radial-gradient(circle at bottom right, #250000, transparent 35%),
                #080808;

            font-family: Arial, sans-serif;
            color: white;
        }

        .login-container {
            width: 420px;
            max-width: 90%;
            padding: 40px;

            background: rgba(20, 20, 20, 0.95);

            border: 1px solid #3a3a3a;
            border-radius: 18px;

            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.7),
                0 0 30px rgba(180, 0, 0, 0.15);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            font-size: 32px;
            letter-spacing: 4px;
            color: #e50914;
        }

        .logo p {
            margin-top: 8px;
            color: #888;
            font-size: 13px;
            letter-spacing: 2px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #ddd;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 14px 16px;

            background: #111;
            color: white;

            border: 1px solid #333;
            border-radius: 10px;

            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #e50914;
            box-shadow: 0 0 0 3px rgba(229, 9, 20, 0.1);
        }

        .error {
            margin-bottom: 20px;
            padding: 12px;

            background: rgba(229, 9, 20, 0.1);
            border: 1px solid #e50914;
            border-radius: 8px;

            color: #ff6b6b;
            font-size: 14px;
        }

        .success {
            margin-bottom: 20px;
            padding: 12px;

            background: rgba(0, 150, 80, 0.1);
            border: 1px solid #009650;
            border-radius: 8px;

            color: #55d98b;
            font-size: 14px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;

            border: none;
            border-radius: 10px;

            background: #e50914;
            color: white;

            font-size: 15px;
            font-weight: bold;

            cursor: pointer;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #b20710;
            transform: translateY(-1px);
        }

        .footer {
            text-align: center;
            margin-top: 25px;

            color: #666;
            font-size: 12px;
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="logo">
        <h1>LUXORA</h1>
        <p>MOTORS ADMINISTRATION</p>
    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">

        @csrf

        <div class="form-group">
            <label for="email">Adresse email</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="admin@luxora.com"
                required
                autofocus
            >
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                required
            >
        </div>

        <button type="submit" class="btn-login">
            SE CONNECTER
        </button>

    </form>

    <div class="footer">
        © {{ date('Y') }} LUXORA MOTORS — Administration
    </div>

</div>

</body>
</html>

