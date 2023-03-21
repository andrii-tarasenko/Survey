$( document ).ready(function() {
// Вибираємо форму за її id або класом
    let form = $('form');

// Додаємо обробник подій для події submit форми
    form.on('submit', function(event) {
        // Зупиняємо стандартну поведінку форми (тобто перезавантаження сторінки)
        event.preventDefault();
        // event.stopPropagation();
        $('.alert.alert-danger').remove();
        $('.alert.alert-success').remove();
        // Отримуємо дані з форми
        let formData = form.serialize();

        // Відправляємо запит на сервер
        $.ajax({
            type: 'POST',
            url: 'profile.php',
            data: formData,
            success: function(response) {
                let res = JSON.parse(response);
                // acount created successfuly
                if (res.success == true) {
                    let successDiv = $('<div class="alert alert-success" role="alert"></div>');
                    successDiv.text(res.message);
                    $('#alert_message').append(successDiv);
                    setInterval(function() {
                        location.assign("/profile.php");
                    }, 1000);
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
    });
});