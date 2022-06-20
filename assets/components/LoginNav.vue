<template>
    <div class="links">
        <RouterLink to="/login">Se connecter</RouterLink>
        <RouterLink to="/register">S'inscrire</RouterLink>
    </div>
</template>

<style scoped>
div{
    width: 100%;
    height: 5rem;
    display: flex;
    justify-content: space-between;
    margin-bottom: .1rem;
}
a{
    width: calc((100% - 1px) / 2);
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.6rem;
}

@media (prefers-color-scheme: dark) {
  .links a{
    color: var(--black-soft);
    background: #EEE;
  }
  a.router-link-exact-active{
    color: var(--white-soft);
    background: rgba(15, 46, 108, 0.9178046218);
  }
}
@media (prefers-color-scheme: light) {
  .links a{
    background: var(--black-soft);
  }
  a.router-link-exact-active{
    color: var(--white-soft);
    background: rgba(15, 46, 108, 0.9178046218);
  }
}
</style>