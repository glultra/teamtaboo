<template>
  <v-btn @click="test()">Click me</v-btn>
  <router-view>
  </router-view>
</template>

<script>
import axios from "axios";
import {useGuestUserStore} from "@/store/guestUser";

export default {
  data() {
    return {
      userIsAuthenticated: false,
      userName: '',
    };
  },
  async mounted() {
    // Enable pusher logging - don't include this in production
    // Add broadcaster here ...
    // window.Echo.private(`game`)
    //   .listen('.event-name', (event) => {
    //     console.log(event);
    //   });

    const guestUserStore = useGuestUserStore();
    // Make an API call to check the user's status

    await window.axios.get('/sanctum/csrf-cookie').then(async (resp2)=> {
      await window.axios
        .post("/api/store-guest-user", {token: guestUserStore.token})
        .then((response) => {
          const token =response.data.token;
          // After token retrieval or creation
          // When making API requests
          const guestUserToken = guestUserStore.token;
          window.axios.defaults.headers.common['Authorization'] = `Bearer ${guestUserToken}`;
          axios.defaults.headers.common['Authorization'] = `Bearer ${guestUserToken}`;

          guestUserStore.setToken(token);
          console.log(response.data);
        })
        .catch((error2) => {
          console.log("Error Status: ", error2);
        });
    });

  },
  methods:{
    test(){
      window.axios.get('/api/user').then(resp => {
        console.log(resp.data);
      });
    }
  }

}
</script>
