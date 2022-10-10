import MdlAnswer from '../Model/Answer.js';

export default class View {
  constructor() {
    this.ctrl = null;
    this.question = null;
    this.main = document.getElementsByTagName('main')[0];
  }

  setController(controller) {
    this.ctrl = controller;
    this.question = this.ctrl.question;
  }

  render() {
    const questSet = this.question.getQuestSet();
    questSet.forEach(quest => this.createQuest(quest));
  }

  getElementId(id) {
    return Number(id.split('->')[1]);
  }

  addQuest(title, type, ansSet) {
    const quest = this.question.addQuest(title, type, ansSet);
    this.createQuest(quest);
  }

  removeQuest(id) {
    this.question.removeQuest(id);
    document.getElementById(id).remove();
  }

  updateQuest(id) {
    const title = document.getElementById(`quest__title->${id}`).value;

    const type = document.getElementById(`quest__type->${id}`).value;

    const ansSetList = Array
      .from(document.getElementById(`quest__ans-set->${id}`).children);

    const ansSet = ansSetList
      .filter(child => child.localName === 'input')
      .map(ans => new MdlAnswer(this.getElementId(ans.id), ans.value));

    this.question.updateQuest(id, {
      id,
      title,
      type,
      ansSet: (type === 'text') ? ansSetList[0].innerText : ansSet
    });
  }

  setAnsSet(questId, containerAux) {
    const ansSet = this.question.getQuest(questId).ansSet;
    ansSet.forEach(ans => this.createAns(questId, ans, containerAux));
  }

  addAns(questId, desc) {
    const ans = this.question.addAns(questId, desc);
    this.createAns(questId, ans);
  }

  removeAns(questId, ansId) {
    document.getElementById(`ans-set__ans-input->${ansId}`).remove();
    document.getElementById(`ans-set__ans-remove->${~nsId}`).remove();
    
    this.question.removeAns(questId, ansId);
  }

  createAns(questId, answer, containerAux) {
    const container = document.getElementById(`quest__ans-set->${questId}`);

    const ansInput = document.createElement('input');
    ansInput.type = 'text';
    ansInput.className = 'ans-set__ans-input';
    ansInput.id = `ans-set__ans-input->${answer.id}`;
    ansInput.value = answer.description;

    const btnRemoveAns = document.createElement('button');
    btnRemoveAns.className = 'ans-set__ans-remove';
    btnRemoveAns.id = `ans-set__ans-remove->${answer.id}`;
    btnRemoveAns.innerText = ' X ';
    btnRemoveAns.onclick = () => {
      this.removeAns(questId, answer.id);
    }

    if (!container) {
      containerAux.append(ansInput, btnRemoveAns);
      return;
    }

    container.append(ansInput, btnRemoveAns);
  }
  
  createQuest(quest) {
    const questContent = document.createElement('div');
    questContent.className = 'quest';
    questContent.id = quest.id;
    
    const questTitle = document.createElement('input');
    questTitle.type = 'text';
    questTitle.className = 'quest__title';
    questTitle.id = `quest__title->${quest.id}`;
    questTitle.value = quest.title;
    
    const questType = document.createElement('select');
    questType.className = 'quest__type';
    questType.id = `quest__type->${quest.id}`;
    questType.innerHTML = `
      <option value="text">Respuesta de texto</option>
      <option value="radio">Opción Multiple</option>
      <option value="checkbox">Opciones de casillas</option>
      <option value="select">Lista desplegable</option>
    `;
    questType.value = quest.type;
  
    const ansSetContainer = document.createElement('div');
    ansSetContainer.className = `quest__ans-set`;
    ansSetContainer.id = `quest__ans-set->${quest.id}`;
  
    if (questType.value === 'text') ansSetContainer.innerHTML = `
      <p>${quest.ansSet}</p>
    `;
    if (questType.value !== 'text') this.setAnsSet(quest.id, ansSetContainer);

    questType.onchange = () => {
      this.question.updateQuest(quest.id, {
        id: quest.id, 
        title: quest.title, 
        type: questType.value
      });

      document.getElementById(`quest__ans-set->${quest.id}`).innerHTML = '';

      if (questType.value === 'text') {
        btnNewAns.style.display = 'none';
      }

      if (questType.value !== 'text') {
        btnNewAns.style.display = 'block';

        if (typeof this.question.getQuest(quest.id).ansSet === 'string') {
          this.question.setAnsSet(quest.id, 'answers');
        }

        this.setAnsSet(quest.id)
      }
    };
  
    const btnNewAns = document.createElement('button');
    btnNewAns.className = 'quest__new-ans';
    btnNewAns.id = `quest__new-ans->${quest.id}`;
    btnNewAns.innerText = 'Agregar Respuesta';
    btnNewAns.style.display = (questType.value === 'text') 
      ? 'none' : 'block';
    btnNewAns.onclick = () => this.addAns(quest.id);
  
    const btnSave = document.createElement('button');
    btnSave.className = 'quest__save';
    btnSave.id = `quest__save->${quest.id}`;
    btnSave.innerText = 'Guardar';
    btnSave.title = 'Guardar Pregunta';
    btnSave.onclick = () => this.updateQuest(quest.id);
  
    const btnRemove = document.createElement('button');
    btnRemove.className = 'quest__remove';
    btnRemove.id = `quest__remove->${quest.id}`;
    btnRemove.innerText = 'Eliminar';
    btnRemove.title = 'Eliminar Pregunta';
    btnRemove.onclick = () => this.removeQuest(quest.id);
  
    const btnAdd = document.createElement('button');
    btnAdd.className = 'quest__add';
    btnAdd.id = `quest__add->${quest.id}`;
    btnAdd.innerText = 'Agregar';
    btnAdd.title = 'Agregar Pregunta';
    btnAdd.onclick = () => this.addQuest();
  
    questContent.append(
      questTitle,
      questType,
      ansSetContainer,
      btnNewAns,
      btnSave,
      btnRemove,
      btnAdd
    );
  
    this.main.appendChild(questContent);  
  }
}
