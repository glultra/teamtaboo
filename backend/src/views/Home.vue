<template>
<!--  <v-parallax src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg">-->
    <v-container class="d-flex justify-center align-center h-screen">
      <v-card class="mt-2 elevation-7 rounded" style="max-width: 600px;">
        <v-row class="d-flex justify-center">
          <v-container>
            <v-row class="d-flex flex-row">
              <v-col class="pa-10">
                <h2 class="font-weight-bold text-center mb-10"> Who's Hosting ?</h2>
                <v-row class="d-flex flex-row">
                  <v-col>
                    <v-text-field
                      :counter="10"
                      label="YOUR NAME"
                      style="width: 300px;"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col class="d-flex justify-center"> <!-- Added d-flex justify-center -->
                    <v-btn class="bg-amber-lighten-1" @click="createNewGame"> Create Game</v-btn>
                  </v-col>
                </v-row>
              </v-col>
              <v-col class="bg-grey-lighten-1 align-center justify-center d-flex" >
                <v-icon icon="$vuetify" size="128"> </v-icon>
              </v-col>
            </v-row>
          </v-container>
        </v-row>
      </v-card>
    </v-container>
<!--  </v-parallax>-->
</template>

<script>
  export default {
    methods:{
      createNewGame(){

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
