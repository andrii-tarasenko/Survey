$( document ).ready(function() {
    $('#exit').on('click', function(event) {
        event.preventDefault();
        let deleteSession;
        deleteSession = true;
        $.ajax({
            type: 'POST',
            url: '/',
            data: {deleteSession: deleteSession},
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success == true) {
                    location.assign("/");
                }
            },
            error: function(xhr, status, error) {
                // console.log('Error:', error);
                // console.log('Помилка відправки запиту');
            }
        });
    });
});