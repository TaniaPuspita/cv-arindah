
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Login | CV Arindah</title>

    <link rel="icon" type="image/png"
          href="{{ asset('images/logo-arindah.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            min-height: 100%;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: #17365f;
            background: #f0f4fb;
        }

        button,
        input {
            font: inherit;
        }

        /* BACKGROUND */
        .login-wrapper {
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px;
            background:
                radial-gradient(
                    circle at 8% 12%,
                    rgba(37, 99, 235, .12),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 92% 88%,
                    rgba(96, 165, 250, .15),
                    transparent 32%
                ),
                #f0f4fb;
        }

        /* KARTU LOGIN UTAMA */
        .login-card {
            width: 100%;
            max-width: 1160px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #fff;
            border: 1px solid #e4ebf5;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 24px 65px rgba(23, 54, 95, .14);
        }

        /* PANEL KIRI */
        .login-intro {
            position: relative;
            isolation: isolate;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 44px 46px;
            overflow: hidden;
            color: #fff;
            background: linear-gradient(
                140deg,
                #15345c 0%,
                #20518b 58%,
                #1764b6 100%
            );
        }

        .login-intro::before,
        .login-intro::after {
            content: "";
            position: absolute;
            z-index: -1;
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 50%;
            pointer-events: none;
        }

        .login-intro::before {
            width: 390px;
            height: 390px;
            right: -200px;
            bottom: -130px;
        }

        .login-intro::after {
            width: 280px;
            height: 280px;
            right: -145px;
            bottom: -75px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 34px;
        }

        .brand-logo {
            display: block;
            flex-shrink: 0;
            width: 70px;
            height: 70px;
            padding: 5px;
            object-fit: contain;
            border-radius: 17px;
            background: #fff;
        }

        .brand-name {
            margin: 0;
            color: #fff;
            font-size: 23px;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .brand-caption {
            margin: 7px 0 0;
            color: #c6d8f4;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            width: fit-content;
            margin-bottom: 25px;
            padding: 11px 16px;
            border: 1px solid rgba(255, 255, 255, .17);
            border-radius: 30px;
            background: rgba(255, 255, 255, .09);
            color: #e8f0ff;
            font-size: 12px;
            font-weight: 700;
        }

        .admin-badge span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #72e6b0;
        }

        .intro-title {
            max-width: 430px;
            margin: 0 0 20px;
            color: #fff;
            font-size: clamp(34px, 3vw, 42px);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -1.5px;
        }

        .intro-title span {
            color: #a9ceff;
        }

        .intro-description {
            max-width: 410px;
            margin: 0;
            color: #d6e5fa;
            font-size: 14px;
            line-height: 1.9;
        }

        .feature-list {
            display: grid;
            gap: 14px;
            margin-top: 28px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #edf4ff;
            font-size: 13px;
            line-height: 1.5;
        }

        .feature-check {
            display: flex;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            width: 25px;
            height: 25px;
            border-radius: 7px;
            background: rgba(255, 255, 255, .15);
            font-size: 15px;
            font-weight: 800;
        }

        /* PANEL KANAN */
        .login-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 46px 48px;
            background: #fff;
        }

        .welcome-label {
            margin: 0 0 14px;
            color: #1769e0;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.9px;
        }

        .login-title {
            margin: 0 0 14px;
            color: #17365f;
            font-size: 34px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .login-description {
            margin: 0 0 30px;
            color: #7889a2;
            font-size: 14px;
            line-height: 1.85;
        }

        .login-form {
            width: 100%;
        }

        .login-form .field-group + .field-group {
            margin-top: 22px;
        }

        .field-label {
            display: block;
            margin-bottom: 10px;
            color: #405674;
            font-size: 13px;
            font-weight: 700;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translateY(-50%);
            color: #91a4be;
            pointer-events: none;
        }

        .input-icon svg {
            width: 19px;
            height: 19px;
        }

        .login-form input[type="email"],
        .login-form input[type="password"] {
            display: block;
            width: 100%;
            min-height: 54px;
            padding: 14px 16px 14px 48px;
            border: 1px solid #e0e8f4;
            border-radius: 13px;
            outline: none;
            background: #f8fafe;
            color: #243b53;
            font-size: 14px;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .login-form input::placeholder {
            color: #9aa9bd;
        }

        .login-form input[type="email"]:focus,
        .login-form input[type="password"]:focus {
            border-color: #4387ff;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 18px;
            color: #71819a;
            font-size: 13px;
            cursor: pointer;
        }

        .remember-row input {
            width: 17px;
            height: 17px;
            margin: 0;
            accent-color: #1769e0;
        }

        .login-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 54px;
            margin-top: 25px;
            padding: 14px 20px;
            border: none;
            border-radius: 13px;
            background: linear-gradient(110deg, #1769e0, #194dc5);
            box-shadow: 0 8px 20px rgba(23, 105, 224, .21);
            color: #fff;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: transform .2s, box-shadow .2s;
        }

        .login-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 11px 24px rgba(23, 105, 224, .26);
        }

        .login-button:disabled {
            opacity: .7;
            cursor: wait;
            transform: none;
        }

        .login-button:focus-visible,
        .back-link:focus-visible {
            outline: 3px solid rgba(23, 105, 224, .35);
            outline-offset: 3px;
        }

        .login-error {
            margin-bottom: 16px;
            padding: 12px 14px;
            border: 1px solid #fecaca;
            border-radius: 10px;
            background: #fef2f2;
            color: #dc2626;
            font-size: 13px;
            line-height: 1.6;
        }

        .login-status {
            margin-bottom: 14px;
            color: #16834a;
            font-size: 13px;
        }

        .back-link {
            display: block;
            margin-top: 22px;
            color: #7c8ba2;
            font-size: 13px;
            text-align: center;
            text-decoration: none;
        }

        .back-link strong {
            color: #1769e0;
            font-weight: 700;
        }

        .back-link:hover strong {
            text-decoration: underline;
        }

        /* LAPTOP DENGAN TINGGI LAYAR PENDEK */
        @media (max-height: 760px) and (min-width: 769px) {
            .login-wrapper {
                padding-top: 14px;
                padding-bottom: 14px;
            }

            .login-intro {
                padding: 30px 36px;
            }

            .login-content {
                padding: 30px 38px;
            }

            .brand {
                margin-bottom: 23px;
            }

            .brand-logo {
                width: 60px;
                height: 60px;
            }

            .admin-badge {
                margin-bottom: 17px;
                padding: 9px 13px;
            }

            .intro-title {
                margin-bottom: 13px;
                font-size: 33px;
            }

            .intro-description {
                font-size: 13px;
                line-height: 1.7;
            }

            .feature-list {
                gap: 9px;
                margin-top: 18px;
            }

            .feature-item {
                font-size: 12px;
            }

            .login-title {
                font-size: 30px;
            }

            .login-description {
                margin-bottom: 19px;
                font-size: 13px;
            }

            .login-form .field-group + .field-group {
                margin-top: 14px;
            }

            .login-form input[type="email"],
            .login-form input[type="password"] {
                min-height: 47px;
            }

            .remember-row {
                margin-top: 13px;
            }

            .login-button {
                min-height: 48px;
                margin-top: 18px;
            }

            .back-link {
                margin-top: 15px;
            }
        }

        /* TABLET DAN HP */
        @media (max-width: 768px) {
            .login-wrapper {
                min-height: 100vh;
                min-height: 100dvh;
                align-items: flex-start;
                padding: 18px 14px;
            }

            .login-card {
                max-width: 500px;
                grid-template-columns: 1fr;
                border-radius: 22px;
            }

            .login-intro {
                padding: 28px 26px;
            }

            .brand {
                margin-bottom: 22px;
            }

            .brand-logo {
                width: 56px;
                height: 56px;
            }

            .brand-name {
                font-size: 19px;
            }

            .intro-title {
                max-width: 100%;
                font-size: 32px;
            }

            .intro-description {
                max-width: 100%;
            }

            .feature-list {
                gap: 10px;
                margin-top: 18px;
            }

            .login-content {
                padding: 30px 26px;
            }

            .login-title {
                font-size: 29px;
            }

            .login-description {
                margin-bottom: 22px;
            }
        }

        /* HP KECIL */
        @media (max-width: 380px) {
            .login-wrapper {
                padding: 10px;
            }

            .login-intro {
                padding: 23px 19px;
            }

            .login-content {
                padding: 25px 19px;
            }

            .intro-title {
                font-size: 27px;
            }

            .login-title {
                font-size: 26px;
            }

            .brand-logo {
                width: 48px;
                height: 48px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>
    <main class="login-wrapper">
        {{ $slot }}
    </main>
</body>
</html>
