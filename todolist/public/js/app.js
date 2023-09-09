$(document).ready(function () {
    $('.update-form').submit(function (e) {
        e.preventDefault();
        var taskIdentifier = $(this).data('task-identifier');
        var newTitle = $(this).find('input[name="new_title"]');

        var formData = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            new_title: newTitle.val()
        };

        var liElement = $('.task-card[data-task-id="' + taskIdentifier + '"]');
        liElement.addClass('updating');


        $.ajax({
            url: '/updateTitle/' + taskIdentifier,
            type: 'PUT',
            data: formData,
            success: function (response) {
                $('.task-title[data-task-identifier="' + taskIdentifier + '"]').text(response.new_title);

                var currentDate = new Date();
                var formattedDate = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + (currentDate.getDate() < 10 ? '0' : '') + currentDate.getDate() + ' ' + currentDate.getHours() + ':' + currentDate.getMinutes() + ':' + currentDate.getSeconds();
                $('.task-date[data-task-identifier="' + taskIdentifier + '"]').text('Last Updated: ' + formattedDate);

                setTimeout(function () {
                    liElement.removeClass('updating');
                }, 2000);
                newTitle.val('')
            }
        });
    });
});
