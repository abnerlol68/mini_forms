export default class ProtoAnswer {
    /**
     *
     * @param {number} id - Id for answer
     * @param {string} description - Description of answer
     */
    constructor(id, description) {
        this.id = id || 0;
        this.description = description || 'Opción';
    }
}