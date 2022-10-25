import View from '../View/FormBuilder.js';
import Controller from '../Controller/FormBuilder.js';

document.addEventListener('DOMContentLoaded', function () {
  const controller = new Controller();
  const view = new View();

  view.setController(controller);
  view.render();
});