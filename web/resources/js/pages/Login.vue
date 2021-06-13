<template>
  <div class="container">

    <ul class="tab">
      <li
        class="tab_item"
        :class="{ 'tab_item--active': tab === 1}"
        @click="tab = 1"
      >Login</li>
      <li
        class="tab_item"
        :class="{ 'tab_item--active': tab === 2}"
        @click="tab = 2"
      >Register</li>
      <li
        class="tab_item"
        :class="{ 'tab_item--active': tab === 3 }"
        @click="tab = 3"
      >Forgot password?</li>
    </ul>

    <section
      class="login"
      v-show="tab === 1"
    >
      <h2>Login</h2>
      <form @submit.prevent="login">
        <div>Email</div>
        <div>
          <input
            type="email"
            v-model="loginForm.email"
          />
        </div>
        <div>Password</div>
        <div>
          <input
            type="password"
            v-model="loginForm.password"
          />
        </div>
        <div>
          <button type="submit">login</button>
        </div>
      </form>
    </section>

    <section
      class="register"
      v-show="tab === 2"
    >
      <h2>Register</h2>
      <form @submit.prevent="register">
        <div>Name</div>
        <div>
          <input
            type="text"
            v-model="registerForm.name"
          />
        </div>
        <div>Email</div>
        <div>
          <input
            type="email"
            v-model="registerForm.email"
          />
        </div>
        <div>Password</div>
        <div>
          <input
            type="password"
            v-model="registerForm.password"
          />
        </div>
        <div>Password confirmation</div> 
        <div>
          <input
            type="password"
            v-model="registerForm.password_confirmation"
          />
        </div> 
        <div>
          <button type="submit">register</button>
        </div>
      </form>
    </section>

    <section
      class="forgot"
      v-show="tab === 3"
    >
      <h2>Forgot</h2>
      <form @submit.prevent="forgot">
        <div>Email</div>
        <div>
          <input
            type="email"
            v-model="forgotForm.email"
          />
        </div>
        <div>
          <button type="submit">send</button>
        </div>
      </form>
    </section>

  </div>
</template>

<script>
export default {
  data() {
    return {
      tab: 1,
      loginForm: {
        email: "",
        password: "",
      },
      registerForm: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      forgotForm: {
        email: "",
      }
    };
  },
  methods: {
    async login() {
      alert("login");
      this.clearForm();
    },
    async register() {
      alert("register");
      this.clearForm();
    },
    async forgot() {
      alert("forgot");
      this.clearForm();
    },
    clearForm() {
      //TODO 冗長なのでうまいやり方考えたい
      this.loginForm.email = "";
      this.loginForm.password = "";
      this.registerForm.name = "";
      this.registerForm.email = "";
      this.registerForm.password = "";
      this.registerForm.password_confirmation = "";
      this.forgotForm.email = "";
    },
  },
};
</script>

<style>
.tab {
  padding: 0;
  display: flex;
  list-style: none;
}
.tab_item {
  border: 1px slid gray;
  padding: 0 0.5rem;
  margin-left: 0.1rem;
  cursor: pointer;
}
.tab_item--active {
  background-color: lightgray;
}
</style>
