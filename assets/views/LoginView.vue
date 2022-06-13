<script>
export default {
  data() {
    return {
      email: null,
      password: null,
    };
  },
  methods: {
    submit : async function() {
      let form = {
        email: this.email,
        password: this.password,
      };
      const headers = new Headers({
        "Content-Type": "application/json",
        Accept: "application/json",
      });
      let myData = {
        method: "POST",
        headers: headers,
        mode: "cors",
        cache: "default",
        body: JSON.stringify(form),
      };
      await fetch("/api/login", myData)
        .then(async (response) => {
          if (response.status === 200) {
            //   console.log(response)
            const data = await response.json();
            console.log(data)
            const loggedIn = data.userLoggedIn;
            if (loggedIn === true){
              this.$router.push({ path: '/' })
            }
          }
        })
        .catch((error) => {
          console.error("Invalid user:", error);
        });
    },
  },
};
</script>
<template>
    <form @submit.prevent="submit">
      <input id="email" v-model="email" type="email" required />
      <input id="password" v-model="password" type="password" required />

      <button type="submit">Se connecter</button>
    </form>
</template>
<style scoped>

</style>