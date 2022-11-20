<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Datos</title>
    <link rel="stylesheet" href="src/Libs/icons/font/typicons.css">
    <link rel="stylesheet" href="src/css/header.css">
    <link rel="stylesheet" href="src/css/data.css">
    <link rel="stylesheet" href="src/css/footer.css">
    <link rel="shortcut icon" href="src/img/favicon.png" type="image/x-icon">
    <script src="<?= URL . 'src/View/Data.js' ?>" type="module"></script>
</head>
<body>

<?php
require_once ROOT . "src/View/Partials/Header.php";
?>

<div id="san"></div>

<div id="box-data">
    <div id="box-tables">
        <div class="box-tables__container">
            <div id="box-data-user" class="box-data__container">
                <div id="box-data__select-head">
                    <div class="box-data__table-searchbox">
                        <input type="search" name="searched" id="searched" class="table-searchbox__search">
                        <button class="table-searchbox__button"><i class="typcn typcn-zoom"></i></button>
                    </div>
                    <div class="box-data__table-filter">
                        <select name="carriers" id="carriers" class="filter">
                            <option value="void"></option>
                            <option value="sistemas">Ing. en Sistemas</option>
                            <option value="alimentarias">Ing. en Sistemas</option>
                            <option value="electromecanica">Ing. en Sistemas</option>
                            <option value="arquitectura">Ing. en Sistemas</option>
                            <option value="sistemas">Ing. en Sistemas</option>
                        </select>
                        <select name="timeGraduate" id="timeGraduate" class="filter">
                            <option value="void"></option>
                            <option value="1-2">De 1 a 2 años</option>
                            <option value="3-5">De 3 a 5 años</option>
                        </select>
                    </div>
                    <div class="box-data__table-selectors">
                        <div><i class="typcn typcn-input-checked">Todos</i></div>
                        <div><i class="typcn typcn-bell">Ninguno</i></div>
                    </div>
                </div>
                <div class="box-data__table-head head__users">
                    <p>Nombre(s)</p>
                    <p>Apellido Paterno</p>
                    <p>Apellido Materno</p>
                    <p>Profesión</p>
                    <p>Correo</p>
                    <p>Teléfono</p>
                    <p>Año de Egreso</p>
                </div>
                <div class="box-data__table-body table-body__user">
                    <table id="table-box-user">
                        <tbody id="table-box-user__body">
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="box-table__user-options">
                <button id="box-message__button-upload" class="box-message__button">Subir csv</button>
                <button id="box-message__button-download" class="box-message__button">Descargar csv</button>
            </div>
        </div>

        <div class="box-tables__container">
            <div id="box-data-forms" class="box-data__container">
                <div id="box-data__select-head-forms">
                    <div class="box-data__table-searchbox">
                        <input type="search" name="searched" id="searched" class="table-searchbox__search">
                        <button class="table-searchbox__button"><i class="typcn typcn-zoom"></i></button>
                    </div>
                    <div class="box-data__table-selectors">
                        <div><i class="typcn typcn-input-checked">Todos</i></div>
                        <div><i class="typcn typcn-bell">Ninguno</i></div>
                    </div>
                </div>
                <div class="box-data__table-head">
                    <p>Formularios</p>
                </div>
                <div class="box-data__table-body">
                    <table id="table-box-forms">
                        <tbody id="table-box-forms__body">
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <textarea name="box-message__text" id="box-message__body" cols="40" rows="5" required placeholder="Redacta un mensaje amable al egresado :)"></textarea>
                <button id="box-message__button-send" class="box-message__button">Enviar</button>
            </div>
        </div>
    </div>

    <div id="box-options">
<!--        <div id="box-message__forms-selected"></div>-->


    </div>

    <!--modal-->
    <div id="box-modal">
        <div id="box-modal__backgroud">
            <div id="box-modal__content">
                <input type="text" name="box-modal__searchBox" id="box-modal__searchBox">
                <div id="box-modal__scrollTable">
                    <table id="box-modal__table">
                        <thead>
                        <tr>
                            <td>Formularios</td>
                        </tr>
                        </thead>
                        <tbody id="box-modal__table-body">
                        <tr>
                            <td>Encuesta 1</td>
                            <td><i class="typcn typcn-media-play"></i></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="box-modal__options">
                    <button class="box-modal__btn-first" onclick="openModal()">Cerrar</button>
                    <button class="box-modal__btn-first">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <?php
    require_once  ROOT . "src/View/Partials/Footer.php";
    ?>
</footer>
</body>
</html>
