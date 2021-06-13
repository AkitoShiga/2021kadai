<template>
  <div
    class="message"
    v-show="message"
  >{{ message }}</div>
</template>

<script>
export default {
  computed: {
    message() {
      return this.$store.state.message.content;
    },
  },
}
</script>