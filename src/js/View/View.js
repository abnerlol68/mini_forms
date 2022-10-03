export default class View {
  constructor() {
    this.controller = null;
    this.main = document.getElementsByTagName('main')[0];
  }

  setController(controller) {
    this.controller = controller;
  }

  render() {
    const quests = this.controller.getQuests();
    quests.forEach(quest => this.createQuest(quest));
  }
  
  addQuest(title, type, ansSet) {
    const quest = this.controller.addQuest(title, type, ansSet);
    this.createQuest(quest);
  }

  updateQuest() {

  }

  removeQuest(id) {
    this.controller.removeQuest(id);
    document.getElementById(id).remove();
  }

  createQuest(quest) {
    const questContent = document.createElement('div');
    questContent.className = 'quest';
    questContent.id = quest.id;

    const questTitle = document.createElement('input');
    questTitle.type = 'text';
    questTitle.className = 'quest__title';
    questTitle.id = `questTitle${quest.id}`;

    const questType = document.createElement('select');
    questType.className = 'quest__type';
    questType.id = `questType${quest.id}`;
    questType.innerHTML = `
      <option value="text">Respuesta de texto</option>
      <option value="radio">Opción Multiple</option>
      <option value="checkbox">Opciones de casillas</option>
      <option value="select">Lista desplegable</option>
    `;
    questType.value = quest.type;
    
    const ansSetContainer = document.createElement('div');
    ansSetContainer.className = `quest__ans-set`;
    ansSetContainer.id = `ansSet${quest.id}`;
    
    this.addAnsSet(quest.id, questType.value, quest.ansSet, ansSetContainer);
    questType.onchange = () => this.addAnsSet(
      quest.id, questType.value, quest.ansSet, ansSetContainer
    );

    const addNewAnsOpt = document.createElement('button');
    addNewAnsOpt.className = 'quest__ans--new-opt';
    addNewAnsOpt.innerText = 'Agregar Opción';
    addNewAnsOpt.onclick = () => this.addAnsOpt(quest.id, ansSetContainer);

    const btnSave = document.createElement('button');
    btnSave.innerText = 'Guardar';
    btnSave.className = 'quest__save';
    btnSave.title = 'Guardar Pregunta';
    btnSave.onclick;

    const btnRemove = document.createElement('button');
    btnRemove.innerText = 'Eliminar';
    btnRemove.className = 'quest__remove';
    btnRemove.title = 'Eliminar Pregunta';
    btnRemove.onclick = () => this.removeQuest(quest.id);

    const btnAdd = document.createElement('button');
    btnAdd.innerText = 'Agregar';
    btnAdd.className = 'quest__add';
    btnAdd.title = 'Agregar Pregunta';
    btnAdd.onclick = () => this.addQuest();

    questContent.append(
      questTitle,
      questType,
      ansSetContainer,
      addNewAnsOpt,
      btnSave,
      btnRemove,
      btnAdd
    );

    this.main.appendChild(questContent);
  }

  addAnsSet(questId, questType, questAnsSet, ansSetContainer) {
    this.controller.updateQuestType(questId, questType);
    ansSetContainer.innerHTML = '';
    
    if (questType === 'text' && typeof(questAnsSet) === 'string') {
      const ansSetText = document.createElement('p');
      ansSetText.innerText = questAnsSet;
      ansSetContainer.appendChild(ansSetText);
      return;
    }
    
    if (typeof(questAnsSet) === 'string') {
      const ansSetOpt = document.createElement('input');
      ansSetOpt.className = 'quest__ans-set--opt';
      ansSetOpt.value = ansSetOpt.value || 'Opción';

      this.controller.addAnsSet(questId, [ansSetOpt.value]);
      
      const ansSetOptDel = document.createElement('button');
      ansSetOptDel.className = 'quest__ans-set--opt-del';
      ansSetOptDel.innerText = ' X ';

      ansSetContainer.append(ansSetOpt, ansSetOptDel);
      return;
    }

    const ansOptSet = questAnsSet.map(opt => {
      const ansSetOpt = document.createElement('input');
      ansSetOpt.className = 'quest__ans-set--opt';
      ansSetOpt.value = opt || 'Opción';

      const ansSetOptDel = document.createElement('button');
      ansSetOptDel.className = 'quest__ans-set--opt-del';
      ansSetOptDel.innerText = ' X ';
      
      ansSetContainer.append(ansSetOpt, ansSetOptDel);
      return opt;
    });
    
    this.controller.addAnsSet(questId, ansOptSet);
  }

  addAnsOpt(questId, ansSetContainer) {
    const ansSetOpt = document.createElement('input');
    ansSetOpt.className = 'quest__ans-set--opt';
    ansSetOpt.value = ansSetOpt.value || 'Opción';

    const ansSetOptDel = document.createElement('button');
    ansSetOptDel.className = 'quest__ans-set--opt-del';
    ansSetOptDel.innerText = ' X ';

    ansSetContainer.append(ansSetOpt, ansSetOptDel);

    this.controller.setAnsOpt(questId, ansSetOpt.value);
  }
}