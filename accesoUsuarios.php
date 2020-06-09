<?php
/** Incluye la clase. */
include '../capa_negocio/usuario.php';

/** Inicia una nueva sesión o recupera la sesión actual. */
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Mitología</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="../img/logo.png"/>
        <!-- Custom styles for this template -->
        <link href="../css/shop-homepage.css" rel="stylesheet">
        <link href="../css/estilo.css" rel="stylesheet">
        <script type="text/javascript" src="../js/jquery-1.6.4.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".card").hover(agrandar, disminuir);
            });
            var agrandar = function () {
                $(this).animate({
                    width: "103%"
                }, 200)
            };
            var disminuir = function () {
                $(this).animate({
                    width: "100%"
                }, 200)
            };
        </script>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">Mitología</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="info.php">Información</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Mitología
                            </a>
                            <div class="dropdown-menu" id="mendrop" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="mitologia_griega.php">Mitología griega</a>
                                <a class="dropdown-item" href="mitologia_egipcia.php">Mitología egipcia</a>
                                <a class="dropdown-item" href="mitologia_nordica.php">Mitología nórdica</a>
                                <a class="dropdown-item" href="mitologia_japonesa.php">Mitología japonesa</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Usuario
                            </a>
                            <div class="dropdown-menu" id="mendrop" aria-labelledby="navbarDropdown">
                                <?php
                                if (isset($_SESSION['usuario'])) {
                                    echo '<a class="dropdown-item" href="gestionUsuario.php" >Perfil usuario</a> &nbsp;&nbsp;';
                                    echo '<a class="dropdown-item" href="cierraSesion.php">Cerrar sesión</a> &nbsp;&nbsp;';
                                    echo 'Usuario: ' . $_SESSION['usuario']->getNombre();
                                } else {
                                    echo '<a class="dropdown-item" href="accesoUsuarios.php">Registrar/iniciar sesion</a>';
                                }
                                ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="col-lg-12">

            <h3 style="text-align: center"> Acceso a usuarios</h3>
            <br><br><br><br>
            <table>
                <tr>
                    <td><div class="col-lg-6 col-md-6 mb-4">
                            <!-- Mostramos el formulario de recogida de los datos 
                                     del usuario -->
                            <h4>Registrar usuario</h4>
                            <br>
                            <form action="registraUsuario.php" method="post">
                                <table>
                                    <tr>
                                        <td><label>Email: </label></td>
                                        <td>
                                            <input type="text" name="email" 
                                                   size="40">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Contraseña: </label></td>
                                        <td>
                                            <input type="password" name="contraseña" 
                                                   size="15">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Nombre: </label></td>
                                        <td>
                                            <input type="text" name="nombre" 
                                                   size="50">
                                        </td>
                                    </tr>                                <tr>
                                        <td><label>Nombre2: </label></td>
                                        <td>
                                            <input type="text" name="nombre2" 
                                                   size="50">
                                        </td>
                                    </tr>
                           
                                    <tr>
                                        <td colspan="2" class="centra">
                                            <br>
                                            <input class="boton" type="submit" 
                                                   value="Registrar">
                                            <input class="boton" type="reset" 
                                                   value="Cancelar">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </td>
                    <td ><div class="col-lg-8 col-md-6 mb-4">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                    </td>
                    <td><div class="col-lg-6 col-md-6 mb-4">
                            <!-- Formulario de validar usuario -->
                            <h4>Validar usuario</h4>
                            <br>
                            <form action="validaUsuario.php" method="post">
                                <table>
                                    <tr>
                                        <td><label>Email: </label></td>
                                        <td>
                                            <input type="text" name="email" 
                                                   size="40" autofocus
                                                   value="<?php
                                if (isset($_COOKIE['email'])) {
                                    echo $_COOKIE['email'];
                                } else {
                                    echo '';
                                }
                                ?>"
                                                   >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Contraseña: </label></td>
                                        <td>
                                            <input type="password" 
                                                   name="contraseña" size="15"
                                                   value="<?php
                                                   if (isset($_COOKIE['contraseña'])) {
                                                       echo $_COOKIE['contraseña'];
                                                   } else {
                                                       echo '';
                                                   }
                                ?>"
                                                   >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <input type="checkbox" 
                                                   name="recordar"
<?php
if (isset($_COOKIE['recordar'])) {
    echo 'checked';
} else {
    echo '';
}
?>>
                                            Recordar en este equipo</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="centra">
                                            <br>
                                            <input class="boton" type="submit" 
                                                   value="Validar">
                                            <input class="boton" type="reset"
                                                   value="Cancelar">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div></td>
                </tr>
            </table>

        </div>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    </body>
</html>
