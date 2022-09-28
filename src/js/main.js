import Component from './modules/Component.js';

const mainForm = document.getElementById('mainForm');

const options = new Component({
  element: '#options',
  data: {
    optionsSet: []
  },
  template: function (properties) {
    if (properties.optionsSet.length < 1) {
      properties.optionsSet.push(`
        <input type="text" placeholder="Option 1">
        <button>Eliminar</button><br>
      `);
    }

    const optionsList = properties.optionsSet
      .map(item => item).join('');

    return optionsList;
  }
});

document.addEventListener('DOMContentLoaded', options.render());

const newOption = document.getElementById('newOption');
newOption.addEventListener('click', function (eve) {
  eve.preventDefault();
  
  const optionToPush = options.getState();
  optionToPush.optionsSet.push(`
    <input type="text" placeholder="Option X">
    <button>Eliminar</button><br>
  `);

  options.setState({ optionsSet: optionToPush.optionsSet });
})