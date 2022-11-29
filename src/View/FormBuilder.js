import Controller from '../Controller/FormBuilder.js';

export default class View {
    constructor() {
        this.ctrl = new Controller();
        this.ctrlQuest = this.ctrl.question;
        this.main = document.getElementsByTagName('main')[0];
        this.questContainer = document.getElementById('quest-container');
    }

    async render() {
        const questions = await this.ctrlQuest.getQuestSet();

        if (questions.length === 0) {
            this.addQuest('Pregunta', 'text', this.ctrlQuest.form);
        } else {
            questions.forEach(quest => this.createQuest(quest));
        }

        const btnAdd = document.createElement('button');
        btnAdd.className = 'quest__add';
        btnAdd.innerText = 'Agregar';
        btnAdd.title = 'Agregar Pregunta';
        btnAdd.onclick = () => this.addQuest('Pregunta', 'text', this.ctrlQuest.form);

        this.main.append(btnAdd);
    }

    getElementId(id) {
        return Number(id.split('->')[1]);
    }

    /*==== CRUD Questions ====*/

    createQuest(quest) {
        const questContent = document.createElement('div');
        questContent.className = 'quest';
        questContent.id = quest.id_question;

        const questTitle = document.createElement('input');
        questTitle.type = 'text';
        questTitle.className = 'quest__title';
        questTitle.id = `quest__title->${quest.id_question}`;
        questTitle.value = quest.description_question;
        questTitle.onchange = () => {
            this.updateQuest(quest.id_question, quest.id_form);
        }

        const questType = document.createElement('select');
        questType.className = 'quest__type';
        questType.id = `quest__type->${quest.id_question}`;
        questType.innerHTML = `
      <option value="text">Respuesta de texto</option>
      <option value="radio">Opción Multiple</option>
      <option value="checkbox">Opciones de casillas</option>
      <option value="select">Lista desplegable</option>
    `;
        questType.value = quest.type_question;
        questType.onchange = () => {
            this.updateQuest(quest.id_question, quest.id_form);
        }

        const optSetContainer = document.createElement('div');
        optSetContainer.className = `quest__opt-set`;
        optSetContainer.id = `quest__opt-set->${quest.id_question}`;

        this.setOptSet(quest.id_question, quest.type_question, optSetContainer);

        const btnNewOpt = document.createElement('button');
        btnNewOpt.className = 'quest__new-opt';
        btnNewOpt.id = `quest__new-opt->${quest.id_question}`;
        btnNewOpt.innerText = 'Agregar Opción';
        btnNewOpt.style.display = (questType.value === 'text')
            ? 'none' : 'block';
        btnNewOpt.onclick = () => {
            this.addOpt(quest.id_question, 'Opción', optSetContainer);
        }

        const btnRemove = document.createElement('button');
        btnRemove.className = 'quest__remove';
        btnRemove.id = `quest__remove->${quest.id_question}`;
        btnRemove.innerText = 'Eliminar';
        btnRemove.title = 'Eliminar Pregunta';
        btnRemove.onclick = () => this.removeQuest(quest.id_question, quest.id_form);

        questContent.append(
            questTitle,
            questType,
            optSetContainer,
            btnNewOpt,
            btnRemove
        );

        this.questContainer.appendChild(questContent);
    }

    async addQuest(title, type, idForm) {
        const quest = await this.ctrlQuest.addQuest(title, type, idForm);
        this.createQuest(quest);
    }

    removeQuest(questId, formId) {
        this.ctrlQuest.removeQuest(questId, formId);
        document.getElementById(questId).remove();
    }

    updateQuest(questId, formId) {
        const title = document.getElementById(`quest__title->${questId}`).value;
        const type = document.getElementById(`quest__type->${questId}`).value;
        const optSetContainer = document.getElementById(`quest__opt-set->${questId}`);
        const itWasText = Array.from(optSetContainer.children)
            .find(item => item.localName === 'p')?.localName === 'p';

        if (!itWasText && type === 'text') {
            this.ctrlQuest.removeOptSet(questId);
            optSetContainer.innerHTML = `<p>Texto en respuesta de la pregunta</p>`;
            document.getElementById(`quest__new-opt->${questId}`).style.display = 'none';
        }

        if (itWasText && type !== 'text') {
            optSetContainer.innerHTML = ``;
            this.addOpt(questId, 'Opción', optSetContainer);
            document.getElementById(`quest__new-opt->${questId}`).style.display = 'block';
        }

        this.ctrlQuest.updateQuest(questId, formId, title, type);
    }

    /*==== CRUD Options ====*/

    async setOptSet(questId, questType, optSetContainer) {
        if (questType === 'text') {
            optSetContainer.innerHTML = `<p>Texto en respuesta de la pregunta</p>`;
            return;
        }

        const optSet = await this.ctrlQuest.getOptSet(questId);
        optSet.forEach(opt => this.createOpt(opt, optSetContainer));
    }

    createOpt(option, containerOpt) {
        const optInput = document.createElement('input');
        optInput.type = 'text';
        optInput.className = 'quest__opt-set__opt-input';
        optInput.id = `quest__opt-set__opt-input->${option.id_option}`;
        optInput.value = option.description_option;
        optInput.onchange = () => {
            this.updateOpt(option.id_option, option.id_question);
        }

        const btnRemoveOpt = document.createElement('button');
        btnRemoveOpt.className = 'quest__opt-set__opt-remove typcn typcn-times';
        btnRemoveOpt.id = `quest__opt-set__opt-remove->${option.id_option}`;
        // btnRemoveOpt.innerText = ' X ';
        btnRemoveOpt.onclick = () => {
            this.removeOpt(option.id_question, option.id_option);
        }

        containerOpt.append(optInput, btnRemoveOpt);
    }

    async addOpt(questId, desc, container) {
        const opt = await this.ctrlQuest.addOpt(desc, questId);
        this.createOpt(opt, container);
    }

    removeOpt(questId, optId) {
        document.getElementById(`quest__opt-set__opt-input->${optId}`).remove();
        document.getElementById(`quest__opt-set__opt-remove->${optId}`).remove();
        this.ctrlQuest.removeOpt(questId, optId);
    }

    updateOpt(optId, questId) {
        const option = document.getElementById(`quest__opt-set__opt-input->${optId}`);
        const desc = option.value;
        this.ctrlQuest.updateOpt(optId, desc, questId);
    }
}
