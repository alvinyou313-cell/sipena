
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Login') - SIPENA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            min-height: 100%;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
        }

        .auth-shell {
            min-height: 100vh;
            width: 100%;
            display: flex;
            background:
                linear-gradient(
                    120deg,
                    rgba(5, 25, 45, 0.82),
                    rgba(5, 25, 45, 0.58)
                ),
                url("{{ asset('images/bg-smkn.jpg') }}");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* PANEL INFORMASI */
        .auth-visual {
            flex: 1;
            min-width: 0;
            min-height: 100vh;
            padding: 45px 6%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #fff;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: #1769aa;
            font-size: 25px;
        }

        .brand-name {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .brand-caption {
            font-size: 12px;
            opacity: .85;
        }

        .visual-content {
            max-width: 650px;
            margin: 55px 0;
        }

        .visual-tag {
            display: inline-block;
            padding: 10px 16px;
            border: 1px solid rgba(255,255,255,.35);
            background: rgba(255,255,255,.12);
            border-radius: 30px;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 25px;
        }

        .visual-content h1 {
            font-size: clamp(32px, 4vw, 52px);
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 22px;
        }

        .visual-content h1 span {
            display: block;
            color: #75c5ff;
        }

        .visual-content p {
            font-size: 15px;
            line-height: 1.8;
            color: rgba(255,255,255,.9);
            max-width: 570px;
        }

        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-top: 30px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 13px;
            font-size: 14px;
        }

        .feature-item i {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            border-radius: 50%;
            background: rgba(255,255,255,.17);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #75c5ff;
            font-size: 17px;
        }

        .visual-footer {
            font-size: 12px;
            color: rgba(255,255,255,.75);
        }

        /* PANEL LOGIN */
        .auth-panel {
            width: 490px;
            flex-shrink: 0;
            min-height: 100vh;
            background: rgba(255,255,255,.98);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 45px;
            box-shadow: -10px 0 40px rgba(0,0,0,.18);
        }

        .auth-card {
            width: 100%;
            max-width: 390px;
        }

        .mobile-brand {
            display: none;
            align-items: center;
            gap: 12px;
            margin-bottom: 35px;
        }

        .mobile-brand .brand-name {
            color: #173b5c;
        }

        .mobile-brand .brand-caption {
            color: #64748b;
        }

        .welcome-label {
            color: #1976b9;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .auth-title {
            font-size: 29px;
            font-weight: 800;
            color: #172b4d;
            margin-bottom: 10px;
        }

        .auth-description {
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .form-label {
            color: #334155;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrap > i:first-child {
            position: absolute;
            left: 15px;
            color: #64748b;
            z-index: 2;
        }

        .input-wrap .form-control {
            height: 49px;
            border-radius: 9px;
            padding-left: 43px;
            padding-right: 45px;
            font-size: 13px;
            border: 1px solid #dbe3ec;
            background: #f8fafc;
        }

        .input-wrap .form-control:focus {
            background: #fff;
            border-color: #2684c7;
            box-shadow: 0 0 0 3px rgba(38,132,199,.12);
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            border: none;
            background: transparent;
            color: #64748b;
            font-size: 17px;
            z-index: 3;
            cursor: pointer;
        }

        .form-check-label {
            font-size: 12px;
            color: #64748b;
        }

        .forgot-link {
            font-size: 12px;
            color: #1976b9;
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            height: 49px;
            border: none;
            border-radius: 9px;
            background: linear-gradient(135deg, #1769aa, #1685c7);
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .8px;
            margin-top: 27px;
            transition: .2s;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #12558c, #116da7);
            transform: translateY(-1px);
            box-shadow: 0 7px 16px rgba(23,105,170,.2);
        }

        .auth-bottom {
            text-align: center;
            color: #94a3b8;
            font-size: 11px;
            margin-top: 30px;
        }

        /* TABLET */
        @media (max-width: 1000px) {
            .auth-panel {
                width: 430px;
                padding: 35px;
            }

            .auth-visual {
                padding: 35px;
            }

            .visual-content h1 {
                font-size: 37px;
            }
        }

        /* HP */
        @media (max-width: 768px) {
            .auth-shell {
                min-height: 100vh;
                padding: 25px 15px;
                align-items: center;
                justify-content: center;
                background-attachment: scroll;
            }

            .auth-visual {
                display: none;
            }

            .auth-panel {
                width: 100%;
                max-width: 460px;
                min-height: auto;
                padding: 30px 24px;
                border-radius: 16px;
                background: rgba(255,255,255,.98);
                box-shadow: 0 15px 45px rgba(0,0,0,.3);
            }

            .mobile-brand {
                display: flex;
            }

            .auth-title {
                font-size: 25px;
            }
        }

        @media (max-width: 380px) {
            .auth-panel {
                padding: 25px 18px;
            }

            .auth-title {
                font-size: 23px;
            }

            .forgot-link {
                font-size: 11px;
            }
        }
    </style>
</head>

<body>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword() {
            const passwordInput = document.querySelector('.password-input');
            const passwordIcon = document.getElementById('passwordIcon');

            if (!passwordInput || !passwordIcon) {
                return;
            }

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('bi-eye');
                passwordIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('bi-eye-slash');
                passwordIcon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>
