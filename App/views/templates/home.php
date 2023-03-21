<main>
    <section class="jumbotron">
        <div class="container">
            <h1 class="display-4">Ласкаво просимо на сервіс опитувань!</h1>
            <p class="lead">Створіть опитування, змусьте друзів відповідати. Принижуйте, домінуйте властвуйте!</p>
            <hr class="my-4">
            <?php if ($_SESSION['authenticated']) {?>
                <a class="btn btn-primary btn-lg" href="/profile.php" role="button">Створити опитування</a>
            <?php }?>
        </div>

    </section>
<!--    <section class="container">-->
        <?php require_once ('surveys.php');?>
<!--    </section>-->
</main>
