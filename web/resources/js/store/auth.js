//TODO 冗長な部分を共通関数にするのと、読みにくい所を修正する

//import axios from "axios";
import {
  OK,
  CREATED,
  UNPROCESSABLE_ENTITY,
  TOO_MANY_REQUESTS
} from "../const";

const state = {
  user: null,
  apiStatus: null,
  loginErrorMessages: null,
  registerErrorMessages: null,
  forgotErrorMessages: null,
}

const getters = {
  check: state => !!state.user,
  username: state => (state.user ? state.user.name : ""),
  userData: state => state.user,
}

const mutations = {
  setUser(state, user) {
    state.user = user
  },
  setApiStatus(state, status) {
    state.apiStatus = status;
  },
  setLoginErrorMessages(state, messages) {
    state.loginErrorMessages = messages;
  },
  setRegisterErrorMessages(state, messages) {
    state.registerErrorMessages = messages;
  },
  setForgotErrorMessages(state, messages) {
    state.setForgotErrorMessages = messages;
  },
}

const actions = {

  async login(context, data) {

    context.commit("setApiStatus", null)
    const response = await axios.post("/api/login", data)

    if (response.status === OK) {

      context.commit("setApiStatus", true);
      context.commit("setUser", response.data);
      return false;

    }

    context.commit("setApiStatus", false);

    if (response.status === UNPROCESSABLE_ENTITY ||
        response.status === TOO_MANY_REQUESTS) {

      context.commit("setLoginErrorMessages", response.data.errors);

    } else {

      context.commit("error/setCode", response.status, { root: true });

    }
  },
  async register(context, data) {

    context.commit("setApiStatus", null);
    const response = await axios.post("/api/register", data);

    if(response.status === CREATED) {

      context.commit("setApiStatus", true);
      context.commit("setUser", response.data);
      return false;

    }

    context.commit("setApiStatus", false);

    if(response.status === UNPROCESSABLE_ENTITY) {

      context.commit("setRegisterErrorMessages", response.data.errors);

    } else {

      context.commit("error/setCode", response.status, { root: true });

    }
  },
  async logout(context) {

    context.commit("setApiStatus", null);
    const response =  await axios.post("/api/logout");

    if(response.status === OK) {

      context.commit("setApiStatus", true);
      context.commit("setUser", null);
      return false;

    }

    context.commit("setApiStatus", false);

    context.commit("error/setCode", response.status, { root: true });
  },
  async currentUser(context) {

    context.commit("setApiStatus", null);
    const response = await axios.get("/api/user");

    const user = response.data || null;

    if(response.status === OK) {
      context.commit("setApiStatus", true);
      context.commit("setUser", user);
      return false;
    }

    context.commit("setApiStatus", false);

    context.commit("error/setCode", response.status, { root: true });

  },
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}
