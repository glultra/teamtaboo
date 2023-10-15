// src/store/guestUser.js

import { defineStore } from 'pinia';

export const usePlayerInGameStore = defineStore('playerInGame', {
  state: () => ({
    playerInGame: localStorage.getItem('playerInGame') || null,
  }),
  actions: {
    setPlayerInGame(playerInGame) {
      this.playerInGame = playerInGame;
      localStorage.setItem('playerInGame', playerInGame);
    },
  },
});
