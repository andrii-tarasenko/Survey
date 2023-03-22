<div class="col-md-<?php echo $_SERVER['REQUEST_URI'] == '/' ? '9 mx-auto' : '7'; ?>">
    <div id="alert_message"></div>
    <h1>Опитування</h1>
    <?php $i = 0; ?>
    <?php foreach ($surveys as $key => $survey) : ?>
        <?php $i++; ?>
        <div class="card" id="card_question_<?php echo $i;?>">
            <div class="card-header d-flex justify-content-between align-items-center" id="heading<?php echo $i; ?>">
                <h2 class="mb-0">
                    <button data-survey-name="<?php echo $key; ?>" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                        <?php echo $key; ?>
                    </button>
                </h2>
                <?php if ($_SERVER['REQUEST_URI'] !== '/') {?>
                    <div class="d-flex ml-auto mr-3">
                        <?php if ($survey['status'] == 'published') {?>
                            <button type="button" class="btn btn-outline-secondary btn-sm mr-1" aria-label="Чернетка" data-key="card_question_<?php echo $i;?>" data-survey-name="<?php echo $key; ?>">
                                Чернетка
                            </button>
                        <?php } else {?>
                            <button type="button" class="btn btn-outline-success btn-sm" aria-label="Опубліковано">
                                Опубліковано
                            </button>
                        <?php }?>
                    </div>
                    <button type="button" class="close" aria-label="Close" data-key="card_question_<?php echo $i;?>" data-survey-name="<?php echo $key; ?>">
                        <span aria-hidden="true">&times;</span>
                    </button>
                <?php }?>
            </div>
            <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
                <ul class="list-group">
                    <?php foreach ($survey['questions'] as $k => $value) : ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo $value['questions']; ?>
                            <span class="badge badge-primary badge-pill">
                                <?php echo $value['countOfVoices']; ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<script>
    document.querySelectorAll('.card-header button.close').forEach(function(button) {
        button.addEventListener('click', function(e) {
            $('.alert.alert-danger').remove();
            let surveyName = this.getAttribute('data-survey-name');
            let cardId = this.getAttribute('data-key');
            let card = document.getElementById(cardId);
            if (confirm('Ви впевнені, що хочете видалити опитування "' + surveyName + '"?')) {
                let deleteSurvey = {'action': 'removeSurveys', 'title': surveyName};
                $.ajax({
                    type: 'POST',
                    url: '/profile.php',
                    data: {deleteSurvey: deleteSurvey},
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.success == true) {
                            card.remove();
                        } else {
                            if (res.error == true) {
                                let errorDiv = $('<div class="alert alert-danger" role="alert"></div>');
                                errorDiv.text(res.message);
                                $('#alert_message').append(errorDiv);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                        console.log('Помилка відправки запиту');
                    }
                });
            }
        });
    });
</script>