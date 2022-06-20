<script>
export default {
  props: ['name'],
  data(){
    return{
      username: this.name,
      pp: null,
      vehicle: null,
    }
  },
  beforeCreate: async function(){
    const headers = new Headers({
      "Content-Type": "application/json",
      Accept: "application/json",
    });
    let myData = {
      method: "POST",
      headers: headers,
      mode: "cors",
      cache: "default",
      body: JSON.stringify({name: this.name}),
    };
    await fetch("/profile", myData)
      .then(async (response) => {
        if (response.status === 200) {
          //   console.log(response)
          const data = await response.json();
          this.pp = data.user.pp;
          this.vehicle = data.user.vehicle;
        }
      })
      .catch((error) => {
        console.error("Invalid user:", error);
      });
    
  }
}
</script>

<template>
  <section>
    <aside>
      <div class="profile">
        <div class="banner">

        </div>
        <div class="pp">
          <img :src="pp" alt="">
          <h1>{{name}}</h1>
          <p>{{vehicle}}</p>
        </div>
      </div>
      <div class="friends">
        
      </div>
    </aside>
    <div class="posts">
      <div class="post"></div>
      <div class="post"></div>
    </div>
    <aside>
      <div class="pubs">

      </div>
    </aside>
  </section>
</template>

<style scoped>
@import '@/styles/base.css';

section{
  width: 80%;
  height: auto;
  display: flex;
}
aside{
  position: sticky;
  top: 7rem;
  width: 25%;
  height: 100%;
}
div:not(.posts){
  box-shadow: 0 0 1rem #00000050;
  background: #FFF;
  margin-bottom: 2rem;
}
aside .profile{
  width: 100%;
  height: 40rem;
  /* background: rgb(34,62,119);
  background: linear-gradient(312deg, rgba(34,62,119,1) 0%, rgba(70,109,189,1) 100%);  */
}
.profile > div{
  position: relative;
  margin: 0;
  box-shadow: none;
}
.pp{
  text-align: center;
}
.pp img{
  position: relative;
  top: 0;
  left: 0;
  transform: translateY(-50%);
  width: 12rem;
  height: 12rem;
  border-radius: 50%;
}
.profile .banner{
  width: 100%;
  height: 30%;
  background: rgb(34,62,119);
  background: linear-gradient(312deg, rgba(34,62,119,1) 0%, rgba(70,109,189,1) 100%); 
}
aside .friends{
  width: 100%;
  height: 40rem;
}

.posts{
  width: 50%;
  height: 120vh;
  padding: 2rem;
}
.post{
  width: 100%;
  height: 60rem;
  /* background: rgba(15, 46, 108, 0.9178046218); */
}

.pubs{
  width: 100%;
  height: 80rem;
}
h1{
  text-transform: uppercase ;
}
</style>
