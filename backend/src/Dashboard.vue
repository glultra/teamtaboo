<template>
  Welcome to dashboard
  <v-btn @click="$router.push({name: 'Page'})">Wanna back ?</v-btn>
</template>

<script>
import {defineComponent} from 'vue'

export default defineComponent({
  name: "Dashboard"
})
</script>

<style scoped>

</style>
