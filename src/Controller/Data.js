export async function loadForms() {
    const formularios = await fetch('request/?req=get_forms').then(forms => forms.json());
    return formularios.valueOf();
}

export async function sendMessage(msj, idsForms) {
    return await fetch('request/?req=send_message', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ msj, idsForms })
    }).then(r => r.text());
}

export async function loadUser() {
    const usuarios = await fetch('request/?req=select_users').then(users => users.json());
    return usuarios.valueOf();
}

export async function insertUser(data) {
    const response = await fetch('request/?req=insert_users', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(res => res.json());
    return response;
}