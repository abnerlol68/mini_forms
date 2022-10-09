import ProtoAns from './Base/ProtoAnswer.js';

export default class Answer {
  constructor() {
    this.ansSet = [];
    if (!this.ansSet || this.ansSet.length < 1) {
      this.ansSet.push(new ProtoAns());
      this.curAnsId = 1;
    } else {
      this.curAnsId = this.ansSet[this.ansSet.length - 1].id + 1;
    }
  }

  getAnsSet() {
    return [...this.ansSet];
  }

  getAnsIndex(id) {
    return this.ansSet.findIndex(ans => ans.id === id);
  }

  getAns(id) {
    return this.ansSet.find(ans => ans.id === id);
  }

  addAns(desc) {
    const answer = new ProtoAns(this.curAnsId++, desc);
    this.ansSet.push(answer);
    return answer;
  }

  removeAns(id) {
    const ansIndex = this.getAnsIndex(id);
    this.ansSet.slice(ansIndex, 1);
  }

  updateAns(id, answer) {
    const ansIndex = this.getAnsIndex(id);
    this.ansSet[ansIndex] = answer;
  }
}
