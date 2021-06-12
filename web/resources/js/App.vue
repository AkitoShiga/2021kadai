<template>
<div>
  <Header/>
  <main>
    <div class="container">
      <RouterView/>
    </div>
    <div class="container">
    </div>
  </main>
</div>
</template>

<script>
import Header from "./components/Header.vue";

export default {
  components: {
    Header
  }
};
</script>
