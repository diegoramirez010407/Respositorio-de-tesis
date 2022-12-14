<?php
include 'serverside/paginacion.php';
include_once 'serverside/conexionDatos.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

session_start();

if (!isset($_SESSION['no_control'])) {
    header("Location: ../index.html");
    exit();
}

if (isset($_SESSION['no_control']) && isset($_SESSION['clv_especialidad'])) {
    $control = $_SESSION['no_control'];
    $usuario_rol = $_SESSION['usuario_rol'];
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Control de Residencia Profesional</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../img/favicon-32x32.png">
        <link rel="stylesheet" href="../css/adminlte.min.css">
        <link rel="stylesheet" href="../css/alertify.css">
        <link rel="stylesheet" href="../css/alertify.min.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

        <!--========== CSS ==========-->
        <link rel="stylesheet" href="../css/content.css">

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!--========== HEADER ==========-->
            <header class="header">
                <div class="header__container">

                    <a href="#" class="header__logo">Tecnológico de Estudios Superiores de San Felipe del Progreso</a>

                    <div class="action">
                        <div class="profile" id="menuActive">
                            <img src="../img/perfil.jpg" alt="" class="header__img">
                        </div>
                        <div class="menu__profile" id="menu__profile">
                            <ul>
                                <h4>
                                    <p><?php echo $_SESSION['nom_usuario']; ?></p>
                                    <input type="text" id="control-alumno" value="<?php echo $control ?>" hidden>
                                    <span><?php if ($usuario_rol == 'ADMINISTRADOR') { echo 'Departamento de Desarrollo Académico del TESSFP'; } else { echo 'Estudiante del TESSFP'; }?></span>
                                </h4>
                                <li><i class='bx bx-log-out'></i><a href="php/logout.php" class="submenu__profile">Cerrar sesión</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="header__toggle">
                        <i class='bx bx-menu' id="header-toggle"></i>
                    </div>
                </div>
            </header>

            <!--========== NAV ==========-->
            <div class="nav" id="navbar">
                <nav class="nav__container">
                    <div>
                        <a href="#" class="nav__link nav__logo">
                            <i class='bx bxs-disc nav__icon'></i>
                            <span class="nav__logo-name">TESSFP</span>
                        </a>
                        <div class="nav__list">
                            <div class="nav__items">
                                <!-- Menu Administrador -->
                                <?php if ($usuario_rol == 'ADMINISTRADOR') { ?>
                                    <!-- Menu Tablas -->
                                    <div class="nav__dropdown">
                                        <a href="#" class="nav__link">
                                            <i class='bx bx-table nav__icon'></i>
                                            <span class="nav__name">Administración</span>
                                            <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                        </a>
                                        <div class="nav__dropdown-collapse">
                                            <div class="nav__dropdown-content">
                                                <a href="#" class="nav__dropdown-item" id="verProfesores">Profesores</a>
                                                <a href="#" class="nav__dropdown-item" id="verAlumnos">Alumnos</a>
                                                <a href="#" class="nav__dropdown-item" id="verGrupos">Trabajos</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <!-- Menu Alumno -->
                                <?php if ($usuario_rol == 'ALUMNO') { ?>
                                    <!-- Menu Tablas -->
                                    <div class="nav__dropdown">
                                        <a href="#" class="nav__link">
                                            <i class='bx bx-table nav__icon'></i>
                                            <span class="nav__name">Administración</span>
                                            <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                        </a>
                                        <div class="nav__dropdown-collapse">
                                            <div class="nav__dropdown-content">
                                                <a href="#" class="nav__dropdown-item" id="verGrupos">Trabajos</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                
                            </div>
                        </div>
                    </div>
                    <a href="php/logout.php" class="nav__link nav__logout">
                        <i class='bx bx-log-out nav__icon'></i>
                        <span class="nav__name">Log Out</span>
                    </a>
                </nav>
            </div>

            <!--========== CONTENTS ==========-->
            <main class="main__redimencionar" id="body">
                <section class="content">
                    
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <strong>Hola!</strong> Bienvenido Al Repositorio De Trabajos Realizados Por Alumnos de Ingeniera Informatica
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <?php if ($usuario_rol == 'ALUMNO') { ?>
                                    <!-- Menu Tablas -->
                                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <strong>Hola!</strong> FAVOR DE NO MODIFICAR LA INFORMACIÓN
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                                <?php } ?>
                    
                    <!--=== Formularios ===-->
                    <div class="row" style="justify-content: center;">                    
                        <!-- Profesores -->
                        <div class="col-md-6" id="frmProfesoresxls" style="display: none;">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Importar datos de Excel PROFESORES</h3>
                                </div>
                                <div class="card-body">
                                    <form role="form">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="col-12">
                                                        <input type="file" class="form-control" style="height: calc(1.5em + 0.75rem + 8px);" id="input-profesores">
                                                    </div>
                                                </div>
                                                <div class="row" style="justify-content: center;">
                                                    <div class="col-sm-6">
                                                        <button type="button" class="btn btn-success btn-block" onclick="excel_profesores()">Importar</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button type="button" class="btn btn-secondary btn-block" id="btnCancelarProfesores">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Alumnos -->
                        <div class="col-md-6" id="frmAlumnosxls" style="display: none;">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Importar datos de Excel de ALUMNOS</h3>
                                </div>
                                <div class="card-body">
                                    <form role="form">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="col-12">
                                                        <input type="file" class="form-control" style="height: calc(1.5em + 0.75rem + 8px);" id="input-alumnos">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <button type="button" class="btn btn-success btn-block" onclick="excel_alumnos()">Importar</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button type="button" class="btn btn-secondary btn-block" id="btnCancelar">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Grupos -->
                        <div class="col-md-6" id="frmGruposxls" style="display: none;">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Importar datos de Excel de GRUPOS</h3>
                                </div>
                                <div class="card-body">
                                    <form role="form">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="col-12">
                                                        <input type="file" class="form-control" style="height: calc(1.5em + 0.75rem + 8px);" id="input-grupos">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <button type="button" class="btn btn-success btn-block" onclick="excel_grupos()">Importar</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button type="button" class="btn btn-secondary btn-block" id="btnCancelarGrupos">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--=== Tabla profesores ===-->
                    <div class="row" id="titleProfesores" style="justify-content: center; display: none; margin: 10px; align-items: baseline;">
                        <p>TABLA DE PROFESORES</p>&ensp;
                        <button id="btnNuevoProfesor" type="button" class="btn btn-success" data-toggle="modal" title='Agregar'><i class='bx bxs-plus-square'></i></button>&ensp;
                    </div>
                    <div class="card" id="cardProfesores" style="display: none;">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table id="tbProfesores" class='col-sm-12 table-borderless' style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Clave</th>
                                            <th>Profesores</th>
                                            <th>Clave Departamento</th>
                                            <th>Clave Carrera</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--=== Tabla alumnos ===-->
                    <div class="row" id="titleAlumnos" style="justify-content: center; display: none; margin: 10px; align-items: baseline;">
                        <p>TABLA DE ALUMNOS</p>&ensp;
                        <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal" title='Agregar'><i class='bx bxs-plus-square'></i></button>&ensp;
                    </div>
                    <div class="card" id="cardAlumnos" style="display: none;">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table id="tbAlumnos" class='col-sm-12 table-borderless' style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No Control</th>
                                            <th>Alumno</th>
                                            <th>Clave Especialidad</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--=== Tabla  trabajos ===-->
                    <div class="row" id="titleGrupos" style="justify-content: center; display: none; margin: 10px; align-items: baseline;">
                        <p>TABLA DE TRABAJOS</p>&ensp;
                        <button id="btnNuevoGrupo" type="button" class="btn btn-success" data-toggle="modal" title='Agregar'><i class='bx bxs-plus-square'></i></button>&ensp;
                    </div>
                    <div class="card" id="cardGrupos" style="display: none;">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table id="tbGrupos" class='col-sm-12 table-borderless' style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>Titulo</th>
                                            <th>Categoria</th>
                                            <th>Alumno</th>
                                            <th>Asesor</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--=== Tabla trabajos alumno ===-->
                    <?php if ($usuario_rol == 'ALUMNO') { ?>
                        <div class="row" id="titleGrupos" style="justify-content: center; display: none; margin: 10px; align-items: baseline;">
                        <p>TABLA DE TRABAJOS</p>&ensp;
                    </div>
                    <div class="card" id="cardGrupos" style="display: none;">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table id="tbGrupos" class='col-sm-12 table-borderless' style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>Categoria</th>
                                            <th>Titulo</th>
                                            <th>Alumno</th>
                                            <th>Asesor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </section>
            </main>
        </div>
        
        <!--=== Modal para agregar o actualizar Profesores ===-->
        <div class="modal fade" id="editarProfesor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel"></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="frmProfesores">
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Clave del Profesor</label>
                                    <input type="text" class="form-control" id="clv_profesor">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Nombre Profesor</label>
                                    <input type="text" class="form-control" id="nom_profesor">
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Clave Departamento</label>
                                        <input type="text" class="form-control" id="clv_depto">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Clave de Carrera</label>
                                        <input type="text" class="form-control" id="clave_especialidad">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--=== Modal para actualizar alumnos ===-->
        <div class="modal fade" id="editarAlumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel"></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="frmAlumnos">
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">No Control</label>
                                    <input type="text" class="form-control" id="no_control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nom_alumno">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Clave de Especialidad</label>
                                    <input type="text" class="form-control" id="clv_especialidad">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--=== Modal para actualizar administrador ===-->
        <div class="modal fade" id="editarAdministrador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel"></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="frmAdministrador">
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Clave administrador</label>
                                    <input type="text" class="form-control" id="clv_administrador">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Nombre completo</label>
                                    <input type="text" class="form-control" id="nom_administrador">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Rol</label>
                                    <input type="text" class="form-control" id="rol_administrador">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--=== Modal para actualizar Trabajos ===-->
        <div class="modal fade" id="editarGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel"></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="frmGrupos">
                        <div class="modal-body">
                        <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">ID Trabajo</label>
                                    <input type="text" class="form-control" id="id_grupo">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Categoria</label>
                                    <input type="text" class="form-control" id="id_materia">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Titulo</label>
                                    <input type="text" class="form-control" id="clave_grupo">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Alumno</label>
                                    <input type="text" class="form-control" id="clave_profesor">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Asesor</label>
                                    <input type="text" class="form-control" id="total_alumnos">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--=== Modal para actualizar configuracion ===-->
        <div class="modal fade" id="editarConfiguracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel"></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="frmConfiguracion">
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Configuración</label>
                                    <input type="text" class="form-control" id="configuracion">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Estado</label>
                                    <input type="text" class="form-control" id="estado">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <footer>
            Todos los derechos reservados. Tecnológico de Estudios Superiores de San Felipe del Progreso
        </footer>

        <!--========== MAIN JS ==========-->
        <script src="../js/main.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
        <script src="../datatables/Buttons-2.0.1/js/dataTables.buttons.min.js"></script>
        <script src="../datatables/JSZip-2.5.0/jszip.min.js"></script>
        <script src="../datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
        <script src="../datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
        <script src="../datatables/Buttons-2.0.1/js/buttons.html5.min.js"></script>
        <!--============ JS REPORTES =============-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
        <!--============ JS FUNCIONALIDAD =============-->
        <script src="../js/alertify.js"></script>
        <script src="../js/alertify.min.js"></script>
        <script src="../js/funcion.js"></script>
        <script src="../js/logica.js"></script>
        <script src="../js/serverside.js"></script>
        <?php if ($control == 2021) { ?>
        <script src="../js/reportes.js"></script>
        <?php } ?>

    </body>

    </html>

<?php
} else {
    header("Location: ../../index.html");
    exit();
}
?>