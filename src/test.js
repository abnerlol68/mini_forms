const mainForm = document.getElementById('mainForm');

// const questionPanel = document.createElement('div');
//   const questionTitle = document.createElement('input');
//   questionTitle.placeholder = 'Titulo de la pregunta';

//   const questionType = document.createElement('select');
  
//   const questionTypeOption1 = document.createElement('option');
//   questionTypeOption1.value = 'A';
//   questionTypeOption1.innerText = 'A';
//   questionType.append(questionTypeOption1);

//   const questionContent = document.createElement('p');
//   questionContent.innerText = 'Mucho texto'

//   const questionDrop = document.createElement('button');
//   questionDrop.innerText = 'Eliminar';

// questionPanel.appendChild(questionTitle);
// questionPanel.append(questionType, questionContent, questionDrop);

// mainForm.appendChild(questionPanel);

const addQuestion = function (form, {
  title = 'Titulo de la pregunta',
  option = {value: '', innerText: ''},
  content = 'Texto de respuesta',
}) {
  
}

addQuestion(mainForm, {
  title: 'Primer pregunta',
  option: {
    value: 'OptionA',
    innerText: 'OptionA'
  },
});
