import Question from '../Model/Question.js';

export default class Controller {
  constructor() {
    this.view = null;
    this.questionSet = JSON.parse(localStorage.getItem('questions'));
    if (!this.questionSet || this.questionSet.length < 1) {
      this.questionSet = [new Question()];
      this.currentQuestionId = 1;
    } else {
      this.currentQuestionId = this.questionSet[this.questionSet.length - 1].id + 1;
    }
  }

  setView(view) {
    this.view = view;
  }

  save() {
    localStorage.setItem('questions', JSON.stringify(this.questionSet));
  }

  getQuestions() {
    return this.questionSet.map(question => ({...question}));
  }

  findQuestion(id) {
    return this.questionSet.findIndex(question => question.id === id);
  }

  updateQuestion(question) {
    const index = this.findQuestion(question.id);
    Object.assign(this.questionSet[index], question);
    this.save();
  }

  addQuestion(title, type, responseChannel) {
    const question = new Question(
      this.currentQuestionId++, title, type, responseChannel
    );
    this.questionSet.push(question);
    this.save();
    return {...question};
  }

  removeQuestion(id) {
    const index = this.findQuestion(id);
    this.questionSet.splice(index, 1);
    this.save();
  }
}