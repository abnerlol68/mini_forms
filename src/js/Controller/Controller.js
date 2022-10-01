import Question from '../Model/Question.js';

export default class Controller {
  constructor() {
    this.questSet = JSON.parse(localStorage.getItem('quests'));
    if (!this.questSet || this.questSet.length < 1) {
      this.questSet = [new Question()];
      this.currentQuestId = 1;
    } else {
      this.currentQuestId = this.questSet[this.questSet.length - 1].id + 1;
    }
  }

  save() {
    localStorage.setItem('quests', JSON.stringify(this.questSet));
  }

  getQuests() {
    return this.questSet.map(quest => ({...quest}));
  }

  findQuest(id) {
    return this.questSet.findIndex(quest => quest.id === id);
  }

  updateQuest(quest) {
    // const index = this.findQuest(quest.id);
    // Object.assign(this.questSet[index], quest);
    // this.save();
  }

  addQuest(title, type, ansSet) {
    const quest = new Question(
      this.currentQuestId++, title, type, ansSet
    );
    this.questSet.push(quest);
    this.save();
    return {...quest};
  }

  removeQuest(id) {
    const index = this.findQuest(id);
    this.questSet.splice(index, 1);
    this.save();
  }

  updateQuestType(id, questType) {
    const index = this.findQuest(id);
    this.questSet[index].type = questType;
    this.save();
  }

  addAnsSet(questId, answerOpt) {
    const index = this.findQuest(questId);
    this.questSet[index].ansSet = answerOpt;
    this.save();
  }

  setAnsOpt(questId, ansOpt) {
    const index = this.findQuest(questId);
    this.questSet[index].ansSet.push(ansOpt);
    this.save();
  }
}