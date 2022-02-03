<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeRa Burger - Login</title>
    <link rel="stylesheet" href="<?= base_url() ?>/public/admin/login/css/style.css">

</head>

<body>
    <div class="login-wrap">
        <div class="login-html">
            <img src="<?= base_url() ?>/public/img/peraburgelogo1.png" alt="Logo" class="img-fluid" style="width: 100%;">
            
            <h2></h2>

            <br>
            <br>
            <?php if (session('msg')) : ?>
                <div class="alert alert-danger">
                    <?= session('msg.body') ?>
                </div>
            <?php endif ?>



            <br>
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Entrar</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>


            <div class="login-form">

                <form action="<?= base_url() . route_to('check_login') ?>" method="post">
                    <div class="sign-in-htm">

                        <div class="group">
                            <label for="user" class="label">Usuario</label>
                            <input name="user" type="text" class="input" value="<?= old('user') ?>">
                            <p class="is-danger"><?= session('errors.user') ?></p>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Contraseña</label>
                            <input name="password" id="pass" type="password" class="input" data-type="password">
                            <p class="is-danger"><?= session('errors.password') ?></p>
                        </div>
                        <div class="group">
                            <input id="check" type="checkbox" class="check" checked>
                            <label for="check"><span class="icon"></span> Keep me Signed in</label>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Iniciar Sesión">
                        </div>
                        <div class="hr"></div>

                    </div>

                </form>

            </div>
        </div>
    </div>

</body>

</html>