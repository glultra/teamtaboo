<template>
  <v-snackbar timeout="1700" v-model="snackbar" :color="snackbarColor">
    {{ snackbarMessage }}
    <template v-slot:action="{ attrs }">
      <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">Close</v-btn>
    </template>
  </v-snackbar>
  <v-container v-if="is404">
    <v-row class="d-flex flex-row justify-center h-screen align-center">
      <v-col cols="12"><h1 class="text-center text-red-accent-2">404 The game url is not exist.</h1></v-col>
    </v-row>
  </v-container>
  <v-row class="d-flex flex-row justify-center h-screen align-center" v-else-if="isLoading">
    <!-- Display a loading spinner or message here -->
    <v-progress-circular indeterminate color="red"></v-progress-circular>
  </v-row>
  <v-container class="d-flex justify-center align-center h-screen" v-if="game && isOkay">
    <v-card class="mt-2 elevation-7 rounded" style="max-width: 600px;">
      <v-row class="d-flex justify-center">
        <v-container>
          <v-row class="d-flex flex-row">
            <v-col class="pa-10">
              <h2 class="font-weight-bold text-center mb-10"><span
                class="bg-green rounded pl-1 pr-1 ">{{ game.hosted_by }}</span> is hosting the game. </h2>
              <v-row class="d-flex flex-row">
                <v-col cols="12">
                  <v-sheet class="mb-1">Game link</v-sheet>
                  <v-sheet class="border rounded pa-1 bg-grey-lighten-5 cursor">
                    {{ gameUrl }}
                  </v-sheet>
                </v-col>
                <v-col > <!-- Added d-flex justify-center -->
                  <v-btn color="black" @click="copyGameUrl" class="w-100"> Copy link</v-btn>
                </v-col>
                <v-col > <!-- Added d-flex justify-center -->
                  <v-btn color="green" @click="startGame" class="w-100"> Start game</v-btn>
                </v-col>
              </v-row>
              <v-row class="d-flex flex-row">
                <v-col>
                  <v-sheet>PLAYERS JOINED SO FAR</v-sheet>
                  <v-list>
                    <v-list-item> <v-icon icon="mdi-wifi"></v-icon> {{ game.hosted_by }}</v-list-item>
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
import {defineComponent} from 'vue'
import api from "@/service";

export default defineComponent({
  data() {
    return {
      url: this.$route.params.url,
      is404: false,
      isOkay: false,
      game: null,
      isLoading: true, // Initialize loading state
      gameUrl: 'http://localhost:3000'+ this.$route.href,
      snackbar: false,
      snackbarMessage: '',
      snackbarColor: '', // Customize the snackbar color as needed (e.g., 'success', 'error', etc.)

    };
  },
  computed() {
    // State Management Logics.

  },
  created() {
    // Get to know smth.
    api.get('is-url-exist/' + this.url).then(response => {
      console.log(response);
      this.game = response.data.game;
      this.isOkay = true;
      this.isLoading = false; // Set loading state to false when data is loaded

    }).catch(err => {
      this.is404 = true;
      this.isOkay = false;
      this.isLoading = false; // Set loading state to false on error

    });
  },
  mounted() {
    // Game detail.

  },
  methods: {
    startGame() {

    },
    copyGameUrl(){
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
    showSnackbar(message, color = 'success') {
      this.snackbarMessage = message;
      this.snackbarColor = color;
      this.snackbar = true;
    },


  }
})
</script>

<style scoped>
.no-wrap {
  white-space: nowrap;
}

</style>
