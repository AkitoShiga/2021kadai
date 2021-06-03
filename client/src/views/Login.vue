<template>

  <form @submit.prevent="doLogin"> 

    <p>
      {{ errorMessage }}
    </p>
    
    <label>ID</label>
    <input
      type="text"
      placeholder="IDを入力して下さい"
      v-model="loginInfo.id"
    />

    <label>Password</label>
    <input
      type="password"
      placeholder="パスワードを入力して下さい"
      v-model="loginInfo.password"
    />

    <button type="submit">ログイン</button>

  </form>

</template>

<script lang="ts">

import { Component, Vue } from 'vue-property-decorator'
import  UserUtils  from '@/services/UserUtils'
import {UserToken} from '@/types/UserToken'
import {LoginInfo} from '@/types/LoginInfo'

@Component
export default class Login extends Vue {

  isAuthenticated: boolean = false;
  errorMessage: string = "";
  userToken: UserToken = {
    token: "",
    refreshToken: "",
  }
  formInfo: LoginInfo = {
    id: "",
    password: "",
  }

  doLogin(): void {

    const userUtils = new UserUtils();
    this.userToken  = userUtils.login(this.formInfo)
                               .then((resolve) => {})
                               .catch((reject) => {});
    
    //認証が成功したら
    if(this.userToken.token !== "") {
      this.isAuthenticated = true;
    }

    if(this.isAuthenticated) {
      this.$store.dispatch(
          "auth",
          this.userToken
        );
        this.$router.push({name: 'Home'});

      } else {
        this.errorMessage = "IDもしくはパスワードに誤りがあります。" 
      }

  }
}

</script>

