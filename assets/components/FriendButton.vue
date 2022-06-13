<script>
export default {
    data() {
    return {
      id: '1',
    };
  },
  methods: {
    submit : async function() {
      let form = {
        user_id: this.id,
      };
      const headers = new Headers({
        "Content-Type": "application/json",
        Accept: "application/json",
      });
      let _data = {
        method: "POST",
        headers: headers,
        mode: "cors",
        cache: "default",
        body: JSON.stringify(form),
      };
      await fetch("/api/register", _data)
        .then(async (response) => {
          if (response.status === 200) {
            //   console.log(response)
            const data = await response.json();
            console.log(data)
            const registered = data.userCreated;
          }
        })
        .catch((error) => {
          console.error("Invalid user:", error);
        });
    },
  },
}
</script>
<template>
    
</template>
<style scoped>

</style>