export default class Controller {
  constructor() {
    this.formSet = this.requestForms();
  }

  /* CRUD Forms */

  async requestForms() {
    return await (await fetch('requests/?req=get_forms')).json();
  }

  async getFormSet() { return [... await this.formSet] }

  async getFormIndex(id) {
    return ( await this.formSet ).findIndex(form => form.id_form === id);
  }

  async getForm(id) {
    return ( await this.formSet ).find(form => form.id_form === id);
  }

  async addForm(id, title, author) {
    await fetch('requests/?req=add_form', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id, title, author })
    });
  }

  async removeForm(id) {
    await fetch('requests/?req=remove_form', {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id })
    });
  }

  async updateForm(id, title) {
    await fetch('requests/?req=update_form', {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id, title })
    });
  }
}
