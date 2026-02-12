<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abir's FoodCourt - Professional Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body, html {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            overflow-x: hidden;
        }

        .container {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* --- LEFT SIDE: WIDE IMAGE AREA --- */
        .left-side {
            flex: 1.5;
            height: 100vh;
            background-color: #f8f8f8;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left-side img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        /* --- RIGHT SIDE: LOGIN FORM --- */
        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            padding: 40px;
            box-shadow: -5px 0 20px rgba(0,0,0,0.05);
            z-index: 10;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 380px;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 35px;
        }

        /* --- PROFESSIONAL TEXT STYLE --- */
        .brand-logo h1 {
            font-family: 'Poppins', sans-serif;
            color: #222; /* Deep Professional Dark */
            font-size: 30px;
            font-weight: 800; /* Extra Bold for Professional look */
            margin-bottom: 5px;
            letter-spacing: -1px;
            text-transform: capitalize;
        }

        /* Highlights 'FoodCourt' in brand color */
        .brand-logo h1 span {
            color: #ff7f50;
        }

        .brand-logo p {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: 500;
        }

        .auth-header {
            margin-bottom: 30px;
        }

        .auth-header h2 {
            font-size: 26px;
            font-weight: 700;
            color: #333;
        }

        /* Input Styling */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 15px 18px;
            border: 2px solid #f1f1f1;
            border-radius: 10px;
            font-size: 15px;
            font-family: inherit;
            outline: none;
            transition: 0.3s;
            background-color: #fafafa;
        }

        .form-group input:focus {
            border-color: #ff7f50;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(255, 127, 80, 0.1);
        }

        /* Button Styling */
        .login-btn {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(90deg, #ff7f50, #ff6333);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
            box-shadow: 0 8px 15px rgba(255, 99, 51, 0.2);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(255, 99, 51, 0.3);
        }

        .auth-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }

        .auth-footer a {
            color: #ff7f50;
            text-decoration: none;
            font-weight: 600;
        }

        /* Mobile View */
        @media (max-width: 900px) {
            .left-side {
                display: none;
            }
            .right-side {
                flex: 1;
                height: 100vh;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="left-side">
            <img src="{{ asset('assets/images/FoodCourt.png') }}" alt="Abir's FoodCourt Banner">
        </div>

        <div class="right-side">
            <div class="auth-wrapper">

                <div class="brand-logo">
                    <h1>Abir's <span>FoodCourt</span></h1>
                    <p>Quality Food, Fast Delivery</p>
                </div>

                <div class="auth-header">
                    <h2>Login</h2>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="name" placeholder="Enter your username" required autofocus>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter password" required>
                    </div>

                    <button type="submit" class="login-btn">Sign In</button>
                </form>

                <div class="auth-footer">
                    New here? <a href="{{ route('register') }}">Create an account</a>
                </div>

            </div>
        </div>

    </div>

</body>
</html>
