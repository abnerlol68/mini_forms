export default class View {
  constructor() {
    this.ctrl = null;
  }

  setController(controller) {
    this.ctrl = controller;
  }

  render() {
    const forms = this.ctrl.form.getFormSet();
    forms.forEach(frm => this.createForm(frm));
  }

  addForm(title, author) {
    const form = this.ctrl.form.addForm(title, author);
    this.createForm(form);
  }

  removeForm(id) {
    this.ctrl.form.removeForm(id);
    document.getElementById(id).remove();
  }

  updateForm(id) {
    /* ... */
  }

  createForm(form) {
    const formContent = document.createElement('a');
    formContent.className = 'box-form';
    // Pull info from php
    formContent.href = `<?= constant('URL') . 'form_builder/?id=' . $form['id_form'] ?>`;

    const formIcon = document.createElement('img');
    formIcon.src = `public/assets/img/icon-form.png`;

    const formTitle = document.createElement('span');
    formTitle.className = 'box-form__title';
    formTitle.innerText = `<?= $form['title_form'] ?>`;

    formContent.append(formIcon, formTitle);
  }
}