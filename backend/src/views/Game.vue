<template>
    <v-snackbar timeout="1700" v-model="snackbar" :color="snackbarColor">
      {{ snackbarMessage }}
      <template v-slot:action="{ attrs }">
        <v-btn color="pink" text v-bind="attplayerInGameStorers" @click="snackbar = false">Close</v-btn>
      </template>
    </v-snackbar>
  <v-row class="d-flex flex-row justify-center h-screen align-center" v-if="gameStore.loading">
    <!-- Display a loading spinner or message here -->
    <v-progress-circular indeterminate color="red"></v-progress-circular>
  </v-row>
  <v-container class="d-flex justify-center align-center h-screen" v-else>
    <v-card class="mt-2 elevation-7 rounded" style="max-width: 600px;">
      <v-row class="d-flex justify-center">
        <v-container>
          <v-row class="d-flex flex-row">
            <v-col class="pa-10">
              <h2 class="font-weight-bold text-center mb-10"><span
                class="bg-green rounded pl-1 pr-1 ">{{ gameStore.game.hosted_by }}</span> is hosting the game. </h2>
              <v-row v-if="gameStore.isJoined" class="d-flex flex-row">
                <v-col cols="12">
                  <v-sheet class="mb-1">Game link</v-sheet>
                  <v-sheet class="border rounded pa-1 bg-grey-lighten-5 cursor">
                    {{ gameUrl }}
                  </v-sheet>
                </v-col>
                <v-col> <!-- Added d-flex justify-center -->
                  <v-btn color="black" @click="copyGameUrl" class="w-100"> Copy link</v-btn>
                </v-col>
                <v-col v-if="isOwner()"> <!-- Added d-flex justify-center -->
                  <v-btn color="green" @click="startGame" class="w-100"> Start game</v-btn>
                </v-col>
              </v-row>
              <v-row v-else class="d-flex flex-row">
                <v-form @submit.prevent="joinTheGame()">
                  <v-col cols="12">
                    <v-text-field
                      :counter="10"
                      label="JOIN AS"
                      required
                      v-model="joined_as"
                      style="width: 300px;"
                    ></v-text-field>
                  </v-col>
                  <v-col>
                    <v-btn color="amber" type="submit" class="w-100"> JOIN GAME</v-btn>
                  </v-col>
                </v-form>
              </v-row>
              <v-row class="d-flex flex-row">
                <v-col>
                  <v-sheet>PLAYERS JOINED SO FAR</v-sheet>
                  <v-list>
                    <v-list-item v-for="playerInGame in JSON.parse(playersInGameStore.playersInGame)">
                      <v-icon icon="mdi-wifi"></v-icon>
                      {{ playerInGame.joined_as }}
                    </v-list-item>
                  </v-list>
                </v-col>
              </v-row>
            </v-col>
            <v-col class="bg-grey-lighten-1 align-center justify-center d-flex">
              <v-icon icon="$vuetify" size="128"></v-icon>
            </v-col>
          </v-row>
        </v-container>
      </v-row>
    </v-card>
  </v-container>

</template>

<script>
import {defineComponent, ref} from 'vue'
import {useGuestUserStore} from "@/store/guestUser";
import {usePlayerInGameStore} from "@/store/playerInGame";
import {usePlayersInGameStore} from "@/store/playersInGame";
import {useRoute} from "vue-router";
import {useGameStore} from "@/store/gameStore";

export default defineComponent({

  setup() {
    const route = useRoute();
    const gameStore = useGameStore();

    const url = route.params.url;
    const joined_as = ref('');
    const gameUrl = ('http://localhost:3000' + route.fullPath);
    const guestUserStore= useGuestUserStore();
    const playerInGameStore = usePlayerInGameStore();
    const playersInGameStore = usePlayersInGameStore();
    const snackbarMessage = ref('');
    const snackbarColor = ref('success');
    const snackbar = ref(false);
    gameStore.fetchGameDetails(url);
    // broadcasted.
    window.Echo.private(`game.${url}`)
      .listen('.joined.game', (event) => {
        gameStore.fetchPlayersInGame(url);
      });



    return {
      guestUserStore,
      gameStore,
      gameUrl,
      snackbarMessage,
      snackbarColor,
      snackbar,
      joined_as,
      playerInGameStore,
      playersInGameStore
    };

  },
  methods: {
    startGame() {

    },
    copyGameUrl() {
      const input = document.createElement('input');
      input.value = this.gameUrl;
      document.body.appendChild(input);

      // Select the input's text and copy it to the clipboard
      input.select();
      document.execCommand('copy');

      // Remove the temporary input element
      document.body.removeChild(input);

      // Optionally, provide user feedback (e.g., with a snackbar) that the URL is copied
      this.showSnackbar('URL copied to clipboard');

    },
    isOwner() {
      if (this.gameStore.game.host_token == this.guestUserStore.token) {
        return true;
      } else {
        return false;
      }
    },
    showSnackbar(message, color = 'success') {
      this.snackbarMessage = message;
      this.snackbarColor = color;
      this.snackbar = true;
    },
    joinTheGame() {
      window.axios.post('/api/join-game', {
        game: this.game,
        name: this.joined_as,
      }).then(response => {
        console.log(response);
        this.gameStore.isJoined = true;
        usePlayerInGameStore().setPlayerInGame(JSON.stringify(response.data.player_in_game));

      }).catch(error => {
        console.log(error);
      });
    },
    reloadPage() {
      // Reload the current page without a full refresh
      window.location.reload();
    }


  }
})
</script>

<style scoped>
.no-wrap {
  white-space: nowrap;
}

</style>
