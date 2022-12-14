$(document).ready(function () {

    // Variable que captura la opcion a realizar
    var opcion;
    //captura la fila, para editar o eliminar
    var fila;

    // Variables de Materias
    var clv_profesor, nom_profesor, clv_depto, clave_especialidad;

    // Variables de alumnos
    var no_control, nom_alumno, clv_especialidad;

    // Variables de grupos
    var id_grupo, id_materia, clave_grupo, clave_profesor, total_alumnos;

    // Variables de carga de alumnos
    var id_carga, noControl, clave_materia, clv_grupo;

    // Variables de preguntas
    var id_pregunta, pregunta, tipo_pregunta;
    
    // Variables de preguntas
    var cuestionario, cuestionario_estado, referencia;
    
    // Variables de administrador
    var clv_administrador, nom_administrador, rol_administrador;

    /* ------------------------------------- INICIO PROFESORES ----------------------------------- */
    // Carga de datos a la tabla de Profesores
    tbProfesores = $("#tbProfesores").DataTable({
        responsive: true,
        autoWidth: false,
        "processing": true,
        "serverSide": true,
        "sAjaxSource": "serverside/serversideProfesores.php",
        "columnDefs": [{
            "targets": -1,
            "defaultContent": "<div class='wrapper text-center'><div class='btn-group'>" +
                "<button class='btn btn-info btn-sm btnEditarProfesor' data-toggle='tooltip' title='Editar'>" +
                "<i class='bx bx-edit'></i></button>&ensp;" +
                "<button class='btn btn-danger btn-sm btnEliminarProfesor' data-toggle='tooltip' title='Eliminar'>" +
                "<i class='bx bx-trash'></i></button></div></div>"
        }],
    });

    // Visualizar el formulario para cargar el excel Profesores
    $("#btnExcelProfesores").click(function () {
        $("#frmProfesoresxls").show();
    });

    // Ocultar el formulario para cargar el excel de Profesores
    $("#btnCancelarProfesores").click(function () {
        $("#frmProfesoresxls").hide();
    });

    // Seleccionar archivo de excel de Profesores
    document.getElementById("input-profesores").addEventListener("change", (e) => {
        let fileName = document.getElementById("input-profesores").value;
        let puntoExtension = fileName.lastIndexOf(".") + 1;
        let extFile = fileName.substr(puntoExtension, fileName.length).toLowerCase();
        if (extFile == "xlsx" || extFile == "xlsb" || extFile == "xls") {
            let closable = alertify.alert().setting('closable');
            alertify.alert()
                .setting({
                    'label': 'Ok!',
                    'message': 'Archivo ' + fileName.split('\\').pop() + ' ' + (closable ? ' ' : ' not ') + 'seleccionado correctamente.',
                    'onok': function () { alertify.success('Excelente...'); }
                }).show();
        } else {
            let closable = alertify.alert().setting('closable');
            document.getElementById("input-profesores").value = '';
            alertify.alert()
                .setting({
                    'label': 'Ok!',
                    'message': 'Solo se aceptan archivos de Excel.' + (closable ? ' ' : '') + ' Vuelva a intentarlo.',
                    'onok': function () { alertify.error('Lo sentimos...'); }
                }).show();
        }
    });

    //Limpiar los campos del formulario Profesores
    $("#btnNuevoProfesor").click(function () {
        opcion = "agregarProfesor";
        $("#frmProfesores").trigger("reset");
        $(".modal-header").css("background-color", "#E0E0E0");
        $(".modal-header").css("color", "black");
        $(".modal-title").text("Alta de Profesor");
        $('#editarProfesor').modal('show');
        $("#clv_profesor").prop("disabled", false);
    });

    // Agregar o actualizar un Profesor
    $('#frmProfesores').submit(function (e) {
        e.preventDefault();
        clv_profesor = $.trim($('#clv_profesor').val());
        nom_profesor = $.trim($('#nom_profesor').val());
        clv_depto = $.trim($('#clv_depto').val());
        clave_especialidad = $.trim($('#clave_especialidad').val());
        if (clv_profesor !== "" && nom_profesor !== ""
            && clv_depto !== "" && clave_especialidad !== "") {
            $.ajax({
                url: "serverside/serversideServidor.php",
                type: "POST",
                datatype: "json",
                data: {
                    clv_profesor: clv_profesor, nom_profesor: nom_profesor,
                    clv_depto: clv_depto, clave_especialidad: clave_especialidad, opcion: opcion
                },
                success: function (data) {
                    tbProfesores.ajax.reload(null, false);
                }
            });
            $('#editarProfesor').modal('hide');
        } else {
            alertify.warning("Todos los datos son obligatorios");
        }

    });

    //Capturar un profesor para actualizar        
    $(document).on("click", ".btnEditarProfesor", function () {
        opcion = "actualizarProfesor";
        fila = $(this).closest("tr");
        clv_profesor = parseInt(fila.find('td:eq(0)').text());
        nom_profesor = fila.find('td:eq(1)').text();
        clv_depto = parseInt(fila.find('td:eq(2)').text());
        clave_especialidad = parseInt(fila.find('td:eq(3)').text());
        $("#clv_profesor").val(clv_profesor).prop("disabled", true);
        $("#nom_profesor").val(nom_profesor);
        $("#clv_depto").val(clv_depto);
        $("#clave_especialidad").val(clave_especialidad);
        $(".modal-header").css("background-color", "#E0E0E0");
        $(".modal-header").css("color", "black");
        $(".modal-title").text("Actualizar Profesor");
        $('#editarProfesor').modal('show');
    });

    // Eliminar un profesor
    $(document).on("click", ".btnEliminarProfesor", function () {
        fila = $(this);
        clv_profesor = parseInt(fila.closest('tr').find('td:eq(0)').text());
        nom_profesor = fila.closest('tr').find('td:eq(1)').text();
        opcion = "eliminarProfesor";
        alertify.confirm("¿Está seguro de eliminar al profesor con clave "
            + clv_profesor + " " + nom_profesor + "?",
            function (respuesta) {
                if (respuesta) {
                    $.ajax({
                        url: "serverside/serversideServidor.php",
                        type: "POST",
                        datatype: "json",
                        data: { opcion: opcion, clv_profesor: clv_profesor },
                        success: function () {
                            tbProfesores.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        );
    });
    
    // Eliminar todos los profesores
    $(document).on("click", "#btnborrarProfesores", function () {
        opcion = "eliminarProfesores";
        alertify.confirm("¿Está seguro de eliminar todos los profesores de la base de datos?",
            function (){
                $.ajax({
                    url: "serverside/serversideServidor.php",
                    type: "POST",
                    datatype: "json",
                    data: {opcion: opcion},
                    success: function () {
                        alertify.alert("!Todos los profesores han sido eliminados¡");
                        tbProfesores.ajax.reload();
                        alertify.success("Proceso exitoso");
                    }
                });
            } 
        );
    });
    
    /* ------------------------------------- FIN PROFESORES ----------------------------------- */

    /* ------------------------------------- INICIO ALUMNOS ----------------------------------- */
    // Carga de datos en la tabla Alumnos
    tbAlumnos = $("#tbAlumnos").DataTable({
        responsive: true,
        autoWidth: false,
        "processing": true,
        "serverSide": true,
        "sAjaxSource": "serverside/serversideAlumnos.php",
        "columnDefs": [{
            "targets": -1,
            "defaultContent": "<div class='wrapper text-center'><div class='btn-group'>" +
                "<button class='btn btn-info btn-sm btnEditarAlumno' data-toggle='tooltip' title='Editar'>" +
                "<i class='bx bx-edit'></i></button>&ensp;" +
                "<button class='btn btn-danger btn-sm btnEliminarAlumno' data-toggle='tooltip' title='Eliminar'>" +
                "<i class='bx bx-trash'></i></button></div></div>"
        }],
    });

    // Visualizar el formulario para cargar el excel Alumnos
    $("#btnExcel").click(function () {
        $("#frmAlumnosxls").show();
    });

    // Ocultar el formulario para cargar el excel de Alumnos
    $("#btnCancelar").click(function () {
        $("#frmAlumnosxls").hide();
    });

    // Seleccionar archivo de excel de Alumnos
    document.getElementById("input-alumnos").addEventListener("change", (e) => {
        let fileName = document.getElementById("input-alumnos").value;
        let puntoExtension = fileName.lastIndexOf(".") + 1;
        let extFile = fileName.substr(puntoExtension, fileName.length).toLowerCase();
        if (extFile == "xlsx" || extFile == "xlsb") {
            //get the closable setting value.
            let closable = alertify.alert().setting('closable');
            //grab the dialog instance using its parameter-less constructor then set multiple settings at once.
            alertify.alert()
                .setting({
                    'label': 'Ok!',
                    'message': 'Archivo ' + fileName.split('\\').pop() + ' ' + (closable ? ' ' : ' not ') + 'seleccionado correctamente.',
                    'onok': function () { alertify.success('Excelente...'); }
                }).show();
        } else {
            let closable = alertify.alert().setting('closable');
            document.getElementById("input-alumnos").value = '';
            alertify.alert()
                .setting({
                    'label': 'Ok!',
                    'message': 'Solo se aceptan archivos de Excel.' + (closable ? ' ' : '') + ' Vuelva a intentarlo.',
                    'onok': function () { alertify.error('Lo sentimos...'); }
                }).show();
        }
    });

    // Limpiar los campos antes de dar de alta a un alumno
    $("#btnNuevo").click(function () {
        opcion = "agregarAlumno";
        $("#frmAlumnos").trigger("reset");
        $(".modal-header").css("background-color", "#E0E0E0");
        $(".modal-header").css("color", "black");
        $(".modal-title").text("Alta de Alumno");
        $('#editarAlumno').modal('show');
        $("#no_control").prop("disabled", false);
    });

    // Agregar o actualizar un Alumno
    $('#frmAlumnos').submit(function (e) {
        e.preventDefault();
        no_control = $.trim($('#no_control').val());
        nom_alumno = $.trim($('#nom_alumno').val());
        clv_especialidad = $.trim($('#clv_especialidad').val());
        if (noControl !== "" && nom_alumno !== "" && clv_especialidad !== "") {
            $.ajax({
                url: "serverside/serversideServidor.php",
                type: "POST",
                datatype: "json",
                data: { no_control: no_control, nom_alumno: nom_alumno, clv_especialidad: clv_especialidad, opcion: opcion },
                success: function (data) {
                    tbAlumnos.ajax.reload(null, false);
                }
            });
            $('#editarAlumno').modal('hide');
        } else {
            alertify.warning("Todos los campos son obligatorios");
        }
    });

    //Capturar el alumno para actualizar        
    $(document).on("click", ".btnEditarAlumno", function () {
        opcion = "actualizarAlumno";
        fila = $(this).closest("tr");
        no_control = parseInt(fila.find('td:eq(0)').text());
        nom_alumno = fila.find('td:eq(1)').text();
        clv_especialidad = fila.find('td:eq(2)').text();
        $("#no_control").val(no_control).prop("disabled", true);
        $("#nom_alumno").val(nom_alumno);
        $("#clv_especialidad").val(clv_especialidad);
        $(".modal-header").css("background-color", "#E0E0E0");
        $(".modal-header").css("color", "black");
        $(".modal-title").text("Actualizar Usuario");
        $('#editarAlumno').modal('show');
    });

    // Eliminar a un Alumno
    $(document).on("click", ".btnEliminarAlumno", function () {
        fila = $(this);
        no_control = parseInt($(this).closest('tr').find('td:eq(0)').text());
        opcion = "eliminarAlumno"; //eliminar        
        alertify.confirm("¿Está seguro de borrar el registro " + no_control + "?",
            function (respuesta) {
                if (respuesta) {
                    $.ajax({
                        url: "serverside/serversideServidor.php",
                        type: "POST",
                        datatype: "json",
                        data: { opcion: opcion, no_control: no_control },
                        success: function () {
                            tbAlumnos.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        );
    });
    
    // Eliminar todos los alumnos
    $(document).on("click", "#btnborrarAlumnos", function () {
        opcion = "eliminarAlumnos";
        alertify.confirm("¿Está seguro de eliminar todos los alumnos de la base de datos?",
            function (){
                $.ajax({
                    url: "serverside/serversideServidor.php",
                    type: "POST",
                    datatype: "json",
                    data: {opcion: opcion},
                    success: function () {
                        alertify.alert("!Todos los alumnos han sido eliminados¡");
                        tbAlumnos.ajax.reload();
                        alertify.success("Proceso exitoso");
                    }
                });
            } 
        );
    });
    
    /* ------------------------------------- FIN ALUMNOS ----------------------------------- */

    /* ------------------------------------- INICIO TRABAJOS ----------------------------------- */
    // Carga de datos en la tabla de Grupos
    tbGrupos = $("#tbGrupos").DataTable({
        responsive: true,
        autoWidth: false,
        "processing": true,
        "serverSide": true,
        "sAjaxSource": "serverside/serversideGrupos.php",
        "columnDefs": [{
            "targets": -1,
            "defaultContent": "<div class='wrapper text-center'><div class='btn-group'>" +
                "<button class='btn btn-info btn-sm btnEditarGrupo' data-toggle='tooltip' title='Editar'>" +
                "<i class='bx bx-edit'></i></button>&ensp;" +
                "<button class='btn btn-danger btn-sm btnEliminarGrupo' data-toggle='tooltip' title='Eliminar'>" +
                "<i class='bx bx-trash'></i></button></div></div>"
        }],
    });

    // Visualizar el formulario para cargar el excel Grupos
    $("#btnExcelGrupo").click(function () {
        $("#frmGruposxls").show();
    });

    // Ocultar el formulario para cargar el excel Grupos
    $("#btnCancelarGrupos").click(function () {
        $("#frmGruposxls").hide();
    });

    // Seleccionar archivo de excel de Grupos
    document.getElementById("input-grupos").addEventListener("change", (e) => {
        let fileName = document.getElementById("input-grupos").value;
        let puntoExtension = fileName.lastIndexOf(".") + 1;
        let extFile = fileName.substr(puntoExtension, fileName.length).toLowerCase();
        if (extFile == "xlsx" || extFile == "xlsb" || extFile == "xls") {
            let closable = alertify.alert().setting('closable');
            alertify.alert()
                .setting({
                    'label': 'Ok!',
                    'message': 'Archivo ' + fileName.split('\\').pop() + ' ' + (closable ? ' ' : ' not ') + 'seleccionado correctamente.',
                    'onok': function () { alertify.success('Excelente...'); }
                }).show();
        } else {
            let closable = alertify.alert().setting('closable');
            document.getElementById("input-grupos").value = '';
            alertify.alert()
                .setting({
                    'label': 'Ok!',
                    'message': 'Solo se aceptan archivos de Excel.' + (closable ? ' ' : '') + ' Vuelva a intentarlo.',
                    'onok': function () { alertify.error('Lo sentimos...'); }
                }).show();
        }
    });

    // Limpiar los campos antes de dar de alta un Grupo
    $("#btnNuevoGrupo").click(function () {
        opcion = "agregarGrupo";
        $("#frmGrupos").trigger("reset");
        $(".modal-header").css("background-color", "#E0E0E0");
        $(".modal-header").css("color", "black");
        $(".modal-title").text("Alta de Trabajo");
        $('#editarGrupo').modal('show');
        $('#id_grupo').prop("disabled", true);
    });

    // Agregar o actualizar un Grupo
    $('#frmGrupos').submit(function (e) {
        e.preventDefault();
        id_grupo = $.trim($("#id_grupo").val());
        id_materia = $.trim($('#id_materia').val());
        clave_grupo = $.trim($('#clave_grupo').val());
        clave_profesor = $.trim($('#clave_profesor').val());
        total_alumnos = $.trim($("#total_alumnos").val());
        if (id_materia !== "" && clave_grupo !== "" && clave_profesor !== "" && total_alumnos !== "") {
            $.ajax({
                url: "serverside/serversideServidor.php",
                type: "POST",
                datatype: "json",
                data: {id_grupo: id_grupo,id_materia: id_materia, clave_grupo: clave_grupo,
                    clave_profesor: clave_profesor, total_alumnos: total_alumnos, opcion: opcion},
                success: function (data) {
                    tbGrupos.ajax.reload(null, false);
                }
            });
            $('#editarGrupo').modal('hide');
        } else {
            alertify.warning("Todos los campos son obligatorios");
        }
    });

    // Capturar el Grupo para actualizar        
    $(document).on("click", ".btnEditarGrupo", function () {
        opcion = "actualizarGrupo";
        fila = $(this).closest("tr");
        id_grupo = parseInt(fila.find('td:eq(0)').text());
        clave_grupo = fila.find('td:eq(1)').text();
        id_materia = fila.find('td:eq(2)').text();
        clave_profesor = parseInt(fila.find('td:eq(3)').text());
        total_alumnos = parseInt(fila.find('td:eq(4)').text());
        $("#id_grupo").val(id_grupo).prop("disabled", true);
        $("#clave_grupo").val(clave_grupo);
        $("#id_materia").val(id_materia);
        $("#clave_profesor").val(clave_profesor);
        $("#total_alumnos").val(total_alumnos);
        $(".modal-header").css("background-color", "#E0E0E0");
        $(".modal-header").css("color", "black");
        $(".modal-title").text("Actualizar Trabajo");
        $('#editarGrupo').modal('show');
    });

    // Eliminar un Grupo
    $(document).on("click", ".btnEliminarGrupo", function () {
        fila = $(this);
        id_grupo = parseInt($(this).closest('tr').find('td:eq(0)').text());
        opcion = "eliminarGrupo"; //eliminar        
        alertify.confirm("¿Está seguro de borrar el registro " + id_grupo + "?",
            function (respuesta) {
                if (respuesta) {
                    $.ajax({
                        url: "serverside/serversideServidor.php",
                        type: "POST",
                        datatype: "json",
                        data: { opcion: opcion, id_grupo: id_grupo },
                        success: function () {
                            tbGrupos.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        );
    });
    
    // Eliminar todos los grupos
    $(document).on("click", "#btnborrarGrupos", function () {
        opcion = "eliminarGrupos";
        alertify.confirm("¿Está seguro de eliminar todos los grupos de la base de datos?",
            function (){
                $.ajax({
                    url: "serverside/serversideServidor.php",
                    type: "POST",
                    datatype: "json",
                    data: {opcion: opcion},
                    success: function () {
                        alertify.alert("!Todos los grupos han sido eliminados¡");
                        tbGrupos.ajax.reload();
                        alertify.success("Proceso exitoso");
                    }
                });
            } 
        );
    });
    
    /* ------------------------------------- FIN TRABAJOS ----------------------------------- */
    
});

/* Carga de excel de profesores */
function excel_profesores() {
    let archivo = document.getElementById("input-profesores").value;
    if (archivo.length == 0) {
        let closable = alertify.alert().setting('closable');
        return alertify.alert()
            .setting({
                'label': 'Ok!',
                'message': 'Error al cargar los datos. ' + (closable ? ' ' : ' not ') + '¡Por favor seleccione un archivo!',
                'onok': function () { alertify.warning('Surgió un inconveniente.'); }
            }).show();
    } else {
        let formData = new FormData();
        let archivo_excel = $('#input-profesores')[0].files[0];
        formData.append('profesores', archivo_excel);
        $.ajax({
            url: 'php/excel_profesores.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (resp) {
                let closable = alertify.alert().setting('closable');
                alertify.alert()
                    .setting({
                        'label': 'Ok!',
                        'message': 'Carga de datos' + (closable ? ' ' : '') + ' completa',
                        'onok': function () { alertify.success('Grandioso..'); }
                    }).show();
                document.getElementById("input-profesores").value = '';
                tbProfesores.ajax.reload();
            }
        });
        return false;
    }
}

/* Carga de excel de alumnos */
function excel_alumnos() {
    let archivo = document.getElementById("input-alumnos").value;
    if (archivo.length == 0) {
        let closable = alertify.alert().setting('closable');
        //grab the dialog instance using its parameter-less constructor then set multiple settings at once.
        return alertify.alert()
            .setting({
                'label': 'Ok!',
                'message': 'Error al cargar los datos. ' + (closable ? ' ' : ' not ') + '¡Por favor seleccione un archivo!',
                'onok': function () { alertify.warning('Surgió un inconveniente.'); }
            }).show();
    } else {
        let formData = new FormData();
        let archivo_excel = $('#input-alumnos')[0].files[0];
        formData.append('excel', archivo_excel);
        $.ajax({
            url: 'php/excel_alumnos.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (resp) {
                //alertify.message(resp);
                let closable = alertify.alert().setting('closable');
                alertify.alert()
                    .setting({
                        'label': 'Ok!',
                        'message': 'Carga de datos' + (closable ? ' ' : '') + ' completa',
                        'onok': function () { alertify.success('Grandioso..'); }
                    }).show();
                document.getElementById("input-alumnos").value = '';
                tbAlumnos.ajax.reload();
            }
        });
        return false;
    }
}

/* Carga de excel de grupos */
function excel_grupos() {
    let archivo = document.getElementById("input-grupos").value;
    if (archivo.length == 0) {
        let closable = alertify.alert().setting('closable');
        return alertify.alert()
            .setting({
                'label': 'Ok!',
                'message': 'Error al cargar los datos. ' + (closable ? ' ' : ' not ') + '¡Por favor seleccione un archivo!',
                'onok': function () { alertify.warning('Surgió un inconveniente.'); }
            }).show();
    } else {
        let formData = new FormData();
        let archivo_excel = $('#input-grupos')[0].files[0];
        formData.append('grupos', archivo_excel);
        $.ajax({
            url: 'php/excel_grupos.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (resp) {
                let closable = alertify.alert().setting('closable');
                alertify.alert()
                    .setting({
                        'label': 'Ok!',
                        'message': 'Carga de datos' + (closable ? ' ' : '') + ' completa',
                        'onok': function () { alertify.success('Grandioso..'); }
                    }).show();
                document.getElementById("input-grupos").value = '';
                tbGrupos.ajax.reload();
            }
        });
        return false;
    }
}