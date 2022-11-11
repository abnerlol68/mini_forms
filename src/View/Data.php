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
</head>
<body>

<?php
require_once ROOT . "src/View/Partials/Header.php";
?>

<br>
<br>
<br>
<br>

<div id="forms_ids">
</div>

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
    <textarea name="box-message__text" id="box-message__body" cols="30" rows="10" placeholder="Redacta un mensaje amable al egresado :)"></textarea>
    <br>
    <br>
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
<script>
    function removeID(index) {
        const itemToDelte = document.getElementById(index);
        const buttonToDelete = document.getElementById('form'.concat(index))
        buttonToDelete.remove();
        itemToDelte.remove();
    }

    function openModal() {
        const modal = document.querySelector('#box-modal');
        modal.style.display = "none";
    }

    function closeModal() {
        const modal = document.querySelector('#box-modal');
        modal.style.display = "grid";
    }

    const boxTableForms = document.getElementById('box-tables__forms')

    document.addEventListener('DOMContentLoaded', () => {
        loadForms();
        loadUser()
    })

    async function loadForms() {
        const formularios = await fetch('request/?req=get_forms').then(forms => forms.json());
        const arr = formularios.valueOf();
        const table_data = document.querySelector('#table-box-forms__body');
        for (let i = 0; i < arr.length; i++) {
            const row = document.createElement('tr');
            const data = document.createElement('td');
            data.innerText = arr[i]['title_form'];
            row.onclick = () => getID(arr[i]['id_form'], arr[i]['title_form']);
            row.append(data);
            table_data.appendChild(row);
        }
        console.log(arr[0]);
    }

    async function loadUser() {
        const usuarios = await fetch('request/?req=select_users').then(users => users.json());
        const struct = ['name_graduate','last_name_graduate','mothers_surname','profession_graduate','email_graduate','phone_graduate','egress_year_graduate'];
        const arr = usuarios.valueOf();
        const table_data = document.querySelector('#table-box-user__body');
        for (let i = 0; i < arr.length; i++) {
            const row = document.createElement('tr');
            for (let j = 0; j < struct.length; j++) {
                const data = document.createElement('td');
                let head = struct[j]
                data.innerText = arr[i][head];
                row.append(data);
            }
            table_data.appendChild(row);
        }
        let obj = usuarios[0];
        console.log(obj['phone_graduate']);
    }

    function setValuesID(obj) {
        const id_form = obj.innerText;
        const valueId = document.querySelector('#value-id__form');
        console.log(id_form,obj);
        valueId.setAttribute('value',id_form)
        openModal();
    }

    const boxModal = document.getElementById('box-modal');
    boxModal.addEventListener('click', () => {

        boxModal.style.display = 'none';

    })

    function getID(idF, nameF) {
        //box-message__forms-selected
        //<p>Formulario 1&nbsp;<i class="typcn typcn-plus" onclick="removeID(1)"></i></p>
        const formsSelected = document.getElementById('box-message__forms-selected');
        const formSelected = document.createElement('p');
        const icon = document.createElement('i')
        icon.setAttribute('class', 'typcn typcn-times');
        icon.onclick = () => removeID(idF);
        formSelected.innerText = nameF;
        formSelected.append(icon);
        formSelected.id = "form".concat(idF);
        formsSelected.appendChild(formSelected);

        const formsIDs = document.getElementById('forms_ids');
        const elementWithId = document.createElement('p');
        elementWithId.id = idF;
        formsIDs.appendChild(elementWithId);
    }

    const formsSelected = document.getElementById('box-message__forms-selected');
    const mess = document.createElement('p')
    mess.innerText = 'Los formularios que selecciones aparecerán aquí';
    mess.style.color = 'gray';
    formsSelected.appendChild(mess);
    // formsSelected.addEventListener('change', () => {
    //     if (!formsSelected.hasChildNodes()) {
    //         const mess = document.createElement('p')
    //         mess.innerText = 'Los formularios que selecciones aparecerán aquí';
    //         mess.style.color = 'gray';
    //         formsSelected.appendChild(mess);
    //     }
    // })
    // formsSelected.addEventListener('', () => {
    //     if (!formsSelected.hasChildNodes()) {
    //         const mess = document.createElement('p')
    //         mess.innerText = 'Los formularios que selecciones aparecerán aquí';
    //         mess.style.color = 'gray';
    //         formsSelected.appendChild(mess);
    //     }
    // })

</script>
</body>
</html>
