// Utilities
import {defineStore} from 'pinia'
import {usePlayerInGameStore} from "@/store/playerInGame";
import {usePlayersInGameStore} from "@/store/playersInGame";

export const useGameStore = defineStore('gameStore', {
  state: () => ({
    game_code: '',
    joined_as: '',
    loading: false,
    isJoined: false,
    game: localStorage.getItem('game') || null,
  }),
  getters: {},
  actions: {
    async fetchGameDetails(game_code) {
      this.loading = true;
      this.game_code = game_code;
      await window.axios.get('/sanctum/csrf-cookie');
      await window.axios.get('/api/player-in-game-status/'+game_code).then(response => {
        console.log(response);
        this.player_in_game = response.data.player_in_game;
        this.players_in_game = response.data.players_in_game;
        usePlayerInGameStore().setPlayerInGame(JSON.stringify(this.player_in_game));
        usePlayersInGameStore().setPlayersInGame(JSON.stringify(this.players_in_game));
        this.isJoined = response.data.status;
        this.game = response.data.game;
        localStorage.setItem('game', JSON.stringify(this.game));
        // this.isLoading = false; // Set loading state to false when data is loaded

      }).catch(error => {
        console.log(error);
        // this.loading = false; // Set loading state to false on error
      });
      this.loading = false;
    },
    async fetchPlayersInGame(game_code) {
      this.game_code = game_code;
      await window.axios.get('/sanctum/csrf-cookie');
      await window.axios.get('/api/player-in-game-status/'+game_code).then(response => {
        console.log(response);
        this.player_in_game = response.data.player_in_game;
        this.players_in_game = response.data.players_in_game;
        usePlayerInGameStore().setPlayerInGame(JSON.stringify(this.player_in_game));
        usePlayersInGameStore().setPlayersInGame(JSON.stringify(this.players_in_game));
        this.isJoined = response.data.status;

      }).catch(error => {
        console.log(error);
      });
    },
  },
})
