<template>
<!--  <v-btn @click="test()">Click me</v-btn>-->
  <router-view>
  </router-view>
</template>

<script>
import axios from "axios";
import {useGuestUserStore} from "@/store/guestUser";
import {ref} from "vue";

export default {

  setup() {
    // Enable pusher logging - don't include this in production
    // Add broadcaster here ...
    // window.Echo.private(`game`)
    //   .listen('.event-name', (event) => {
    //     console.log(event);
    //   });

    const userIsAuthenticated =  ref(false);
    const userName = ref('');
    const guestUserStore = useGuestUserStore();
    guestUserStore.getAuthUser();
    // Make an API call to check the user's status


    return {
      userIsAuthenticated,
      userName,
      guestUserStore,
    };
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
