<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Nav from '@/components/Navbar.vue'
import Logo from '@/components/icons/IconLogo.vue'
</script>

<template>
  <header>
    <RouterLink to="/" class="logo">
      <Logo />
    </RouterLink>
    <Nav />
  </header>
  <main>
    <RouterView />
  </main>
</template>

<style>
@import '@/styles/base.css';

#app {
  width: 100%;
  height: 100vh;
  overflow-y: scroll;
}
.logo{
  height: 100%;
  margin-left: 10%;
  padding: .5rem;
  z-index: 99;
  color: #223E77;
}

main{
  width: 100%;
  min-height: calc(100vh - 5rem);
  height: auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}
header{
  position: sticky;
  top: 0;
  width: 100%;
  height: 5rem;
  z-index: 99;
  display: flex;
  justify-content: space-between;
  box-shadow: 0 0 1rem #00000050;
  background: var(--white-soft);
}

a{
  text-decoration: none;
  transition: 0.4s;
}

@media (prefers-color-scheme: dark) {
  header{
    /* background: var(--white-soft); */
    color: var(--white-soft);
  }
}
@media (prefers-color-scheme: light) {
  header{
    background: var(--black-soft);
    color: var(--white-soft);
  }
}
</style>
