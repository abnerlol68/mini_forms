import MdlForm from '../Model/Form.js';

export default class Form {
  constructor() {
    this.formSet = JSON.parse(localStorage.getItem('forms'));
    if (!this.formSet || this.formSet.length < 1) {
      this.formSet = [new MdlForm()];
      this.currentFormId = 1;
    } else {
      this.currentFormId = this.formSet[this.formSet.length - 1].id + 1;
    }
  }

  save() {
    localStorage.setItem('forms', JSON.stringify(this.formSet));
  }

  /* CRUD Forms */

  getFormSet() {
    return [...this.formSet];
  }

  getFormIndex(id) {
    return this.formSet.findIndex(form => form.id === id);
  }

  getForm(id) {
    return this.formSet.find(form => form.id === id);
  }

  addForm(title, author) {
    const form = new MdlForm(this.currentFormId++, title, author);
    this.formSet.push(form);
    this.save();
  }

  removeForm(id) {
    const formIndex = this.getFormIndex(id);
    this.formSet.splice(formIndex, 1);
    this.save();
  }

  updateForm(id, form) {
    const formIndex = this.getFormIndex(id);
    this.formSet[formIndex] = new MdlForm(form.title, form.author);
    this.save();
  }
}
