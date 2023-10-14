<template>
  <v-container v-if="is404">
    <v-row class="d-flex flex-row justify-center h-screen align-center">
      <v-col cols="12"> <h1 class="text-center text-red-accent-2">404 The game url is not exist.</h1> </v-col>
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
              <h2 class="font-weight-bold text-center mb-10 no-wrap"> <span class="bg-green rounded pl-1 pr-1 ">{{ game.hosted_by }}</span> is hosting the game. </h2>
              <v-row class="d-flex flex-row">
                <v-col>
                  Blanked
                </v-col>
              </v-row>
              <v-row>
                <v-col class="d-flex justify-center"> <!-- Added d-flex justify-center -->
                  <v-btn color="black" @click="startGame"> Start game</v-btn>
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
import { defineComponent } from 'vue'
import api from "@/service";

export default defineComponent({
  data(){
    return{
      url: this.$route.params.url,
      is404: false,
      isOkay: false,
      game: null,
      isLoading: true, // Initialize loading state

    };
  },
  computed(){
    // State Management Logics.

  },
  created(){
    // Get to know smth.
    api.get('is-url-exist/'+this.url).then(response  => {
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
  mounted(){
    // Game detail.

  },
  methods:{
    startGame(){

    }
  }
})
</script>

<style scoped>
.no-wrap {
  white-space: nowrap;
}

</style>
