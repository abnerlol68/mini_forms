import Answer from '../js/Model/Answer.js';
import Question from '../js/Model/Question.js';

document.addEventListener('DOMContentLoaded', function () {
  localStorage.clear();

  const question = new Question();

  question.addQuest('Genero', 'radio', new Answer());
  question.addAns(1, 'Mujer');

  console.log(question.getQuestSet());
})
