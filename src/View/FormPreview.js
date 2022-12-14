import Controller from '../Controller/FormPreview.js';

export default class View {
  constructor() {
    this.ctrlQuest = new Controller();
    this.main = document.getElementsByTagName('main')[0];
  }

  async render() {
    const questions = await this.ctrlQuest.getQuestSet();
    questions.forEach(quest => this.createQuest(quest));
  }

  getElementId(id) {
    return Number(id.split('->')[1]);
  }

  async createQuest(quest) {
    const questContent = document.createElement('div');
    questContent.className = 'quest';

    const questTitle = document.createElement('p');
    questTitle.className = 'quest__tittle';
    questTitle.innerText = `${quest.description_question}`;

    const optSetContainer = document.createElement('div');
    optSetContainer.className = 'options';

    this.setOptSet(quest.id_question, quest.type_question, optSetContainer);

    questContent.append(questTitle, optSetContainer);

    this.main.appendChild(questContent);
  }

  async setOptSet(questId, questType, optSetContainer) {
    if (questType === 'text') {
      optSetContainer.innerHTML = `
        <input 
          type="text" 
          name="quest_name->${questId}" 
          id="quest_res->${questId}"
          class="quest_res_text"
        >
      `;
      return;
    }

    const optSet = await this.ctrlQuest.getOptSet(questId);

    if (questType === 'select') {
      const optSetSelect = document.createElement('select');
      optSetSelect.name = `quest_name->${questId}`;
      optSet.forEach(opt => this.createOpt(opt, questType, optSetSelect));
      return;
    }

    optSet.forEach(opt => this.createOpt(opt, questType, optSetContainer));
  }

  createOpt(opt, questType, container) {
    if (questType === 'radio') {
      container.className = 'options multiple-box-option';
      const optInput = document.createElement('input');
      const designInput = document.createElement('span');
      designInput.className = 'radio-custom';
      optInput.type = 'radio';
      optInput.name = `quest_name->${opt.id_question}`;
      optInput.id = `quest_res->${opt.id_option}`;
      optInput.value = `${opt.description_option}`;

      const optLabel = document.createElement('label');
      optLabel.setAttribute('for', `quest_res->${opt.id_option}`);
      optLabel.innerText = `${opt.description_option}`;
      optLabel.style.height = '20px';
      container.append(optInput, designInput, optLabel);
      return;
    }

    if (questType === 'checkbox') {
      container.className = 'options multiple-box-option';
      const optInput = document.createElement('input')
      const designInput = document.createElement('span');
      designInput.className = 'check-custom';
      optInput.type = 'checkbox';
      optInput.name = `quest_name->${opt.id_question}[]`;
      optInput.id = `quest_res->${opt.id_option}`;
      optInput.value = `${opt.description_option}`;

      const optLabel = document.createElement('label');
      optLabel.setAttribute('for', `quest_res->${opt.id_option}`);
      optLabel.innerText = `${opt.description_option}`;
      optLabel.style.height = '20px';

      container.append(optInput, designInput, optLabel);
      return;
    }

    if (questType === 'select') {
      const optInput = document.createElement('option');
      optInput.innerText = `${opt.description_option}`;

      container.append(optInput);
      return;
    }
  }
}