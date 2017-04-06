$(document).ready(function () {
    // Form items
    var form = $('#inscription'),
            name = $('#name'),
            first_name = $('#first_name'),
            login = $('#login'),
            pass1 = $('#password1'),
            pass2 = $('#password2'),
            email = $('#email');


    // Quand on le 
    form.on('submit', function (e) {

        // Is everything entered correctly?
        if (!$('#inscription .form_group.succes').length == $('#inscription .form-group').length) {
            e.preventDefault();
        }
    });
    // Validation du nom
    name.on('blur', function () {
        if (!/^[a-zA-Z -']+$/.test(name.val())) {
            name.addClass('erreur').removeClass('succes');
        } else {
            name.removeClass('erreur').addClass('succes');
        }

    });
    // Validation du prénom
    first_name.on('blur', function () {
        if (!/^[a-zA-Z '-]+$/.test(first_name.val())) {
            first_name.addClass('erreur').removeClass('succes');
        } else {
            first_name.removeClass('erreur').addClass('succes');
        }

    });
    // Validation du login
    login.on('blur', function () {
        if (!/^[a-zA-Z0-9 _-]+$/.test(login.val())) {
            login.addClass('erreur').removeClass('succes');
        } else {
            login.removeClass('erreur').addClass('succes');
        }

    });

    // Validation du mail
    email.on('blur', function () {
        // simple validation d'email 
        if (!/^\S+@\S+\.\S+$/.test(email.val())) {
            email.addClass('erreur').removeClass('succes');
        } else {
            email.removeClass('erreur').addClass('succes');
        }
    });

    //Validation du premier mot de passe avec complexité minimale

    pass1.complexify({minimumChars: 6, strengthScaleFactor:0.7}, function (valid, complexity) {
        var barre = $('#complexity-bar');
        if (valid) {
            barre.addClass('progress-bar-success').removeClass('progress-bar-danger');
            pass2.removeAttr('disabled');

            pass1.removeClass('erreur')
                    .addClass('succes');
        } else {
            barre.removeClass('progress-bar-success').addClass('progress-bar-danger');
            pass2.attr('disabled', 'true');

            pass1.removeClass('succes')
                    .addClass('erreur');
        }
        var prop=complexity+'%';
        barre.css('width', prop);
    });
    // Validation du second mot de passe 
    pass2.on('keydown input', function () {

        // Make sure it equals the first
        if (pass2.val() == pass1.val()) {

            pass2.removeClass('erreur')
                    .addClass('succes');
        } else {
            pass2.removeClass('succes')
                    .addClass('erreur');
        }
    });

});

