<template>
  <!--  <v-parallax src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg">-->
  <v-row class="d-flex flex-row justify-center h-screen align-center" v-if="guestUserStore.loading">
    <!-- Display a loading spinner or message here -->
    <v-progress-circular indeterminate color="red"></v-progress-circular>
  </v-row>
  <v-container class="d-flex justify-center align-center h-screen" v-else>
    <v-card class="mt-2 elevation-7 rounded" style="max-width: 600px;">
      <v-row class="d-flex justify-center">
        <v-container>
          <v-row class="d-flex flex-row">
            <v-col class="pa-10">
              <h2 class="font-weight-bold text-center mb-10"> Who's Hosting ?</h2>
              <v-form  @submit.prevent="createNewGame">
                <v-row class="d-flex flex-row">
                  <v-col>
                    <v-text-field
                      :counter="10"
                      label="YOUR NAME"
                      required
                      v-model="username"
                      style="width: 300px;"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col class="d-flex justify-center"> <!-- Added d-flex justify-center -->
                    <v-btn color="black" type="submit"> Create Game</v-btn>
                  </v-col>
                </v-row>
              </v-form>

            </v-col>
            <v-col class="bg-teal-accent-4 align-center justify-center d-flex">
              <v-icon icon="$vuetify"  size="128"></v-icon>
            </v-col>
          </v-row>
        </v-container>
      </v-row>
    </v-card>
  </v-container>
  <!--  </v-parallax>-->
</template>

<script>
import router from "@/router";
import {useGuestUserStore} from "@/store/guestUser";
import {usePlayerInGameStore} from "@/store/playerInGame";
import {ref} from "vue";

export default {

  setup(){
    const guestUserStore = useGuestUserStore();
    const username = ref('Guest');
    const message = ref('Failed');

    return {
      username,
      message,
      guestUserStore
    }
  },
  methods: {
    createNewGame() {

      window.axios.post('/api/create-new-game', {
        username: this.username,
        token: useGuestUserStore().token,
      }).then(response => {
        const gameUrl = response.data.url;
        usePlayerInGameStore().setPlayerInGame(JSON.stringify(response.data.player_in_game));
        // Redirect to new game URL.
        router.push({
          name: 'Game',
          params: {url: gameUrl},
        });
      }).catch(err => {
        console.log(err);
      });
    }
  }
}
</script>

<style>
.no-wrap {
  white-space: nowrap;
}

.custom-label {
  font-size: 14px; /* Adjust the font size as needed */
}
</style>
