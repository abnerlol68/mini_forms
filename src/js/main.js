import Controller from './Controller/Controller.js';
import View from './View/View.js';

document.addEventListener('DOMContentLoaded', function () {
  const controller = new Controller();
  const view = new View();

  view.setController(controller);

  view.render();
})
