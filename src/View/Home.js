import Controller from '../Controller/Home.js';

export default class View {
  constructor() {
    this.ctrl = new Controller();
    this.main = document.getElementsByTagName('main')[0];

    this.boxFormAdd = document.createElement('button');
    this.boxFormAdd.className = 'box-form new-form';
    this.boxFormAdd.id = 'new-form';
    this.boxFormAdd.onclick = () => this
      .addForm(`Nuevo Formulario`, document.getElementById('user').innerText);

    const boxFormAddTitle = document.createElement('span');
    boxFormAddTitle.className = 'new-form__title';
    boxFormAddTitle.innerText = 'Agregar Formulario';

    this.boxFormAdd.appendChild(boxFormAddTitle);
  }

  setController(controller) {
    this.ctrl = controller;
  }

  async render() {
    const forms = await this.ctrl.form.getFormSet();
    forms.forEach(form => this.createForm(form));

    this.main.appendChild(this.boxFormAdd);
  }

  getElementId(id) {
    return Number(id.split('->')[1]);
  }

  async addForm(title, author) {
    const form = await this.ctrl.form.addForm(title, author);
    document.getElementById('new-form').remove;
    this.createForm(form);
    this.main.appendChild(this.boxFormAdd);
  }

  removeForm(id) {
    this.ctrl.form.removeForm(id);
    document.getElementById(id).remove();
  }

  updateForm(id) {
    const formTitle = document.getElementById(`box-form__title->${id}`).value;
    this.ctrl.form.updateForm(id, formTitle);
  }

  createForm(form) {
    const url = document.getElementById('url').innerText;

    const boxForm = document.createElement('div');
    boxForm.className = 'box-form';
    boxForm.id = form.id_form;

    const boxFormGoTo = document.createElement('a');
    boxFormGoTo.className = 'box-form__goto';
    boxFormGoTo.id = `box-form__goto->${form.id_form}`;
    boxFormGoTo.href = `${url}form_builder/?form_id=${form.id_form}`;

    const boxFormInput = document.createElement('input');
    boxFormInput.type = 'text';
    boxFormInput.className = 'box-form__title';
    boxFormInput.id = `box-form__title->${form.id_form}`;
    boxFormInput.value = form.title_form;
    boxFormInput.onchange = () => this.updateForm(form.id_form);

    const boxFormRemove = document.createElement('button');
    boxFormRemove.className = 'box-form__remove';
    boxFormRemove.id = `box-form__remove->${form.id_form}`
    boxFormRemove.onclick = () => this.removeForm(form.id_form);

    boxForm.append(boxFormGoTo, boxFormInput, boxFormRemove);

    this.main.appendChild(boxForm);
  }
}