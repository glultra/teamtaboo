// src/store/guestUser.js

import { defineStore } from 'pinia';

export const usePlayersInGameStore = defineStore('playersInGame', {
  state: () => ({
    playersInGame: localStorage.getItem('playersInGame') || null,
  }),
  actions: {
    setPlayersInGame(playersInGame) {
      this.playersInGame = playersInGame;
      localStorage.setItem('playersInGame', playersInGame);
    },
  },
});
