import Question from '../Model/Question.js';

export default class View {
  constructor() {
    this.controller = null;
    this.main = document.getElementsByTagName('main')[0];
  }

  setController(controller) {
    this.controller = controller;
  }

  render() {
    const questions = this.controller.getQuestions();
    questions.forEach(question => this.createQuestion(question));
  }
  
  addQuestion(title, type, responseChannel) {
    const question = this.controller.addQuestion(title, type, responseChannel);
    this.createQuestion(question);
  }

  updateQuestion() {

  }

  removeQuestion(id) {
    this.controller.removeQuestion(id);
    document.getElementById(id).remove();
  }

  createQuestion(question) { 
    const questionContent = document.createElement('div');
    questionContent.className = 'question';
    questionContent.id = question.id;

    const questionTitle = document.createElement('input');
    questionTitle.type = 'text';
    questionTitle.className = 'question__title';
    questionTitle.id = `question__title--${question.id}`;

    const questionType = document.createElement('select');
    questionType.className = 'question__type';
    questionType.id = `question__type--${question.id}`;
    questionType.innerHTML = `
      <option value="text">Respuesta de texto</option>
      <option value="radio">Opción Multiple</option>
      <option value="checkbox">Opciones de casillas</option>
      <option value="select">Lista desplegable</option>
    `;

    const btnSave = document.createElement('button');
    btnSave.innerText = 'Guardar';
    btnSave.className = 'question__save';
    btnSave.title = 'Guardar Pregunta';
    btnSave.onclick;

    const btnRemove = document.createElement('button');
    btnRemove.innerText = 'Eliminar';
    btnRemove.className = 'question__remove';
    btnRemove.title = 'Eliminar Pregunta';
    btnRemove.onclick = () => this.removeQuestion(question.id);

    const btnAdd = document.createElement('button');
    btnAdd.innerText = 'Agregar';
    btnAdd.className = 'question__add';
    btnAdd.title = 'Agregar Pregunta';
    btnAdd.onclick = () => {
      // this.createQuestion(new Question());
      this.addQuestion();
    }

    questionContent.append(
      questionTitle, questionType, btnSave, btnRemove, btnAdd
    );

    this.main.appendChild(questionContent);
    
    console.log(this.controller.questionSet);
  }
}