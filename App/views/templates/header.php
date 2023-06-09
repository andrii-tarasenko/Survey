<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <title><?php echo $title;?></title>
    <script src="js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <?php if ($_SERVER['REQUEST_URI'] == '/sign-in.php' || $_SERVER['REQUEST_URI'] == '/login.php') {?>
        <script src="js/script.js"></script>
    <?php }?>
    <?php if ($_SERVER['REQUEST_URI'] == '/profile.php') {?>
        <script src="js/profile.js"></script>
    <?php }?>
    <script src="js/exit.js"></script>
</head>
<body>
<?php session_start();?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/index.php">Головна</a>
                </li>
                <?php if ($_SESSION['authenticated']) {?>
                    <?php if ($_SERVER['REQUEST_URI'] !== '/profile.php') {?>

                        <li class="nav-item">
                            <a class="nav-link" href="/profile.php">Особистий Кабінет</a>
                        </li>
                    <?php } ?>
                <?php }?>
                <?php if (!$_SESSION['authenticated']) {?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login.php">Увійти</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sign-in.php">Зареєструватися</a>
                    </li>
                <?php } else {?>
                    <li class="nav-item">
                        <a id="exit" class="nav-link" href="/">Вийти</a>
                    </li>
                <?php }?>
            </ul>
        </div>
    </nav>
</header>

