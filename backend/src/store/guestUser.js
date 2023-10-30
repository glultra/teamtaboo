// src/store/guestUser.js

import {defineStore} from 'pinia';
import axios from "axios";

export const useGuestUserStore = defineStore('guestUser', {
  state: () => ({
    token: localStorage.getItem('guestUserToken') || null,
    loading: false,
  }),
  getters: {
    getUserToken() {
      return this.token;
    }
  },
  actions: {
    async getAuthUser() {
      this.loading = true;
      if (this.token && this.token != null && this.token != 'null') {
        // alert('here')
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
        this.setToken(this.token);
      } else {
        await window.axios.get('/sanctum/csrf-cookie');
        await window.axios
          .post("/api/store-guest-user")
          .then((response) => {
            console.log(response);
            const token = response.data.token;
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
            this.setToken(token);
            console.log(response.data);
          })
          .catch((error2) => {
            console.log("Error Status: ", error2);
          });
      }

      this.loading = false;
    },
    setToken(token) {
      this.token = token;
      localStorage.setItem('guestUserToken', token); // Save to local storage
    },
  },
});
