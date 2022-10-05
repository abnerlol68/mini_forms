import ProtoQuestion from './Base/ProtoQuestion.js';

export default class Question {
  constructor() {
    this.questSet = JSON.parse(localStorage.getItem('quests'));
    if (!this.questSet || this.questSet.length < 1) {
      this.questSet = [new ProtoQuestion()];
      this.currentQuestId = 1;
      this.save();
    } else {
      this.currentQuestId = this.questSet[this.questSet.length - 1].id + 1;
    }
  }

  save() {
    localStorage.setItem('quests', JSON.stringify(this.questSet));
  }

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
    const quest = new ProtoQuestion(
      this.currentQuestId++, title, type, ansSet
    );
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
    this.questSet[questIndex] = quest;
  }

  addAns(questId, desc) {
    const questIndex = this.getQuestIndex(questId);
    this.questSet[questIndex].ansSet.addAns(desc);
  }
}
