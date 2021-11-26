$("#signup-form").submit(function(event) {
    event.preventDefault();
    if ((!$("#signup-form button[type='submit']").hasClass("disabled")) && ($("#signup-form input[name='repeat_password']").val() == $("#signup-form input[name='password']").val())) {
        $("#signup-form button[type='submit']").addClass("disabled");
        $("#signup-form button[type='submit']").html("<img src='" + baseURL + "assets/img/loader-ball.gif' style='width:30px;'>");
        $.ajax({
            type: "POST",
            url: baseURL + "register/new-user",
            data: $(this).serialize(), // serializes the form's elements.,
            dataType: "json",
            success: function(data) {
                if (data.status == "existed") {
                    $("#signup-form label.user-exist").show();
                    $("#signup-form button[type='submit']").removeClass("disabled");
                    $("#signup-form button[type='submit']").html("Register Account");
                } else {
                    $("#signup-form label.user-exist").hide();
                    $("#signup-form button[type='submit']").removeClass("disabled");
                    $("#signup-form button[type='submit']").html("Register Account");
                    $('#signup-form').trigger("reset");
                    Swal.fire({
                        icon: 'success',
                        title: 'Conratulations!',
                        html: "You are now successfully registered. Please visit your email to verify your account.",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    setTimeout(function() {
                        window.location.href = baseURL + "login";
                    }, 2000);
                }
            }
        });
    } else {
        if ($("#signup-form input[name='repeat_password']").val() != $("#signup-form input[name='password']").val()) {
            $("#signup-form label.not-match").show();
        } else {
            $("#signup-form label.not-match").hide();
        }
    }
});

$("#signup-form input[name='repeat_password']").keyup(function() {
    if ($("#signup-form input[name='repeat_password']").val() != $("#signup-form input[name='password']").val()) {
        $("#signup-form label.not-match").show();
    } else {
        $("#signup-form label.not-match").hide();
    }
});