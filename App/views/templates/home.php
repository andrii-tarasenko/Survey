<main>
    <section class="jumbotron">
        <div class="container">
            <h1 class="display-4">Ласкаво просимо на сервіс опитувань!</h1>
            <p class="lead">Створіть опитування, змусьте друзів відповідати. Принижуйте, домінуйте властвуйте!</p>
            <hr class="my-4">
            <?php if ($user) {?>
                <a class="btn btn-primary btn-lg" href="#" role="button">Створити опитування</a>
            <?php }?>
        </div>
    </section>
    <?php if ($user) {?>
        <section class="container">
        <h2>Останні опитування</h2>
        <div class="row">
            <div class="col-sm-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="card-title">Назва опитування 1</h3>
                        <p class="card-text">Короткий опис опитування 1</p>
                        <a href="#" class="btn btn-primary">Детальніше</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="card-title">Назва опитування 2</
                    </div>
                </div>
    </section>
    <?php }?>
</main>
