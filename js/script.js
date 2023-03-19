$( document ).ready(function() {
// Вибираємо форму за її id або класом
    let form = $('form');

// Додаємо обробник подій для події submit форми
    form.on('submit', function(event) {
        // Зупиняємо стандартну поведінку форми (тобто перезавантаження сторінки)
        event.preventDefault();
        // event.stopPropagation();
        $('.alert.alert-danger').remove();
        // Отримуємо дані з форми
        let formData = form.serialize();

        // Відправляємо запит на сервер
        $.ajax({
            type: 'POST',
            url: 'sign-in.php',
            data: formData,
            success: function(response) {
                let res = JSON.parse(response);

                // acount created successfuly
                if (res.success == true) {
                    let successDiv = $('<div class="alert alert-success" role="alert"></div>');
                    successDiv.text(res.message);
                    $('#alert_message').append(successDiv);
                    setInterval(function() {
                        location.assign("personal.php");
                    }, 1000);

                } else { // error with registration
                    let errorDiv = $('<div class="alert alert-danger" role="alert"></div>');

                    // some error with validation email
                    if (res.message.email !== undefined) {
                        errorDiv.text(res.message.email);
                        $('#alert_message').append(errorDiv);
                    }

                    // some error with validation password
                    if (res.message.password !== undefined) {
                        errorDiv.text(res.message.password);
                        $('#alert_message').append(errorDiv);
                    }

                    // account allready exist
                    if (res.error == true) {
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