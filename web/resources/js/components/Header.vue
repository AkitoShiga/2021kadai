<template>
  <header>
    <RouterLink to="/">Home</RouterLink>
    <RouterLink
      v-if="!isLogin"
      to="/login"
    >Login</RouterLink>
    <span
      v-if="isLogin"
      @click="logout"
    >Logout</span>
  </header>
</template>
<script>
export default {
  //data() { return { isLogin: false, } },
  methods: {
    async logout(){

      await this.$store.dispatch("auth/logout");

      if(this.apiStatus) {

        this.$router.push("/login");

      }
    }
  },
  watch: {
    isLogin: function() {
      //this.isLogin  =
      return this.$store.auth.getters.check
    },
    immideate: true
  },
};
</script>
