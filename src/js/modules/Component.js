export default class Component {
  constructor(options) {
    this.element = options.element;
    this.data = options.data;
    this.template = options.template;
  }

  render() {
    const $element = document.querySelector(this.element);
    if (!$element) return;
    
    $element.innerHTML = this.template(this.data);

    console.log(this.data);
  }

  // Update State with reactive form
  setState(newState) {
    for (const key in newState) {
      if (this.data.hasOwnProperty(key)) {
        this.data[key] = newState[key];
      }
    }
    this.render();
  }
  // Get copy from immutable State
  getState() {
    return {...this.data};
  }
}
