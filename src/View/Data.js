import {loadForms, loadUser, sendMessage} from "../Controller/Data.js";

function removeButtonForm(index) {
    const buttonToDelete = document.getElementById(index)
    buttonToDelete.remove();
    const buttonForms = document.getElementById('box-message__forms-selected')
    if (!buttonForms.firstElementChild) {
        addTextMessage(buttonForms);
    }
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

document.addEventListener('DOMContentLoaded', async () => {
    const send = document.getElementById('box-message__button-send');
    send.onclick = () => sendMessageTwilio();
    const forms = await loadForms();
    setNamesForms(forms);
    const users = await loadUser()
    setDataUsers(users)
})

function setDataUsers(users) {
    const struct = ['name_graduate', 'last_name_graduate', 'mothers_surname', 'profession_graduate', 'email_graduate', 'phone_graduate', 'egress_year_graduate'];
    const table_data = document.querySelector('#table-box-user__body');
    for (let i = 0; i < users.length; i++) {
        const row = document.createElement('tr');
        for (let j = 0; j < struct.length; j++) {
            const data = document.createElement('td');
            let head = struct[j]
            data.innerText = users[i][head];
            row.append(data);
        }
        table_data.appendChild(row);
    }
}

function setNamesForms(forms) {
    const table_data = document.querySelector('#table-box-forms__body');
    for (let i = 0; i < forms.length; i++) {
        const row = document.createElement('tr');
        const data = document.createElement('td');
        data.innerText = forms[i]['title_form'];
        row.onclick = () => setButtonForm(forms[i]['id_form'], forms[i]['title_form']);
        row.append(data);
        table_data.appendChild(row);
    }
}

function setValuesID(obj) {
    const id_form = obj.innerText;
    const valueId = document.querySelector('#value-id__form');
    console.log(id_form, obj);
    valueId.setAttribute('value', id_form)
    openModal();
}

const boxModal = document.getElementById('box-modal');
boxModal.addEventListener('click', () => {

    boxModal.style.display = 'none';

})

function setButtonForm(idF, nameF) {
    const formsSelected = document.getElementById('box-message__forms-selected');
    let isAddable = false;
    if (formsSelected.firstElementChild) {
        const firstItem = formsSelected.firstElementChild;
        if (firstItem.id === "mess") {
            firstItem.remove();
        }
    }

    const childrn = formsSelected.children;
    console.log(childrn)
    for (const childrnElement of childrn) {
        if (idF == childrnElement.id) {
            isAddable = true;
        }
    }
    if (!isAddable) {
        const formSelected = document.createElement('p');
        const icon = document.createElement('i')
        icon.setAttribute('class', 'typcn typcn-times');
        icon.onclick = () => removeButtonForm(idF);
        formSelected.innerText = nameF;
        formSelected.append(icon);
        formSelected.id = idF;
        formsSelected.appendChild(formSelected);
    }

}

function addTextMessage(container) {
    const mess = document.createElement('p')
    mess.id = "mess";
    mess.innerText = 'Los formularios que selecciones aparecerán aquí';
    mess.style.color = 'gray';
    mess.style.backgroundColor = 'white';
    // container.appendChild(mess);
}

const formsSelected = document.getElementById('box-message__forms-selected');
addTextMessage(formsSelected);

async function sendMessageTwilio() {
    const msj = document.getElementById('box-message__body');
    if (msj.value.trim().length === 0) {
        alert('Mensaje vacio');
    } else {
        const idsFormsChildren = document.getElementById('box-message__forms-selected').children;
        if (idsFormsChildren.item(0).id === "mess") {
            alert('no hay formularios seleccionados');
        } else {
            const btn = document.getElementById('box-message__button-send');
            let idsForms = [];
            for (const idsFormsChild of idsFormsChildren) {
                idsForms.push("https://www.miniforms/client/form/?form_id=".concat(idsFormsChild.id));
                // idsForms.push("https://www.youtube.com/");
            }

            let messageFull = msj.value;

            if (idsForms.length > 1) {
                messageFull += "\n\n\nLinks de los formularios\n\n";
                for (let i = 0; i < idsForms.length; i++) {
                    let url = idsForms[i];
                    messageFull += "Formulario " + (i+1) + ": " + url + "\n";
                }
            } else {
                messageFull += "\n\n\nLink del formulario: " + idsForms[0];
            }
            console.log(messageFull)
            btn.innerText = "Enviando...";
            const response = await sendMessage(messageFull, idsForms);
            msj.value = "";
            btn.innerText = "Enviar";
            if (response.startsWith('<pre>')){
                alert('No se ha enviado el mensaje')
            }
            console.log(response)
        }
    }


}