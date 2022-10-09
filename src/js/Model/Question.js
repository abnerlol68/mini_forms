import ProtoQuestion from './Base/ProtoQuestion.js';
import ProtoAnswer from './Base/ProtoAnswer.js';

export default class Question {
  constructor() {
    this.questSet = JSON.parse(localStorage.getItem('quests'));
    if (!this.questSet || this.questSet.length < 1) {
      this.questSet = [new ProtoQuestion()];
      this.currentQuestId = 1;
      this.save();
    } else {
      this.currentQuestId = (
        this.questSet[this.questSet.length - 1].id + 1
      );
    }
  }

  save() {
    localStorage.setItem('quests', JSON.stringify(this.questSet));
  }

  /* CRUD Question */

  getQuestSet() {
    return [...this.questSet];
  }

  getQuestIndex(id) {
    return this.questSet.findIndex(quest => quest.id === id);
  }

  getQuest(id) {
    return this.questSet.find(quest => quest.id === id);
  }

  addQuest(title, type, ansSet) {
    const quest = 
      new ProtoQuestion(this.currentQuestId++, title, type, ansSet);
    this.questSet.push(quest);
    this.save();
    return {...quest};
  }

  removeQuest(id) {
    const questIndex = this.getQuestIndex(id);
    this.questSet.splice(questIndex, 1);
    this.save();
  }

  updateQuest(id, quest) {
    const questIndex = this.getQuestIndex(id);
    this.questSet[questIndex] = 
      new ProtoQuestion(quest.id, quest.title, quest.type, quest.ansSet);
    this.save();
  }

  /* CRUD Answer */

  getAnsSet(questId) {
    return [...this.getQuest(questId).ansSet];
  }

  getAnsIndex(questId, ansId) {
    const quesIndex = this.getQuestIndex(questId);
    return this.questSet[quesIndex].ansSet.findIndex(ans => ans.id === ansId);
  }

  /**
   * 
   * @param {*} questId 
   * @param {text} ansSet - [text|answers]
   */
  setAnsSet(questId, ansSet) {
    const questIndex = this.getQuestIndex(questId);

    if (ansSet === 'text')
      this.questSet[questIndex].ansSet = 'Texto en respuesta de la pregunta';

    if (ansSet === 'answers')
      this.questSet[questIndex].ansSet = [new ProtoAnswer()];

    this.save();
  }

  getLastAnsId(questId) {
    return Math.max(...this.getAnsSet(questId).map(ans => ans.id));
  }

  addAns(questId, desc) {
    const answer = new 
      ProtoAnswer(this.getLastAnsId(questId) + 1, desc);
    const questIndex = this.getQuestIndex(questId);
    this.questSet[questIndex].ansSet.push(answer);
    this.save();
    return {...answer};
  }

  removeAns(questId, ansId) {
    const questIndex = this.getQuestIndex(questId);
    const ansIndex = this.getAnsIndex(questId, ansId);
    this.questSet[questIndex].ansSet.splice(ansIndex, 1);
    this.save();
  }
}
