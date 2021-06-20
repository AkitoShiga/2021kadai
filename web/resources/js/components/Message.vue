<template>
  <div
    class="message"
    v-show="message"
  >{{ message }}
  </div>
</template>

<script>
export default {
  computed: {
    message() {

      return this.$store.getters["auth/check"]? "ログイン♡" : "未ログイン";

    },
  },
}
</script>