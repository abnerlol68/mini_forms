export default class Controller {
  constructor() {
    this.formSet = this.requestForms();
  }

  /* CRUD Forms */

  async requestForms() {
    return fetch('request/?req=get_forms').then(forms => forms.json());
  }

  async getFormSet() { return [... await this.formSet] }

  async getFormIndex(id) {
    return ( await this.formSet ).findIndex(form => form.id_form === id);
  }

  async getForm(id) {
    return ( await this.formSet ).find(form => form.id_form === id);
  }

  async addForm(title, author) {
    return fetch('request/?req=add_form', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ title, author })
    }).then(lastForm => lastForm.json());
  }

  async removeForm(id) {
    await fetch('request/?req=remove_form', {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id })
    });
  }

  async updateForm(id, title) {
    await fetch('request/?req=update_form', {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id, title })
    });
  }
}
