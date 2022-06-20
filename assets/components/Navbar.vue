<script setup>
import LoginIcon from '@/components/icons/IconLogin.vue'
import LogoutBtn from '@/components/LogoutButton.vue'
</script>

<script>
export default {
  data(){
    return{
      loggedIn: null
    }
  },
  beforeCreate: async function(){
      await fetch("/api/verif")
      .then(async (response) => {
        if (response.status === 200) {
          //   console.log(response)
          const data = await response.json();
          this.loggedIn = data.userLoggedIn;
        }
      })
      .catch((error) => {
        console.error("Invalid user:", error);
      });
  }
}
</script>

<template>
    <nav>
      <RouterLink to="/">Home</RouterLink>
      <RouterLink to="/user/jchr" v-if="loggedIn == true">Profil</RouterLink>
      <RouterLink to="/settings" v-if="loggedIn == true">Settings</RouterLink>
      <RouterLink to="/login" class="login" v-if="loggedIn == false">
        <LoginIcon/>
      </RouterLink>
      <LogoutBtn v-if="loggedIn == true"/>
    </nav>
</template>

<style scoped>
@import '@/styles/base.css';

nav {
  width: 20%;
  height: 5rem;
  margin-right: 10%;
  font-size: 1.6rem;
  display: flex;
  justify-content: center;
}

nav a.router-link-exact-active {
  color: #FF0040;
}

nav a:not(.login){
  min-width: 8.5rem;
  width: calc(100% / 3);
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
  fill: currentColor;
  color: rgba(15, 46, 108, 0.9178046218);
}

nav a:first-of-type {
  border: 0;
}

.login{
  width: auto;
  padding: 1rem;
  padding-left: 0.5rem;
  background: #FF0040;
  color: var(--white-soft);
}

@media (hover: hover) {
  a:hover {
    letter-spacing: 1px;
  }
}
</style>