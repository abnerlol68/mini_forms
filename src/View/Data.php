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

<br>
<br>
<br>
<br>

<div id="content-data">
    <div id="filters">

        <div id="searchBox">
            <input type="search" name="searched" id="searched">
            <button><i class="typcn typcn-zoom"></i></button>
        </div>

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

        <div class="selectors">
            <div><i class="typcn typcn-input-checked">Seleccionar todo</i></div>
            <div><i class="typcn typcn-bell">No seleccionar nada</i></div>
        </div>

        <button id="btn-select__form" class="btn-first" onclick="requestForms()"><i class="typcn typcn-message">Enviar encuesta</i></button>
        <input type="hidden" name="value-id__form" id="value-id__form">

    </div>
    <div id="box-tables">
        <div id="user-table-box-black">
            <p>Nombre(s)</p>
            <p>Apellido Paterno</p>
            <p>Apellido Materno</p>
            <p>Profesión</p>
            <p>Correo</p>
            <p>Teléfono</p>
            <p>Año de Egreso</p>
        </div>
        <div id="forms-table-box-black">
            <p>Formularios</p>
        </div>
        <div id="box-tables__table-box-user">
            <table id="table-box-user">
                <tbody id="table-box-user__body" class="tStruct">
                </tbody>
            </table>
        </div>
        <div id="box-tables__table-box-forms">
            <table id="table-box-forms">
                <tbody id="table-box-forms__body">
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="box-message">
    <div id="box-message__forms-selected">
    </div>
    <textarea name="box-message__text" id="box-message__body" cols="150" rows="10" required placeholder="Redacta un mensaje amable al egresado :)"></textarea>
    <button id="box-message__button-send">Enviar</button>
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

<footer>
    <?php
    require_once  ROOT . "src/View/Partials/Footer.php";
    ?>
</footer>
</body>
</html>
