(function($) {
    "use strict";


    /*==================================================================
    [ Focus input ]*/
    $('.input100').each(function() {
        $(this).on('blur', function() {
            if ($(this).val().trim() != "") {
                $(this).addClass('has-val');
            } else {
                $(this).removeClass('has-val');
            }
        })
    })


    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit', function() {
        var check = true;

        for (var i = 0; i < input.length; i++) {
            if (validate(input[i]) == false) {
                showValidate(input[i]);
                check = false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function() {
        $(this).focus(function() {
            hideValidate(this);
        });
    });

    function validate(input) {
        if ($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if ($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        } else {
            if ($(input).val().trim() == '') {
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

    /*==================================================================
    [ Show pass ]*/
    function show() {
        var p = document.getElementById('password');
        p.setAttribute('type', 'text');
    }

    function hide() {
        var p = document.getElementById('password');
        p.setAttribute('type', 'password');
    }

    var pwShown = 0;

    document.getElementById("eye").addEventListener("click", function() {
        if (pwShown == 0) {
            pwShown = 1;
            document.getElementById("i").classList.add("zmdi-eye-off");
            document.getElementById("i").classList.remove("zmdi-eye");
            show();
        } else {
            pwShown = 0;
            document.getElementById("i").classList.add("zmdi-eye");
            document.getElementById("i").classList.remove("zmdi-eye-off");
            hide();
        }
    }, false);

    document.getElementById("eye1").addEventListener("click", function() {
        if (pwShown == 0) {
            pwShown = 1;
            document.getElementById("i1").classList.add("zmdi-eye-off");
            document.getElementById("i1").classList.remove("zmdi-eye");
            show();
        } else {
            pwShown = 0;
            document.getElementById("i1").classList.add("zmdi-eye");
            document.getElementById("i1").classList.remove("zmdi-eye-off");
            hide();
        }
    }, false);

    document.getElementById("eye2").addEventListener("click", function() {
        if (pwShown == 0) {
            pwShown = 1;
            document.getElementById("i2").classList.add("zmdi-eye-off");
            document.getElementById("i2").classList.remove("zmdi-eye");
            show();
        } else {
            pwShown = 0;
            document.getElementById("i2").classList.add("zmdi-eye");
            document.getElementById("i2").classList.remove("zmdi-eye-off");
            hide();
        }
    }, false);

})(jQuery);