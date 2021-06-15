<template>
<div>
  <Header/>
  <main>
    <div class="container">
      <!--<Message/>-->
      <RouterView/>
    </div>
    <div class="container">
    </div>
  </main>
</div>
</template>

<script>
import Header from "./components/Header.vue";
import Message from "./components/Message.vue";
import Cookies from "js-cookie";
import {
  NOT_FOUND,
  UNAUTHORIZED,
  INTERNAL_SERVER_ERROR
} from './const';

export default {
  components: {
    Header,
    Message,
  },
  computed: {
    errorCode() {
      return this.$store.state.error.code;
    }
  },
  watch: {
    errorCode: {
      async handler(val) {
        if(val === INTERNAL_SERVER_ERROR) {
          this.$router.push("/500");
        } else if (val === UNAUTHORIZED) {
          await axios.get("/api/refresh-token");
          this.$store.commit("auth/setUser", null);
          this.$router.push("/login");
        } else if (val === NOT_FOUND) {
          this.$router.push("/not-found");
        }
      },
      immediate: true
    },
    $route() {
      this.$store.commit("error/setCode", null);
    }
  },
  created() {

    const message = Cookies.get("MESSAGE");

    if(message) {

      Cookies.remove("MESSAGE");
      this.$store.commit("message/setContent", {
        content: message,
        timeout: 6000

      });
    }
  }
};
</script>
