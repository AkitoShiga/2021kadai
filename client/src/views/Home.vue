<template>
  <div class="home">
    <h3> ユーザー {{ $store.state.userId }}</h3>
    <p> {{ message }}</p>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import axios, { AxiosResponse } from 'axios';


@Component 
export default class Home extends Vue {
  message: string = "";
  created() {
    this.fetchHello();
  }
  fetchHello(): void {
    const uri: string = "http://localhost:8080/hello";
    axios
      .get(uri)
      .then(
        response => {
          this.message = response.data.message;
        } 
      );
  }

}
</script>
