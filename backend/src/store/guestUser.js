// src/store/guestUser.js

import { defineStore } from 'pinia';

export const useGuestUserStore = defineStore('guestUser', {
  state: () => ({
    token: localStorage.getItem('guestUserToken') || null,
  }),
  actions: {
    setToken(token) {
      this.token = token;
      localStorage.setItem('guestUserToken', token); // Save to local storage
    },
  },
});
