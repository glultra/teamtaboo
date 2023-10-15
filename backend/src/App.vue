<template>
  <router-view>
  </router-view>
</template>

<script>
import api from "@/service";
import axios from "axios";
import {useGuestUserStore} from "@/store/guestUser";

export default {
  data() {
    return {
      userIsAuthenticated: false,
      userName: '',
    };
  },
  mounted() {
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


}
</script>
