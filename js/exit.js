$( document ).ready(function() {
    $('#exit').on('click', function(event) {
        // event.preventDefault();
        let deleteSession;
        deleteSession = true;
        $.ajax({
            type: 'POST',
            url: '/index.php',
            data: { deleteSession: deleteSession},
            success: function() {
            },
            error: function(xhr, status, error) {
                // console.log('Error:', error);
                // console.log('Помилка відправки запиту');
            }
        });
    });
});