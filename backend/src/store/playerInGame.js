// src/store/guestUser.js

import { defineStore } from 'pinia';

export const usePlayerInGameStore = defineStore('playerInGame', {
  state: () => ({
    playerInGame: null,
  }),
  actions: {
    setPlayerInGame(playerInGame) {
      localStorage.setItem('playerInGame', playerInGame);
    },
  },
});
