$(function () {

//     $.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
// options.async = true;
// });
    $('#modal-button-create').on('click', function () {
        $('#modal').modal('show')
            .find('#modal-content')
            .load($(this).attr('value'));
            // $('#modal').modal('show');


            // // $.get($(this).attr('value'), function (data) {
            // //     $("#modal-content").html(data);
            // //     // alert( "Load was performed." );
            // // });
               

            // $.ajax({
            //     url: $(this).attr('value'),
            //     type: 'get',
            //     async: true,
            //     success: function (data) {
            //         $("#modal-content").html(data);
            //     }

            // });
    });

    $('#modal-button-update').on('click', function () {
        // $('#modal').modal('show')
        //     .find('#modal-content')
        //     .load($(this).attr('value'));
            // $.get($(this).attr('value'), function (data) {
            //     $("#profile-edit").html(data);
            //     // alert( "Load was performed." );
            // });

        $('#modal').modal('show');

        $.ajax({
            url: $(this).attr('value'),
            type: 'get',
            async: false,
            success: function (data) {
                $("#modal-content").html(data);
                $('#profile-update-form').on('beforeSubmit', function(event, jqXHR, settings) {

                    var form = $(this);
                    if( form.find('.has-error').length) {
                        return false;
                    }

                    $.ajax({
                        url: form.attr('action'),
                        type: 'post',
                        data: form.serialize(),
                        async: false,
                        success: function(data) {
                            if (JSON.parse(data).status === 200) {
                                $('#modal').modal('hide');
                                // location.reload();
                                $.pjax.reload({container: "#flash-message", async:false});
                                $.pjax.reload({container: "#profile-content", async:false});
                            }
                            // form.parent().replaceWith(data);
                        }
                    });

                    return false;
                });
            }

        });
    });

    // $('#profile-create-form').on('beforeSubmit', function(event, jqXHR, settings) {

    //     var form = $(this);
    //     if( form.find('.has-error').length) {
    //         return false;
    //     }

    //     $.ajax({
    //         url: form.attr('action'),
    //         type: 'post',
    //         async: false,
    //         data: form.serialize(),
    //         success: function(data) {

    //             // $('#modal').modal('hide');
    //             // location.reload();
    //             // $.pjax.reload({container: "#prifle-content"});
    //             // form.parent().replaceWith(data);
    //             // if (JSON.parse(data).status === 201) {
    //             //     location.reload();
    //             // }
    //         }
    //     });

    //     return false;
    // });


});

// window.onload = function () {
    
// };