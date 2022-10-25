// import Controller from '../Controller/Home.js';
// import View from '../View/Home.js';

// document.addEventListener('DOMContentLoaded', function () {
//   const controller = new Controller();
//   const view = new View();

//   view.setController(controller);
//   view.render();
// });

document.addEventListener('DOMContentLoaded', async () => {
  try {
    const forms = await (await fetch('requests/?req=get_forms')).json();
    console.log(forms);
  } catch (err) {
    console.error(err);
  }
});
