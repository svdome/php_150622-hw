<?
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My first site</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <?

    include_once "pages/functions.php";
    ?>
    <div class="container">
        <div class="row">
            <header class="col-sm-12 col-md-12 col-lg-12">
                <p>Если вы первый раз на сайте пройдите регистрацию во вкладке "Регистрация"</p>
                <p>Если вы зарегистрированный пользователь, Авторизуйтесь</p>
                <h3>Авторизация</h3>

                <?

                if (!isset($_POST['authbtn']) && !isset($_SESSION['isAuth'])) { ?>
                    <form action="index.php" method="post">
                        <div class="form-group">
                            <input type="text" name="loginAuth" placeholder="Введите логин" class="form-control"><br>
                            <input type="password" name="passwordAuth" placeholder="Введите пароль" class="form-control"><br>
                            <input type="submit" name="authbtn" class="btn btn-primary"><br>
                        </div>
                    </form>
                <? }
                if (isset($_POST['authbtn'])) {
                    if (login($_POST['loginAuth'], $_POST['passwordAuth'])) {
                        echo "<h3><span style='color: green;'>Авторизация прошла успешно!</span></h3>";
                        $_SESSION['isAuth'] = 'Y';
                    } else {
                        echo '<script>window.location = "index.php?page=4";</script>';
                    }
                }
                if (isset($_SESSION['isAuth'])) {
                    echo '<a href="index.php?exit=yes" class="btn btn-primary">Вернуться к авторизации</a>';
                }
                if (isset($_GET['exit']) && $_GET['exit'] == 'yes') {
                    unset($_SESSION['isAuth']);
                }
                ?>
            </header>
        </div>
        <div class="row">
            <nav class="col-sm-12 col-md-12 col-lg-12">
                <?
                include_once "pages/menu.php";
                ?>
            </nav>
        </div>
        <div class="row">
            <section class="col-sm-12 col-md-12 col-lg-12">
                <?
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page == 1) include_once "pages/home.php";
                    if ($page == 2) include_once "pages/upload.php";
                    if ($page == 3) include_once "pages/gallery.php";
                    if ($page == 4) include_once "pages/registration.php";
                }
                ?>
            </section>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>