<template>
  <v-container class="d-flex flex-row align-center h-screen justify-center">
    <v-list>
      <v-list-item v-for="game in games">
        <v-form>
          <v-row class="d-flex flex-row">
            <v-col>
              <v-text-field v-model="game.hosted_by" style="width: 500px"></v-text-field>
            </v-col>
            <v-col>
              <v-btn @click="save(game.id, game.hosted_by)">Save</v-btn>
            </v-col>
          </v-row>
        </v-form>

      </v-list-item>
    </v-list>

  </v-container>
</template>

<script>
import axios from "axios";
import api from "@/service";

export default {
  data() {
    return {
      count: 0,
      games: null,
    };
  },
  mounted() {
    api.get('/games').then(response => {
      this.games = response.data.games;
    });
  },
  methods: {
    increment() {
      this.count += 1;
    },
    goToDashboard() {
      this.$router.push({name: 'Dashboard'});
    },

    save(id, hosted_by) {
      api.put('/update-game', {
        id: id,
        hosted_by: hosted_by
      }).then(response => {
        console.log(response.data);
      }).catch(error => {

      });
    }
  }
};
</script>

