export default class Question {
  constructor() {
    this.url = document.getElementById('url').innerText;
    this.questSet = this.requestQuests();
  }

  /* CRUD Question */

  async requestQuests() {
    return fetch(`${this.url}request/?req=get_quests`)
      .then(quests => quests.json());
  }

  async getQuestSet() { return [... await this.questSet] }

  async getQuestIndex(id) {
    return (await this.questSet)
      .findIndex(quest => quest.id_question === id);
  }

  async getQuest(id) {
    return (await this.questSet)
      .find(quest => quest.id_question === id);
  }

  // Soon the id will not be passed since from the DB it is auto-increment
  async addQuest(id, title, type, idForm) {
    return fetch(`${this.url}request/?req=add_quest`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id, title, type, idForm })
    }).then(quest => quest.text());
  }

  removeQuest(id, idForm) {
    fetch(`${this.url}request/?req=remove_quest`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id, idForm })
    });
  }

  updateQuest(id, idForm, title, type) {
    fetch(`${this.url}request/?req=update_quest`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id, idForm, title, type })
    });
  }

  // /* CRUD Options */

  async getOptSet(questId) {
    return fetch(`${this.url}request/?req=get_options&quest=${questId}`)
      .then(quests => quests.json());
  }

  async getOptIndex(questId, optId) {
    return [...await this.getOptSet(questId)]
      .findIndex(opt => opt.id_option === optId);
  }

  async getOpt(questId, optId) {
    return [...await this.getOptSet(questId)]
      .find(opt => opt.id_option === optId);
  }

  async addAns(desc, questId) {
    return fetch(`${this.url}request/?req=add_option`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ desc, questId })
    }).then(opt => opt.json());
  }

  removeOpt(questId, optId) {
    fetch(`${this.url}request/?req=remove_option`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ questId, optId })
    });
  }

  updateOpt(optId, desc, questId) {
    fetch(`${this.url}request/?req=update_option`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ optId, desc, questId })
    });
  }
}
