//import user from '@/types/user'
import { RawLocation } from 'vue-router';
import { LoginInfo } from '@/types/LoginInfo';
import { UserToken } from '@/types/UserToken';
import { createAxiosInstance } from '@/services/api';

export default class UserUtils {
  
  userToken: UserToken = {
    token: "",
    refreshToken: "",
  }

  async login(loginInfo: LoginInfo):UserToken {

    //axiosでログイン情報を問い合せて真偽値を返す。
    this.userToken = this.userToken;
    return this.userToken;

  }

}
