function validateFormLogIn() {
    let error = false;
    $(".class-error").remove();
    if ($("#defaultForm-email").val() === "" || !isEmail($("#defaultForm-email").val())) {
        $("#errorEmail").html("<span class='class-error'>Introduzca un email correcto</span>");
        error = true;
    }
    if ($("#defaultForm-pass").val() === "") {
        $("#errorPass").html("<span class='class-error'>Introduzca su contraseña</span>");
        error = true;
    }
    if (!error) {
        $("#logInButton").attr("disabled", false);
    } else {
        $("#logInButton").attr("disabled", true);
    }
}

function validateFormSignIn() {
    let error = false;
    let passError = false;
    $(".class-error").remove();
    if ($("#materialRegisterFormEmail").val() === "" || !isEmail($("#materialRegisterFormEmail").val())) {
        $("#errorEmailSingIn").html("<span class='class-error'>Introduzca un email válido</span>");
        error = true;
    }
    if ($("#materialRegisterFormLastName").val() === "") {
        $("#errorLastName").html("<span class='class-error'>Introduzca su apellido</span>");
        error = true;
    }
    if ($("#materialRegisterFormFirstName").val() === "") {
        $("#errorName").html("<span class='class-error'>Introduzca su nombre</span>");
        error = true;
    }
    if ($("#materialRegisterFormPassword").val() === "") {
        $("#errorPassSignIn").html("<span class='class-error'>Introduzca su contraseña</span>");
        error = true;
        passError = true;
    } else if ($("#materialRegisterFormPassword").val().length < 6) {
        $("#errorPassSignIn").html("<span class='class-error'>Su contraseña debe ser tener mas de 6 caracteres</span>");
        error = true;
        passError = true;
    }
    if ($("#materialRegisterFormCheckPassword").val() === "") {
        $("#errorRePass").html("<span class='class-error'>Repita su contraseña</span>");
        error = true;
        passError = true;
    }
    if (!passError && $("#materialRegisterFormCheckPassword").val() !== $("#materialRegisterFormPassword").val()) {
        $("#errorRePass").html("<span class='class-error'>Las contraseñas deben coincidir</span>");
        $("#errorPassSignIn").html("<span class='class-error'>Las contraseñas deben coincidir</span>");
        error = true;
    }
    if (!$('#defaultChecked2').prop('checked')) {
        $("#errorTerms").html("<span class='class-error'>Debes aceptar los términos y condiciones</span>");
        error = true;
    }

    if (!error) {
        $("#signInButton").attr("disabled", false);
    } else {
        $("#signInButton").attr("disabled", true);
    }
}


function isEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}