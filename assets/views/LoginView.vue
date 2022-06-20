<script setup>
import ProfileIcon from '@/components/icons/IconProfile.vue'
import LoginNav from '@/components/LoginNav.vue'
</script>

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
      console.log(myData)
      await fetch("/api/login", myData)
        .then(async (response) => {
          if (response.status === 200) {
            //   console.log(response)
            const data = await response.json();
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
  <div class="container">
    <form @submit.prevent="submit">
      <LoginNav/>
      <div class="wrapper">
        <div class="icon">
          <ProfileIcon />
        </div>
        <h1>Déjà un compte ?</h1>

        <input id="email" placeholder="Email" v-model="email" type="email" required />
        <input id="password" placeholder="Mot de passe" v-model="password" type="password" required />

        <button type="submit">Connexion</button>
      </div>
    </form>
  </div>
</template>

<style scoped>
@import '@/styles/base.css';

.container{
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
}

form{
  min-width: 40rem;
  display: flex;
  flex-direction: column;
}
.wrapper{
  width: 100%;
  padding: 4rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.icon{
  padding: 1.5rem;
  /* border-radius: 50%; */
  display: flex;
  justify-content: center;
  align-items: center;
}
h1{
  padding-block: 1.5rem 2rem;
  font-weight: 500;
}
input, button{
  width: 95%;
  min-height: 3rem;
  margin: 1rem;
  padding: 1rem;
  border: none;
  outline: none;
}
button{
  /* min-width: 10rem; */
  cursor: pointer;
}


@media (prefers-color-scheme: dark) {
  .wrapper{
    background: #EEE;
  }
  .icon{
    background: #FFF;
  }
  input{
    background: #FFF;
  }
  button{
    color: var(--white-soft);
    background: #ff0040;
  }
}
@media (prefers-color-scheme: light) {
  .wrapper{
    background: var(--black-soft);
  }
  .icon{
    background: #FFF;
  }
  input{
    background: #FFF;
  }
  button{
    color: var(--white-soft);
    background: #ff0040;
  }
}
</style>