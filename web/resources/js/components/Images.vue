<template>
<div>
  <p v-if="hasImage">
    <img class="image" :src="imagePath" />
  <p>{{ message }}</p>
  <p>プロフィール画像</p>
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
    uploadImage() {
      // CSRFトークンがないと怒られたけど何故か解消した
      /*
      let arr = this.getCookieArray();
      let token = arr['XSRF-TOKEN'];
      let header = {
        'X-XSRF-TOKEN': token
      }
      let reader = new FileReader();
      */
      let data = new FormData();
      data.append("file", this.file);
      data.append("user_id", this.userData.id);
      axios
        .post("/api/images/", data)
      //.post("/api/images/", data,header)
        .then(response => {
          this.getImage(this.userData.id);
          this.message = response.data.success;
          this.confimedImage = "";
          this.file = "";

          this.view = false;
          this.$nextTick(function() {
            this.view = true;
          });
        })
        .catch(error => {
          this.message = error.response.data.errors;
        })
    },
    createImage(file) {
      let reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = e => {
        this.confirmedImage = e.target.result;
      };
    },
    // 使わなくなった
    /*
    getCookieArray(){
      var arr = new Array();
      if(document.cookie != ''){
          var tmp = document.cookie.split('; ');
          for(var i=0;i<tmp.length;i++){
              var data = tmp[i].split('=');
              arr[data[0]] = decodeURIComponent(data[1]);
          }
      }
      return arr;
    }
    */
  }
}
</script>
<style>
.img {
  width: 100px;
}
</style>