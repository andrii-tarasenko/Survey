<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <h1>Опитування</h1>
            <div class="accordion" id="accordionExample">
                <?php $i = 0;?>
                <?php foreach ($surveys as $key => $survey) {?>
                    <?php $i++;?>
                <div class="card">
                    <div class="card-header" id="heading<?php echo $i;?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapse<?php echo $i;?>" aria-expanded="true"
                                    aria-controls="collapse<?php echo $i;?>">
                                <?php echo $key;?>
                            </button>
                        </h2>
                    </div>



                        <div id='collapsexxxx' class='collapse' aria-labelledby='heading'
                            data-parent='#accordionExample'>
                            <div class='card-body'>
                                <p>Питання: </p>
                                <div class='form-group'>
                                    <label for='question567657'>gffffffffffffffffffffffffff</label>
                                    <input type="text" class="form-control" id="question567657" placeholder="bbbbbbbbbbbb">
                                    <small class="form-text text-muted">fggdfgdf</small>>
                               </div>
                            </div>
                        </div>


                </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-4">
            <h1>Створення опитування</h1>
            <form>
                <div class="form-group">
                    <label for="surveyTitle">Заголовок опитування</label>
                    <input type="text" name="surveyTitle" class="form-control" id="surveyTitle" placeholder="Введіть заголовок">
                </div>
                <div id="questions">
                    <div class="form-group question">
                        <label for="question">Питання 1</label>
                        <input type="text" name="question" class="form-control" id="question" placeholder="Введіть питання">
                        <label for="voice">Голос 1</label>
                        <input type="text" name="voice" class="form-control" id="voice" placeholder="Введіть потрібну кількість голосів">
                        <small class="form-text text-muted">Додайте опис питання</small>
                        <button type="button" class="btn btn-danger remove-question">Видалити питання</button>
                    </div>
                </div>
                <button type="button" class="btn btn-primary add-question">Додати питання</button>
                <button type="submit" class="btn btn-success">Створити опитування</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        let questionCount = 1;
        // Add question button
        $('.add-question').click(function () {
            questionCount++;

            let newQuestion = '<div class="form-group question">' +
                '<label for="question_' + questionCount + '">Питання ' + questionCount + '</label>' +
                '<input name="question_' + questionCount + '" type="text" class="form-control" id="question_' + questionCount + '" placeholder="Введіть питання">' +
                '<label for="voice_' + questionCount + '">Голос ' + questionCount + '</label>' +
                '<input type="text" name="voice_' + questionCount + '" class="form-control" id="voice_' + questionCount + '" placeholder="Введіть потрібну кількість голосів">' +
                '<small class="form-text text-muted">Додайте опис питання</small>' +
                '<button type="button" class="btn btn-danger remove-question">Видалити питання</button>' +
                '</div>';

            $('#questions').append(newQuestion);
        });

        // Remove question button
        $('#questions').on('click', '.remove-question', function () {
            $(this).closest('.question').remove();
            questionCount--;
        });
    });
</script>