// import View from '../View/FormBuilder.js';
// import Controller from '../Controller/FormBuilder.js';

// document.addEventListener('DOMContentLoaded', function () {
//   const controller = new Controller();
//   const view = new View();

//   view.setController(controller);
//   view.render();
// });

import Controller from '../Controller/FormBuilder.js';

document.addEventListener('DOMContentLoaded', async function () {
  const controller = new Controller();
  const ctrlQuest = controller.question;
  // console.log(await controller.question.requestQuests());
  // console.log(await ctrlQuest.getQuestSet());
  // console.log(await ctrlQuest.getQuestIndex(2));
  // console.log(await ctrlQuest.getQuest(2));
  // console.log(await ctrlQuest.addQuest(
  //   // Soon the id will not be passed since from the DB it is auto-increment
  //   51, 'P41: OK?', 'text', Number(document.getElementById('form_id').innerText)
  // ));
  // console.log(ctrlQuest.removeQuest(51, 1));
  // ctrlQuest.updateQuest(51, 1, 'P41: Change?', 'radio',);

  // console.log(await ctrlQuest.getOptSet(4));
  // console.log(await ctrlQuest.getOptIndex(4, 2));
  // console.log(await ctrlQuest.getOpt(4, 2));
  // console.log(await ctrlQuest.addAns('op51: Test Add', 48));
  // ctrlQuest.removeOpt(48, 52);
  // ctrlQuest.updateOpt(55, 'op51: Test Change', 48);
});
