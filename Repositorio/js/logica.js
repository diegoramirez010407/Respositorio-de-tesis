$(document).ready(function () {
    alertify.defaults.transition = "slide";
    
    $("#Login").click(function (event) {
        let carrera = $("#Carrera").val();
        let noControl = $("#Password").val();
        if (carrera === "" && noControl === "") {
            event.preventDefault();
            let closable = alertify.alert().setting('closable');
            return alertify.alert()
                .setting({
                    'label': 'Ok!',
                    'message': 'Clave o usuario. ' + (closable ? ' ' : ' not ') + '¡Inválidos!',
                    'onok': function () { alertify.warning('Surgió un inconveniente.'); }
                }).show();
        } else if (carrera === "") {
            event.preventDefault();
            alertify.warning("Ingrese una clave");
        } else if (noControl === "") {
            event.preventDefault();
            alertify.warning("Ingrese su contraseña");
        } else {
            alertify.success("Bienvenido");
        }
    });

    /* Visualizar menu desplegable del perfil del usuario */
    $("#menuActive").click(function (event) {
        const toggleMenu = document.querySelector(".menu__profile");
        toggleMenu.classList.toggle("active");
    });

    $("#body").on('click', function () {
        const toggleMenu = document.querySelector(".menu__profile");
        toggleMenu.classList.remove("active");
    });
});

let materia, profesor, con, alu_carrera, grupo;
