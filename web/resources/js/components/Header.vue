<template>
  <header>
    <RouterLink to="/">Home</RouterLink>
    <RouterLink to="/login">Login</RouterLink>
    <span @click="logout">Logout</span>
  </header>
</template>
<script>
export default {
  methods: {
    async logout(){
      alert("logout");
      this.$router.push("/login");
    }
  }
};
</script>
