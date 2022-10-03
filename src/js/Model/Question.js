export default class Question {
  /**
   * 
   * @param {number} id - Question id
   * @param {string} title - Question title
   * @param {string} type - Questions type. Values: ['text', 'radio', 'checkbox', 'select']
   * @param {(string[]|string)} ansSet - List of answer options for the question or a simple text
   */
  constructor(id, title, type, ansSet) {
    this.id = id || 0;
    this.title = title || 'Pregunta sin titulo';
    this.type = type || 'text';
    this.ansSet = ansSet || 'Texto en respuesta de la pregunta';
  }
}