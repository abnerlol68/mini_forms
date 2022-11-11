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
    // Div container to the form
    const boxForm = document.createElement('div');
    boxForm.className = 'box-form';
    boxForm.id = form.id_form;
    // Hamburger button to the options form
    const boxFormButtonOptions = document.createElement('i');
    boxFormButtonOptions.className = 'button-options typcn typcn-th-menu';
    boxFormButtonOptions.id = `box-form__button-options-->${form.id_form}`;
    boxFormButtonOptions.innerHTML = '&nbsp;';
    boxFormButtonOptions.onclick = () => this.openOptions(boxForm.id);
    // Icon of the form
    const boxFormIcon = document.createElement('i');
    boxFormIcon.className = 'box-form__icon typcn typcn-heart-full-outline';
    boxFormIcon.id = `box-form_icon->${form.id_form}`;
    // Data for the form, it's compose with: input:text {form's name}, two icons
    // and a label for the input text
    const boxFormData = document.createElement('div');
    boxFormData.className = 'box-form__data';
    boxFormData.id = `box-form__data->${form.id_form}`;
    // Input:text {name's form}
    const boxFormInput = document.createElement('input');
    boxFormInput.type = 'text';
    boxFormInput.className = 'box-form__title';
    boxFormInput.id = `box-form__title->${form.id_form}`;
    boxFormInput.setAttribute("disabled", null);
    boxFormInput.name = `box-form__title->${form.id_form}`;
    boxFormInput.value = form.title_form;
    boxFormInput.onchange = () => this.updateForm(form.id_form);
    // label - icon to change the name
    const boxFormInputLabel = document.createElement('label');
    boxFormInputLabel.className = 'box-form__inputLabel typcn typcn-pencil text_edit_icon';
    boxFormInputLabel.id = `box-form__inputLabel-->${form.id_form}`;
    boxFormInputLabel.htmlFor = `box-form__title-->${form.id_form}`;
    boxFormInputLabel.onclick = () => this.editText(boxForm.id);
    // i - icon to leave the edition name
    const boxFormInputIcon = document.createElement('i');
    boxFormInputIcon.className = 'box-form__inputLabel typcn typcn-arrow-back text_back_icon';
    boxFormInputIcon.onclick = () => this.closeText(boxForm.id);
    // Menu options for the form: edit, remove
    const boxFormMenuOptions = document.createElement('div');
    boxFormMenuOptions.id = `box-form__menu-options-->${form.id_form}`;
    boxFormMenuOptions.className = 'menu-options';
    // Options
    // Edit
    const boxFormGoTo = document.createElement('a');
    boxFormGoTo.className = 'box-form__goto';
    boxFormGoTo.id = `box-form__goto->${form.id_form}`;
    boxFormGoTo.innerText = "Editar";
    boxFormGoTo.href = `${url}form_builder/?form_id=${form.id_form}`;
    // Remove
    const boxFormRemove = document.createElement('a');
    boxFormRemove.className = 'box-form__remove';
    boxFormRemove.innerText = "Eliminar";
    boxFormRemove.id = `box-form__remove->${form.id_form}`
    boxFormRemove.onclick = () => this.removeForm(form.id_form);

    boxFormData.append(boxFormInput, boxFormInputLabel, boxFormInputIcon);

    boxFormMenuOptions.append(boxFormGoTo, boxFormRemove);

    boxForm.append(boxFormButtonOptions, boxFormIcon, boxFormData, boxFormMenuOptions);

    this.main.appendChild(boxForm);

  }


  editText(position) {
    const intpos = Number(position);
    const btnPen = document.getElementsByClassName("text_edit_icon");
    const btnBack = document.getElementsByClassName("text_back_icon")
    const textNameForms = document.getElementsByClassName("box-form__title");
    textNameForms[intpos - 1].removeAttribute("disabled");
    btnPen[intpos - 1].style.display = "none";
    btnBack[intpos - 1].style.display = "inline";
  }

  closeText(position) {
    const intpos = Number(position);
    const btnPen = document.getElementsByClassName("text_edit_icon");
    const btnBack = document.getElementsByClassName("text_back_icon")
    const textNameForms = document.getElementsByClassName("box-form__title");
    textNameForms[intpos-1].setAttribute("disabled", null);
    btnPen[intpos-1].style.display = "inline";
    btnBack[intpos-1].style.display = "none";
  }

  openOptions(position){
    const intpost = Number(position);
    const btnFormOptions = document.getElementsByClassName("button-options");
    const options = document.getElementsByClassName("menu-options");
    options[intpost-1].classList.toggle("activeMenu");
  }

}