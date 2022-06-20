<script>
export default {
  data(){
    return{
      bonjour: null
    }
  },
  methods: {
    test: async function(){
      await fetch("/api/verif")
      .then(async (response) => {
        if (response.status === 200) {
          //   console.log(response)
          const data = await response.json();
          this.bonjour = data.userLoggedIn;
          
        }
      })
      .catch((error) => {
        console.error("Invalid user:", error);
      });
    }
  }
}
</script>

<template>
  <main>
    <p>{{bonjour}}</p>
    <button @click="test">Test</button>
  </main>
</template>

<style scoped>
@import '@/styles/base.css';


</style>
