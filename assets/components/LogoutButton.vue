<script setup>
    import LogoutIcon from '@/components/icons/IconLogout.vue'
</script>
<script>
export default {
    methods: {
        async logout(){
            console.log('pressed')
            await fetch("/logout")
            .then(async (response) => {
                if (response.status === 200) {
                    //   console.log(response)
                    const data = await response.json();
                    console.log(data)
                    if(data.token == null){
                        this.$router.push({ path: '/' })
                    }
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
    <button @click="logout">
        <LogoutIcon/>
    </button>
</template>

<style scoped>
@import '@/styles/base.css';

button{
    width: auto;
    padding: .5rem;
    padding-left: 1rem;
    cursor: pointer;
    background: #FF0040;
    border: none;
    outline: none;
    color: var(--white-soft);
}
</style>