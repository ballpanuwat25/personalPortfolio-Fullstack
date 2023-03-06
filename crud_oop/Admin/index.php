<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--=============== REMIXICONS ===============-->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

        <!--=============== CSS ===============-->
        <link rel="stylesheet" href="assets/css/login.css">

        <title>Administrator Login</title>
    </head>
    <body>
    <canvas id="canvas"></canvas>
        <div class="container">
            <div class="login__content">
                <img src="assets/img/bg-login2.png" alt="login image" class="login__img">

                <form action="" class="login__form">
                    <div>
                        <h1 class="login__title">
                            <span>Welcome</span> Back
                        </h1>
                        <p class="login__description">
                            Welcome! Please login to continue.
                        </p>
                    </div>

                    <div>
                        <div class="login__inputs">
                            <div>
                                <label for="" class="login__label">Email</label>
                                <input type="text" placeholder="Enter your email address" required class="login__input" id="username">
                            </div>

                            <div>
                                <label for="" class="login__label">Password</label>

                                <div class="login__box">
                                    <input type="password" placeholder="Enter your password" required class="login__input" id="input-pass">
                                    <i class="ri-eye-close-line login__eye" id="input-icon"></i>
                                </div>
                            </div>
                            
                        </div> <br>

                        <div>
                            <div class="login__buttons">
                                <button class="login__button" onclick="getInfo()">Log in</button>
                                <button class="login__button login__button-ghost" onclick="location.href = '../index.php';">Cancel</button>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>

        <!--=============== MAIN JS ===============-->
        <script src="assets/js/login.js"></script>
    </body>
</html>