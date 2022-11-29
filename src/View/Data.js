import {insertUser, loadForms, loadUser, sendMessage} from "../Controller/Data.js";

// headers to read the data from result set queries in format json
const userHeadTable = ['name_graduate', 'last_name_graduate', 'mothers_surname', 'profession_graduate', 'email_graduate', 'phone_graduate', 'egress_year_graduate'];
const userHeadForm = ['id_form', 'title_form'];

// data info about users, this array store the info from the query
let usersArray = [];
let emails = [];
let phoneNumbers = [];

// data info about forms, this array store the info from the query
let formsArray = [];
let idsForms = [];

let links = [];

function openModal() {
    const modal = document.querySelector('#box-modal');
    modal.style.display = "none";
}

function closeModal() {
    const modal = document.querySelector('#box-modal');
    modal.style.display = "grid";
}

// const boxTableForms = document.getElementById('box-tables__forms')

function loadFile() {
    // Get the file of the input file
    const input_file = document.getElementById("file-chooser");
    const file_csv = input_file.files[0];
    // Check if the file exist
    if (!file_csv) {
        return;
    }
    // Function to read the file
    const reader = new FileReader();
    reader.onload = function (e) {
        const content = e.target.result;
        if (validateStructCSV(content)) {
            console.log('paso');
            insertUsers(content);
        } else {
            console.log('no paso');
        }
    };
    // Call function to read the file
    reader.readAsText(file_csv);
}

function validateStructCSV(file) {
    const header_table = ['nombre', 'apellido paterno', 'apellido materno', 'profesión', 'correo', 'teléfono', 'año de egreso'];
    const rows_csv = file.split(/\r?\n|\r/);
    const header_csv = rows_csv[0].split(/,/);
    for (let i = 0; i < header_csv.length; i++) {
        let data_header = String(header_csv[i]).toLowerCase();
        if (header_table.indexOf(data_header) === -1) {
            return false;
        }
    }
    return true;
}

async function insertUsers(file) {
    const rows_csv = file.split(/\r?\n|\r/);
    const array_json = [];
    for (let i = 1; i < rows_csv.length - 1; i++) {
        const header_csv = rows_csv[i].split(/,/);
        let name = header_csv[0];
        let lastName = header_csv[1];
        let motherSurname = header_csv[2];
        let carrier = header_csv[3];
        let email = header_csv[4];
        let phone = header_csv[5];
        let graduate = header_csv[6];
        let json_data = {name, lastName, motherSurname, carrier, email, phone, graduate};
        const res = await insertUser(json_data);
        array_json.push(json_data);
    }
}

document.addEventListener('DOMContentLoaded', async () => {
    // Load the information about the forms and users in its respective tables
    const forms = await loadForms();
    setNamesForms(forms);
    const users = await loadUser();
    setDataUsers(users);
    console.log(users);
    // Load the functionality to the button 'Enviar' to send message through twilio.
    const send = document.getElementById('box-message__button-send');
    send.onclick = () => sendMessageTwilio(send);
    // This make that the button 'Ver seleccionados' change its label 'Ver' by 'Ocultar' when you make a clic
    const btnContentSelectedUsers = document.getElementById('box-message__button-watch');
    let flagClic = true;
    btnContentSelectedUsers.onclick = () => {
        btnContentSelectedUsers.firstElementChild.innerText = (flagClic) ? 'Ocular' : 'Ver';
        flagClic = !flagClic;
    }

    const loadCSV = document.getElementById('file-chooser');
    loadCSV.onchange = () => loadFile();
    /*      You can add more functionalities that will run when the document load       */
})

function filterGlobal(pattern, where, keys = null, typeSearch = false, operation = "name") {
    let temporaryArrayUser = [];
    let temporaryArrayUserNotSelected = [];
    if (typeSearch) {
        for (let i = 0; i < where.length; i++) {
            if (String(where[i][operation]).toLowerCase().search(pattern.toLowerCase()) !== -1) {
                temporaryArrayUser.push(where[i]);
            } else {
                temporaryArrayUserNotSelected.push(where[i]);
            }
        }
    } else {
        for (let i = 0; i < where.length; i++) {
            if (where[i][operation.concat('_form')].toLowerCase().search(pattern.toLowerCase()) !== -1) {
                temporaryArrayUser.push(where[i]);
            } else {
                temporaryArrayUserNotSelected.push(where[i]);
            }
        }
    }
    return [temporaryArrayUser, temporaryArrayUserNotSelected];
}

function removeUserSelected(displayUser, counter) {
    emails = emails.filter(function (email) {
        return email !== displayUser.children[2].innerText;
    })
    phoneNumbers = phoneNumbers.filter(function (phone) {
        return phone !== displayUser.children[3].innerText;
    })
    displayUser.remove();
    counter.innerText = String(Number(counter.innerText) - 1);
}

function addUserSelected(rowUser) {
    // This store the information about the user
    const infoUser = rowUser.children;
    // This 'if' block serve to verify if there is an email already registered in the
    if (phoneNumbers.indexOf(infoUser[5].innerText) === -1) {
        const containerSelectedUsers = document.getElementById('selected-users');
        const displayUser = document.createElement('div');
        const counterUsers = document.getElementById('selected-users__counter');
        phoneNumbers.push(infoUser[5].innerText);
        emails.push(infoUser[4].innerText);
        displayUser.className = 'selected-user__added';
        let nameUser = infoUser[0].innerText;
        nameUser += " " + infoUser[1].innerText;
        nameUser += " " + infoUser[2].innerText;
        const elementNameUser = document.createElement('span');
        elementNameUser.innerText = nameUser;
        displayUser.append(elementNameUser);
        for (let i = 3; i < infoUser.length; i++) {
            const partOfInfo = document.createElement('span');
            partOfInfo.innerText = infoUser[i].innerText;
            displayUser.append(partOfInfo);
        }
        const btnDelete = document.createElement('i');
        btnDelete.className = "typcn typcn-times btnRemove";
        btnDelete.onclick = () => removeUserSelected(displayUser, counterUsers);
        displayUser.append(btnDelete);
        containerSelectedUsers.appendChild(displayUser);
        counterUsers.innerText = String(Number(counterUsers.innerText) + 1);
    }
}

function removeFormSelected(display, ids, counterForms) {
    console.log(ids, idsForms);
    idsForms = idsForms.filter(function (id) {
        return id !== ids;
    })
    display.remove();
    console.log(idsForms);
    counterForms.innerText = String(Number(counterForms.innerText) - 1);
}

function addFormSelected(rowForm) {
    // This store the information about the user
    const infoForms = rowForm.children;
    // This 'if' block serve to verify if there is an email already registered in the
    if (idsForms.indexOf(infoForms[0].innerText) === -1) {
        const containerSelectedForms = document.getElementById('selected-forms');
        const displayForms = document.createElement('div');
        const counterForms = document.getElementById('selected-forms__counter');
        const btnRemoveForm = document.createElement('i');

        btnRemoveForm.className = "typcn typcn-times btnRemove";
        idsForms.push(infoForms[0].innerText);
        displayForms.className = 'selected-form__added';
        displayForms.innerText = infoForms[1].innerText;
        displayForms.append(btnRemoveForm);
        btnRemoveForm.onclick = () => removeFormSelected(displayForms, infoForms[0].innerText, counterForms);
        containerSelectedForms.appendChild(displayForms);
        counterForms.innerText = String(Number(counterForms.innerText) + 1);
    }
}

function setDataUsers(users) {
    const table_data = document.querySelector('#table-box-user__body');
    for (let i = 0; i < users.length; i++) {
        const row = document.createElement('tr');
        for (let j = 0; j < userHeadTable.length; j++) {
            const data = document.createElement('td');
            let head = userHeadTable[j]
            data.innerText = users[i][head];
            row.append(data);
        }
        row.onclick = () => addUserSelected(row);
        table_data.appendChild(row);
    }
    usersArray = Array.from(users);
}

function setNamesForms(forms) {
    const table_data = document.querySelector('#table-box-forms__body');
    for (let i = 0; i < forms.length; i++) {
        const row = document.createElement('tr');
        const idForm = document.createElement('td');
        const titleForm = document.createElement('td');
        titleForm.innerText = forms[i]['title_form'];
        idForm.innerText = forms[i]['id_form'];
        idForm.style.display = 'none';
        row.append(idForm);
        row.append(titleForm);
        row.onclick = () => addFormSelected(row);
        table_data.appendChild(row);
    }
    formsArray = Array.from(forms);
}

const boxModal = document.getElementById('box-modal');
boxModal.addEventListener('click', () => {

    boxModal.style.display = 'none';

})

async function sendMessageTwilio(btnSend) {
    const msj = document.getElementById('box-message__body');
    const alertMsj = document.getElementById('box-message__alert');
    const alertMsjBody = document.getElementById('box-message__alert-body');
    if (msj.value.trim().length === 0) {
        alertMsj.style.visibility = 'visible';
        alertMsjBody.innerText = 'No has escrito ningun mensaje';
    } else {
        if (idsForms.length === 0) {
            alertMsj.style.visibility = 'visible';
            alertMsjBody.innerText = 'No hay formularios por enviar';
        } else {
            if (phoneNumbers.length === 0) {
                alertMsj.style.visibility = 'visible';
                alertMsjBody.innerText = 'No hay usuarios seleccionados';
            } else {
                for (let i = 0; i < idsForms.length; i++) {
                    links.push("https://miniforms-client.herokuapp.com/form/?form_id=".concat(idsForms[i]))
                }

                let messageFull = msj.value;

                if (idsForms.length > 1) {
                    messageFull += "\n\n\nLinks de los formularios\n\n";
                    for (let i = 0; i < idsForms.length; i++) {
                        let url = links[i];
                        messageFull += "Formulario " + (i + 1) + ": " + url + "\n";
                    }
                } else {
                    messageFull += "\n\n\nLink del formulario: " + links[0];
                }

                console.log(messageFull)

                btnSend.innerText = "Enviando...";

                const response = await sendMessage(messageFull, idsForms);

                msj.value = "";

                btnSend.innerText = "Enviar";
                alertMsj.style.visibility = 'hidden';
                if (response.startsWith('<pre>')) {
                    alert('No se ha enviado el mensaje')
                }
                console.log(response)
            }

        }
    }
}

const searchUsers = document.getElementById('search-users');
searchUsers.addEventListener('keyup', () => {

    const typeSearch = document.getElementById('table-searchbox__filter').value;

    let textSearched = searchUsers.value.trim().toLowerCase();

    const recoverUsers = filterGlobal(textSearched, usersArray, null, true, typeSearch);

    renderUsers(recoverUsers[0]);

})

const searchForms = document.getElementById('search-forms');

searchForms.addEventListener('keyup', () => {

    let textSearched = searchForms.value.trim().toLowerCase();

    const boxData = document.getElementById('table-box-forms__body');

    const recoverForms = filterGlobal(textSearched, formsArray, null, false, 'title');

    const parent = boxData.parentNode;
    boxData.remove();
    const bodyTableUsers = document.createElement('tbody');
    bodyTableUsers.id = 'table-box-forms__body';

    for (let i = 0; i < recoverForms[0].length; i++) {
        const selectedFormTr = document.createElement('tr');
        const selectedFormIdTd = document.createElement('td');
        const selectedFormTd = document.createElement('td');
        selectedFormTd.innerText = recoverForms[0][i][userHeadForm[1]];
        selectedFormIdTd.innerText = recoverForms[0][i][userHeadForm[0]];
        selectedFormIdTd.style.display = 'none';
        selectedFormTr.append(selectedFormIdTd);
        selectedFormTr.append(selectedFormTd);
        selectedFormTr.onclick = () => addFormSelected(selectedFormTr);

        bodyTableUsers.append(selectedFormTr);
    }

    parent.appendChild(bodyTableUsers);
})

const filterCarriers = document.getElementById('carriers');
filterCarriers.addEventListener('change', () => {

    if (filterCarriers.value !== 'void') {

        const recoverUsers = filterGlobal(filterCarriers.value, usersArray, null, true, 'profession_graduate');

        renderUsers(recoverUsers[0]);

    } else {

        renderUsers(usersArray);

    }

})

function renderUsers(currentArray) {
    const boxData = document.getElementById('table-box-user__body');

    const parent = boxData.parentNode;
    boxData.remove();
    const bodyTableUsers = document.createElement('tbody');
    bodyTableUsers.id = 'table-box-user__body'

    for (let i = 0; i < currentArray.length; i++) {
        const selectedUserTr = document.createElement('tr');

        for (let j = 0; j < 7; j++) {
            const selectedUserTd = document.createElement('td');
            selectedUserTd.innerText = currentArray[i][userHeadTable[j]];
            selectedUserTr.append(selectedUserTd);
        }

        selectedUserTr.onclick = () => addUserSelected(selectedUserTr);

        bodyTableUsers.append(selectedUserTr);
    }

    parent.appendChild(bodyTableUsers);
}