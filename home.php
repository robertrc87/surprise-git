<?php @session_start();

$user = null;
$query = null;
$url  = null;

if (!empty($_POST)) {

    require_once 'modelo/conexion.php';

    $query = "SELECT * FROM usuario WHERE correo = :correo";
    $prepared = $pdo->prepare($query);
    $prepared->execute([
        'correo' => $_POST['correo']
    ]);
    $user = $prepared->fetch(PDO::FETCH_ASSOC);

    if (isset($user['correo'])) {

        if ($user['correo'] == $_POST['correo'] && password_verify($_POST['pass'], $user['contrasena'])) {
            session_start();
            $_SESSION['id_usuario'] = $user['id_usuario'];
            $_SESSION['usuario'] = $user['correo'];
            $_SESSION['nombre'] = $user['nombre'];

            if (isset($_SESSION['url']))
                $url = $_SESSION['url'];
            else
                $url = "home.php";

            //header("Location: http://localhost/surprise/home.php");
        } else {
            $url = null;
        }
    } else {
        //No hay correo
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Surprise</title>

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">
    <link rel="stylesheet" type="text/css" href="css/media-home.css">

    <script src="js/index.js"></script>

    <?php require_once 'head.php' ?>

</head>

<body>

    <?php require_once 'popups.php' ?>

    <!-- Cabecera -> Video - NavBar - SliderNotas -->
    <header class="header content">
        <div class="header-video">
            <video src="css/video/video.mp4" autoplay loop></video>
        </div>
        <div class="header-overlay"></div>
        <div class="header-content">
            <!-- NAVBAR -->
            <nav class="navbar navbar-dark">
                <div class="container-fluid">
                    <div>
                        <a href="#" class="toggle-nav js-nav" data-toggle="collapse" data-target="#navbarMobile" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars fa-2x"></i></a>

                        <div class="nav-wrap disp-true">
                            <nav class="menu mt-1">
                                <ul>
                                    <li><a href="index.php">Inicio</a></li>
                                    <li><a href="#contacto">Contacto</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <?php
                    if (!isset($_SESSION['id_usuario'])) {
                        echo <<< AAC
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ventanaModalSesion">Iniciar Sesión</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ventanaModalRegister">Registrarse</button>
                                </div>
                                AAC;
                    } else {
                        echo <<< LNH
                                <div>
                                    <p class="mb-0">Bienvenido
                                LNH;
                        echo "  " . $_SESSION['nombre'];
                        echo <<< AAA
                                </p>
                                <a href="cerrar.php">Cerrar Sesion</a>
                                </div>
                                AAA;
                    }
                    ?>

                </div>

                <div class="collapse navbar-collapse disp-none" id="navbarMobile">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#paneles-mobile">Mapa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contacto">Contacto</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="texto">
                <!-- <img class="img-fluid logo-head" src="css/img/iconos/logo.svg"> -->
                <h1 class="title-principal"><strong>
                        <script>
                            document.write(localStorage.getItem("titulo"))
                        </script>
                    </strong></h1>
                <p class="sub-principal">Has que este 14 de febrero, tu amor y amistad<br>llene la ciudad de Trujillo de lindos mensajes</p>
            </div>

            <!-- Seccion Plantillas -->



            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mt-3">
                        <a href="#pre-panel"><i class="fas fa-angle-double-down"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid" id="carousel-fluid">
        <div class="row">
            <div class="col-12">
                <div class="container-fluid caja-plantilla-principal">
                    <div id="container-plantilla" class="container">
                        <div class="row justify-content-around">
                            <div class="col-md-3 col-6">
                                <div class="form-check pl-0">
                                    <button class="caja-plantilla" onclick=actualizar(1)>
                                        <div style="background-color: #fff; border-radius:20px">
                                            <video class="img-fluid" id="v1" alt="..." autoplay loop>
                                                <script>
                                                    if ((localStorage.getItem("panel") == 5) || (localStorage.getItem("panel") == 6)) {
                                                        document.write('<source id="source-video-1" src="css/video/videos-amor/amistad-vertical.mp4">')
                                                    } else {
                                                        document.write('<source id="source-video-1" src="css/video/videos-amor/amistad-horizontal.mp4">')
                                                    }
                                                </script>
                                            </video>
                                        </div>
                                    </button>
                                    <div class="text-center">
                                        <button class="btn btn-melon btn-pre-video">
                                            <i class="fas fa-eye"></i>
                                            Previsualizar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="form-check pl-0">
                                    <button class="caja-plantilla" onclick=actualizar(2)>
                                        <div style="background-color: #fff; border-radius:20px">
                                            <video class="img-fluid" id="v3" alt="..." autoplay>
                                                <script>
                                                    if ((localStorage.getItem("panel") == 5) || (localStorage.getItem("panel") == 6)) {
                                                        document.write('<source id="source-video-3" src="css/video/videos-amor/amor-vertical-1.mp4">')
                                                    } else {
                                                        document.write('<source id="source-video-3" src="css/video/videos-amor/amor-horizontal-1.mp4">')
                                                    }
                                                </script>
                                            </video>
                                        </div>
                                    </button>
                                    <div class="text-center">
                                        <button class="btn btn-melon btn-pre-video">
                                            <i class="fas fa-eye"></i>
                                            Previsualizar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mt-5 mt-md-0">
                                <div class="form-check pl-0">
                                    <button class="caja-plantilla" onclick=actualizar(3)>
                                        <div style="background-color: #fff; border-radius:20px">
                                            <video class="img-fluid" id="v3" alt="..." autoplay>
                                                <script>
                                                    if ((localStorage.getItem("panel") == 5) || (localStorage.getItem("panel") == 6)) {
                                                        document.write('<source id="source-video-3" src="css/video/videos-amor/amor-vertical-2.mp4">')
                                                    } else {
                                                        document.write('<source id="source-video-3" src="css/video/videos-amor/amor-horizontal-2.mp4">')
                                                    }
                                                </script>
                                            </video>
                                        </div>
                                    </button>
                                    <div class="text-center">
                                        <button class="btn btn-melon btn-pre-video">
                                            <i class="fas fa-eye"></i>
                                            Previsualizar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="ventanaConfirmacion" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-sesion">
                <div class="modal-header modal-sesion-header">
                    <div class="col text-center">
                        <h5 id="tituloVentana">Desea Finalizar</h5>
                    </div>
                </div>

                <div class="modal-body modal-sesion-body">
                    <div class="row mb-3">
                        <div class="col text-justify">
                            <p>Al hacer click en confirmar, está aceptando que su saludo se publique este 14 de febrero, de querer hacer un mensaje personalizado para enviarlo por las distintas redes sociales de click en crear mensaje sorpresa</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7 text-right">
                            <a type="button" class="btn btn-melon btn-mel-pop text-center btn-mess-sor" href=<?php
                                                                                                                if (!isset($_SESSION['id_usuario'])) {
                                                                                                                    echo <<< CCC
                                            "javascript:no_register()"
                                            CCC;
                                                                                                                } else {
                                                                                                                    $_SESSION['panel'] = $_GET['p'];
                                                                                                                    echo <<< DDD
                                            "javascript:send_message()"
                                            DDD;
                                                                                                                }
                                                                                                                ?>>Confirmar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="pre-panel">
        <div class="container cont-editor">
            <div class="row sec-edicion">
                <div class="video-container">
                    <div class="video-video col-12 text-center" id="video-principal-v">
                        <?php
                        switch ($_GET['b']) {
                            case 0:
                                echo <<< TTT
                                        <div><p style="
                                            font-size: 20px;
                                            color: #fff;">Selecciona tu plantilla</p></div>
                                        TTT;
                                break;
                            case 1:
                                if ($_GET['p'] == 5 || $_GET['p'] == 6) {
                                    echo <<< TTT
                                        <video id="video-principal" class="video-ini" autoplay loop controls>
                                            <source id="source-video-1" src="css/video/videos-amor/amistad-vertical.mp4">
                                        </video>
                                        TTT;
                                } else {
                                    echo <<< TTT
                                        <video id="video-principal" class="video-ini" autoplay loop controls>
                                            <source id="source-video-1" src="css/video/videos-amor/amistad-horizontal.mp4">
                                        </video>
                                        TTT;
                                }
                                break;
                            case 2:
                                if ($_GET['p'] == 5 || $_GET['p'] == 6) {
                                    echo <<< TTT
                                        <video id="video-principal" class="video-ini" autoplay loop controls>
                                            <source id="source-video-3" src="css/video/videos-amor/amor-vertical-1.mp4">
                                        </video>
                                        TTT;
                                } else {
                                    echo <<< TTT
                                        <video id="video-principal" class="video-ini" autoplay loop controls>
                                            <source id="source-video-3" src="css/video/videos-amor/amor-horizontal-1.mp4">
                                        </video>
                                        TTT;
                                }
                                break;
                            case 3:
                                if ($_GET['p'] == 5 || $_GET['p'] == 6) {
                                    echo <<< TTT
                                        <video id="video-principal" class="video-ini" autoplay loop controls>
                                            <source id="source-video-3" src="css/video/videos-amor/amor-vertical-2.mp4">
                                        </video>
                                        TTT;
                                } else {
                                    echo <<< TTT
                                        <video id="video-principal" class="video-ini" autoplay loop controls>
                                            <source id="source-video-3" src="css/video/videos-amor/amor-horizontal-2.mp4">
                                        </video>
                                        TTT;
                                }
                                break;
                        }
                        ?>
                        <div id="vc-t" class="video-content vc-none">
                            <?php
                            switch ($_GET['b']) {
                                case 1:
                                    if ($_GET['p'] == 5 || $_GET['p'] == 6) {
                                        echo <<< TTT
                                        <textarea id="texto-panel-v" class="texto-1-v">Escribe aqui tu mensaje</textarea>
                                        TTT;
                                    } else {
                                        echo <<< TTT
                                        <textarea id="texto-panel-h" class="texto-1-h">Escribe aqui tu mensaje</textarea>
                                        TTT;
                                    }
                                    break;
                                case 2:
                                    if ($_GET['p'] == 5 || $_GET['p'] == 6) {
                                        echo <<< TTT
                                        <textarea id="texto-panel-v" class="texto-2-v">Escribe aqui tu mensaje</textarea>
                                        TTT;
                                    } else {
                                        echo <<< TTT
                                        <textarea id="texto-panel-h" class="texto-2-h">Escribe aqui tu mensaje</textarea>
                                        TTT;
                                    }
                                    break;
                                case 3:
                                    if ($_GET['p'] == 5 || $_GET['p'] == 6) {
                                        echo <<< TTT
                                        <textarea id="texto-panel-v" class="texto-3-v">Escribe aqui tu mensaje</textarea>
                                        TTT;
                                    } else {
                                        echo <<< TTT
                                        <textarea id="texto-panel-h" class="texto-3-h">Escribe aqui tu mensaje</textarea>
                                        TTT;
                                    }
                                    break;
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt-3">
                <div class="col text-center">
                    <?php
                    if ($_GET['b'] != 0) {
                        echo <<< TTT
                                <button class="btn btn-melon" data-bs-toggle="modal" data-bs-target="#ventanaConfirmacion">Programar</button>
                                TTT;
                    } else {
                        echo <<< TTT
                                <button class="btn btn-melon" data-bs-toggle="modal" data-bs-target="#ventanaConfirmacion" disabled>Programar</button>
                                TTT;
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php require_once 'footer.php'; ?>

    <script>
        if (localStorage.getItem("boton") != 0) {
            $('#vc-t').removeClass("vc-none").addClass("vc-s")
        }
        localStorage.setItem("boton", 0);
        if (localStorage.getItem("panel") == 5 || localStorage.getItem("panel") == 6) {
            $('#video-principal').addClass("video-principal-v").removeClass("video-principal-h")
        } else {
            $('#video-principal').addClass("video-principal-h").removeClass("video-principal-v")
        }

        $('.js-nav').click(function() {
            $(this).parent().find('.menu').toggleClass('active');
        });

        function close_modalPanel() {
            $('#ventanaConfirmacion').modal('hide');
        }

        function no_register() {
            $('#ventanaConfirmacion').modal('hide');
            $('#ventanaModalRegister').modal('show');
            $('#ventanaModalRegister').on('hidden.bs.modal', function() {
                $('.modal-backdrop').removeClass("modal-backdrop")
            })
        }

        function actualizar(btn) {
            localStorage.setItem("boton", btn);
            localStorage.setItem("boton2", btn);
            $('#vc-t').removeClass("vc-none").addClass("vc-s")
            location.href = "home.php?b=" + btn + "&p=" + localStorage.getItem("panel") + "/#pre-panel";
        }

        function send_message() {
            var mensaje

            if(localStorage.getItem("panel")==5 || localStorage.getItem("panel")==6){
                mensaje = $("#texto-panel-v").val();
            }else{
                mensaje = $("#texto-panel-h").val();
            }
            
            if (mensaje != '') {
                $.ajax({
                    url: "registrar_video.php",
                    method: "POST",
                    data: {
                        mensaje: mensaje,
                        panel: localStorage.getItem("panel"),
                        video: localStorage.getItem("boton2")
                    },
                    success: function(data) {
                        localStorage.setItem("res",false)
                        location.href="surprise.php"
                    }
                });
            }
        }
    </script>
</body>

</html>