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
        <div class="box-tables__container" id="box-tables__container-users">
            <div id="box-data-user" class="box-data__container">
                <div id="box-data__select-head">
                    <div class="box-data__table-searchbox">
                        <select  class="filter" id="table-searchbox__filter">
                            <option value="name_graduate">Nombre</option>
                            <option value="last_name_graduate">Apellido Paterno</option>
                            <option value="mothers_surname">Apellido Materno</option>
                            <option value="email_graduate">Correo</option>
                            <option value="phone_graduate">Telefono</option>
                        </select>
                        <input type="search" name="searched" id="search-users" class="table-searchbox__search">
                        <button class="table-searchbox__button"><i class="typcn typcn-zoom"></i></button>
                    </div>
                        <select name="carriers" id="carriers" class="filter">
                            <option value="void"></option>
                            <option value="Sistemas Computacionales">Ing. en Sistemas</option>
                            <option value="Electromecánica">Ing. en Electromecánica</option>
                            <option value="TICS">Ing. en Telecomunicaciones</option>
                            <option value="Arquitectura">Arquitectura</option>
                            <option value="Logística">Ing. em Logística</option>
                            <option value="Alimentarias">Ing. en Alimentarias</option>
                            <option value="Gestión Empresarial">Gestión Empresarial</option>
                        </select>
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
                <input type="checkbox" name="selected-users__onclick" id="selected-users__onclick">
                <div id="selected-users"></div>
            </div>
            <div id="box-table__user-options">
                <input type="file" name="file-chooser" id="file-chooser">
                <label for="file-chooser" id="box-message__button-upload" class="box-message__button">Subir csv</label>
<!--                <button id="box-message__button-download" class="box-message__button">Descargar csv</button>-->
                <label for="selected-users__onclick" id="box-message_label-onclick">
                    <span id="box-message__button-watch" class="box-message__button"><span id="selected-users__tag">Ver</span> seleccionados (<span id="selected-users__counter">0</span>)</span>
                </label>
            </div>
        </div>

        <div class="box-tables__container">
            <div id="box-data-forms" class="box-data__container">
                <div id="box-data__select-head-forms">
                    <div class="box-data__table-searchbox">
                        <input type="search" name="searched" id="search-forms" class="table-searchbox__search">
                        <button class="table-searchbox__button"><i class="typcn typcn-zoom"></i></button>
                    </div>
                </div>
                <div class="box-data__table-head">
                    <p>Formularios</p>
                </div>
                <div id="box-data__table-forms">
                    <div class="box-data__table-body table-body__forms">
                        <table id="table-box-forms">
                            <tbody id="table-box-forms__body">
                            </tbody>
                        </table>
                    </div>
                    <input type="checkbox" name="selected-forms__onclick" id="selected-forms__onclick">
                    <div id="selected-forms"></div>
                </div>
                <label for="selected-forms__onclick" id="selected-forms__options">
                    <span id="box-message__button-watch-forms" class="box-message__button"><span id="selected-forms__tag">Ver</span> seleccionados (<span id="selected-forms__counter">0</span>)</span>
                </label>
            </div>
            <div id="box-message">
                <div id="box-message__head">
                    <textarea name="box-message__text" id="box-message__body" required placeholder="Redacta un mensaje amable al egresado :)"></textarea>
                    <button id="box-message__button-send" class="box-message__button">Enviar</button>
                </div>
                <div id="box-message__alert">
                    <i class="typcn typcn-warning"></i>
                    <span id="box-message__alert-body"></span>
                </div>
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
