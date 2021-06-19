<template>
<div>
  <p v-if="hasImage">
    <img class="image" :src="imagePath" />
  <p>{{ imagePath }}</p>
  <p>{{ message }}</p>
  <input type="file" @change="confirmImage" v-if="view"/>
  <p>
    <button @click="uploadImage">アップロード</button>
  </p>
</div>
</template>
<script>
export default {
  data() {
    return {
      message: "",
      file: "",
      view: true,
      image: "",
      confirmedImage: "",
      userData: this.$store.getters["auth/userData"],
    };
  },
  created: function() {
    //ここにユーザー情報を引数で渡す必要がある
    this.getImage(this.userData.id);
  },
  computed: {
    hasImage: function() {
      return this.image !== "";
    },
    imagePath: function() {
      return this.image;
    }
  },
  methods: {
    getImage(user_id) {
    let query = { user_id: user_id };
      axios
        .get("api/images", { params: query })
        .then(response => {
          this.image = response.data;
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
    uploadImage(file) {
      //ここにユーザーID渡す
      let reader = new FileReader();
      data.append("file", this.file);
      data.append("user_id", this.userData.id);
      axios
        .post("/api/images/", data)
        .then(response => {
          this.getImage();
          this.message = response.data.success;
          this.confimedImage = "";
          this.file = "";

          this.view =false;
          this.$nextTick(function() {
            this.view =true;
          });
        })
        .catch(error => {
          this.message = error.response.data.errors;
        })
    },
    cereateImage(file) {
      let reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = e => {
        this.confirmedImage = e.target.result;
      };
    },
  }
}
</script>
<style>
.img {
  width: 100px;
}
</style>