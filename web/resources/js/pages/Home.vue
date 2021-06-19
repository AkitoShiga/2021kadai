<template>
  <div class="container">
    <h1>Home</h1>
    <div v-if="isLogin">
      <Images />
      <div>
        <span>番号 : </span> {{ userData.id }}
      </div>
      <div>
        <span>名前: </span> {{ userData.name }}
      </div>
      <div>
        <span>メールアドレス : </span> {{ userData.email }}
      </div>
    </div>
    <div v-else>
      ログインして下さい
    </div>
  </div>
</template>

<script>
import Images from '../components/Images.vue'
export default {
  data () {
    return {

     userData: this.$store.getters["auth/userData"],

    }
  },
  components: {
    Images
  },
  computed: {

    isLogin : function() {

      return this.$store.getters["auth/check"];

    },
  },

}
</script>
