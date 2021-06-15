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
  methods: {
    async logout(){

      await this.$store.dispatch("auth/logout");

      if(this.apiStatus) {

        this.$router.push("/login");

      }
    }
  },
  computed: {
    isLogin : function() {

      return this.$store.getters["auth/check"];

    },
  },
  watch :{
    isLogin: function() {

    }
  }
};
</script>
