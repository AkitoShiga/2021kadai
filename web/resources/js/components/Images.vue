<template>
<div>
  <p v-if="true">
    <img class="image" :src="'/Images/noImage.gif'" />
  <p v-else>
    <img class="image" :src="defaultImage" />
  </p>
  <p>{{ message }}</p>
  <p>
    <button @click="uploadImage">アップロード</button>
  </p>
  <table border="1">
    <tr>
      <th>プロフィール画像</th>
    </tr>
    <tr v-for="image in images" :key="image.id">
      <td>{{ image.title }}</td>
      <td><img class="image" :src="`${image.path}`" /></td>
    </tr>
  </table>
</div>
</template>

<script>
export default {
  data(){
    return {
      message: "",
      file: "",
      view: true,
      images: {},
      confirmedImage: "",
    };
  },
  created: function() {
    this.getImage();
  },
  computed: {
  },
  methods: {
    getImage() {
      axios
        .get("api/images")
        .then(response => {
          this.images = response.data;
          this.test = response.data;
        })
        .catch(error => {
          this.message = error;
        })
    },
    confirmImage(e) {
      this.message ="";
      this.file = e.target.files[0];
      if(!this.file.type.match("image.*")) {
        this.message = "画像ファイルを選択して下さい";
        this.confirmedImage = "";
        return;
      }
      this.createImage(this.file);
    },
    createImage(file) {
      let reader = new FileReader();
      data.append("file", this.file);
      data.append("title", this.title);
      axios
        .post("/api/images/", data)
        .then(response => {
          this.getImage();
          this.message = response.data.success;
          this.confimedImage = "";
          this.title = "";
          this.file = "";

          this.view =false;
          this.$nextTick(function() {
            this.view =true;
          });
        })
        .catch(error => {
          this.message = error.response.data.errors;
        })
    }
  }
}
</script>
<style>
.img {
  width: 100px;
}
</style>