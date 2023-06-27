$(document).ready(function () {
    $('#insert_user_form').submit(function (e) {
        e.preventDefault();
        var data = $(this).serializeArray();
        $.ajax({
            type: "post",
            url: "./ajax_submit.php",
            data: { 'insert__form': data },
            success: function (response) {
                if (response == 1) {
                    $('.result_alerts').addClass('alert-success');
                    $('.result_alerts').html('Registration Successfull').fadeIn(100);
                    setTimeout(function () {
                        $('.result_alerts').fadeOut('slow', function () {
                            $('.result_alerts').remove();
                        });
                    }, 3000);
                    $("#insert_user_form").trigger("reset");
                }

                if (response == 0) {
                    $('.result_alerts').addClass('alert-danger');
                    $('.result_alerts').html('Registration Failed! Try again').fadeIn(100);
                    setTimeout(function () {
                        $('.result_alerts').fadeOut('slow', function () {
                            $('.result_alerts').remove();
                        });
                    }, 3000);
                    $("#insert_user_form").trigger("reset");
                }

            }
        });
    });
    $('#user_email').change(function (e) {
        e.preventDefault();
        $check_mail = $(this).val();
        $.ajax({
            type: "post",
            url: "./ajax_submit.php",
            data: { "c_email": $check_mail },
            success: function (response) {
                if (response == 1) {
                    $(this).val("");
                    $('.result_alerts').addClass('alert-danger');
                    $('.result_alerts').html('Email already exits! Use different email').fadeIn(100);
                    setTimeout(function () {
                        $('.result_alerts').fadeOut('slow', function () {
                            $('.result_alerts').remove();
                        });
                    }, 3000);
                    $("#insert_user_form").trigger("reset");
                }
            }
        });
    });
    $('#edit_user_form').submit(function (e) {
        e.preventDefault();
        var data = $(this).serializeArray();
        $.ajax({
            type: "post",
            url: "./ajax_submit.php",
            data: { 'edit__form': data },
            success: function (response) {
                if (response == 1) {
                    $('.result_alerts').addClass('alert-success');
                    $('.result_alerts').html('Updation Successfull').fadeIn(100);
                    setTimeout(function () {
                        $('.result_alerts').fadeOut('slow', function () {
                            $('.result_alerts').remove();
                        });
                    }, 3000);
                    window.location.reload();
                }

                if (response == 0) {
                    $('.result_alerts').addClass('alert-danger');
                    $('.result_alerts').html('Updation Failed! Try again').fadeIn(100);
                    setTimeout(function () {
                        $('.result_alerts').fadeOut('slow', function () {
                            $('.result_alerts').remove();
                        });
                    }, 3000);
                }

            }
        });
    });
    var maxGroup = 10;
    //add more fields group
    $(".addMore").click(function () {
        if ($('body').find('.fieldGroup').length < maxGroup) {
            var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() + '</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        } else {
            alert('Maximum ' + maxGroup + ' groups are allowed.');
        }
    });

    //remove fields group
    $("body").on("click", ".remove", function () {
        $(this).parents(".fieldGroup").remove();
    });
});