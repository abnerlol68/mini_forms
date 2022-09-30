export default class Question {
  /**
   * 
   * @param {number} id - Question id
   * @param {string} title - Question title
   * @param {string} type - Questions type. Values: ['text', 'radio', 'checkbox', 'select']
   * @param {(Object[]|string)} responseChannel - List of answer options for the question or a simple text
   */
  constructor(id, title, type, responseChannel) {
    this.id = id || 0;
    this.title = title || 'Pregunta sin titulo';
    this.type = type || 'text';
    this.responseChannel = responseChannel || 'Texto en respuesta de la pregunta';
  }
}