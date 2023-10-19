<template>
  <v-btn @click="test()">Click me</v-btn>
  <router-view>
  </router-view>
</template>

<script>
import api from "@/service";
import axios from "axios";
import {useGuestUserStore} from "@/store/guestUser";
import pusher from "@/channels/pusher";
import subscribeToChannel from "@/channels/subscribeToChannel";

export default {
  data() {
    return {
      userIsAuthenticated: false,
      userName: '',
    };
  },
  mounted() {
    // Enable pusher logging - don't include this in production
    // Add broadcaster here ...
    Pusher.logToConsole = true;
    const myChannel = subscribeToChannel('my-channel', 'my-event', (data) => {
      console.log('Custom event received:', data);
      // Handle the custom event data here
    });


    const guestUserStore = useGuestUserStore();
    // Make an API call to check the user's status
    api
      .post("/store-guest-user", {token: guestUserStore.token})
      .then((response) => {
        const token =response.data.token;
        // After token retrieval or creation
        // When making API requests
        const guestUserToken = guestUserStore.token;
        axios.defaults.headers.common['Authorization'] = `Bearer ${guestUserToken}`;

        guestUserStore.setToken(token);
        console.log(response.data);
      })
      .catch((error2) => {
        console.log("Error Status: ", error2);
      });
  },
  methods:{
    test(){
      api.get('/test').then(resp => {
        console.log(resp.data);
      });
    }
  }

}
</script>
