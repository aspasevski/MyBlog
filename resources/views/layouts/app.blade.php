<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'My Blog')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #fff0f6, #ffe4ef);
            color: #4a2636;
            min-height: 100vh;
        }

        header {
            background: #d63384;
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 15px rgba(214, 51, 132, .25);
        }

        .navbar {
            width: 90%;
            max-width: 1000px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            margin: 0;
            font-size: 30px;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: bold;
            background: rgba(255, 255, 255, .12);
            padding: 10px 18px;
            border-radius: 22px;
            transition: .2s;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, .25);
        }

        .container {
            width: 90%;
            max-width: 760px;
            margin: 50px auto;
        }

        .card {
            background: white;
            border: 1px solid #ffd0e2;
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(180, 70, 120, .15);
        }

        h1 {
            margin-top: 0;
            color: #c2256e;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #7a284f;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 22px;
        }

        input,
        textarea {
            width: 100%;
            padding: 13px 15px;
            border: 2px solid #f3b4ce;
            border-radius: 12px;
            background: #fffafd;
            font-size: 16px;
            font-family: inherit;
            outline: none;
            transition: .2s;
        }

        input:focus,
        textarea:focus {
            border-color: #d63384;
            box-shadow: 0 0 0 4px rgba(214, 51, 132, .12);
        }

        textarea {
            min-height: 180px;
            resize: vertical;
        }

        .error {
            border-color: #dc3545;
            background: #fff5f5;
        }

        .error-msg {
            display: block;
            margin-top: 8px;
            color: #dc3545;
            font-size: 14px;
        }

        .button {
            display: inline-block;
            text-decoration: none;
            border: none;
            background: #d63384;
            color: white;
            padding: 13px 24px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
        }

        .button:hover {
            background: #b5256d;
            transform: translateY(-2px);
        }

        .secondary-button {
            display: inline-block;
            text-decoration: none;
            border: 2px solid #d63384;
            color: #d63384;
            background: white;
            padding: 11px 20px;
            border-radius: 25px;
            font-weight: bold;
            transition: .2s;
        }

        .secondary-button:hover {
            background: #fff0f6;
            transform: translateY(-2px);
        }

        .delete-button {
            border: none;
            background: #84213f;
            color: white;
            padding: 13px 24px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
        }

        .delete-button:hover {
            background: #64172e;
            transform: translateY(-2px);
        }

        .back-link {
            display: inline-block;
            margin-top: 18px;
            color: #c2256e;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .success-message {
            margin-bottom: 22px;
            padding: 15px 18px;
            border-radius: 12px;
            background: #eafaf0;
            color: #1f7a45;
            border: 1px solid #bde7cc;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .page-header h1 {
            margin: 4px 0 0;
            font-size: 38px;
        }

        .eyebrow {
            margin: 0;
            color: #d63384;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 14px;
            font-weight: bold;
        }

        .posts-grid {
            display: grid;
            gap: 22px;
        }

        .post-card {
            background: white;
            border: 1px solid #ffd0e2;
            border-radius: 18px;
            padding: 26px;
            box-shadow: 0 8px 24px rgba(180, 70, 120, .12);
            transition: .2s;
        }

        .post-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(180, 70, 120, .18);
        }

        .post-card h2 {
            margin: 12px 0;
        }

        .post-title {
            text-decoration: none;
            color: #9f1853;
            font-size: 28px;
        }

        .post-title:hover {
            color: #d63384;
        }

        .post-meta {
            display: flex;
            justify-content: space-between;
            color: #a16a82;
            font-size: 14px;
            gap: 20px;
        }

        .post-preview {
            color: #60404f;
            line-height: 1.7;
        }

        .read-more {
            display: inline-block;
            margin-top: 10px;
            color: #d63384;
            text-decoration: none;
            font-weight: bold;
        }

        .read-more:hover {
            color: #a61e63;
        }

        .single-post-title {
            margin: 18px 0 0;
            font-size: 40px;
        }

        .post-content {
            margin: 28px 0;
            padding-top: 24px;
            border-top: 1px solid #f1bfd3;
            line-height: 1.8;
            font-size: 17px;
            white-space: pre-line;
            color: #60404f;
        }

        .post-actions {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            align-items: center;
            padding-top: 24px;
            border-top: 1px solid #f1bfd3;
        }

        .post-actions form {
            margin: 0;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
        }

        .checkbox-group input {
            width: 18px;
            height: 18px;
            accent-color: #d63384;
        }

        .checkbox-group label {
            margin: 0;
        }

        .form-description {
            margin-top: -8px;
            margin-bottom: 28px;
            color: #8b6073;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        @media (max-width: 650px) {

            .page-header,
            .post-meta,
            .post-actions,
            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .post-actions a,
            .post-actions button,
            .form-actions a,
            .form-actions button {
                width: 100%;
                text-align: center;
            }

            .single-post-title {
                font-size: 32px;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="navbar">
            <h2 class="logo">My Blog</h2>

            <a href="{{ route('posts.index') }}" class="nav-link">
                All Posts
            </a>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

</body>

</html>