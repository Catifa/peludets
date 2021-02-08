<template>
  <form @submit.prevent="store" enctype="multipart/form-data">
    <input type="file" id="file" @change="file($event)" />
    <input type="submit" />

    <img v-bind:src="image" />
  </form>
</template>

<script>
export default {
  data() {
    return {
      img: {},
      image: undefined,
    };
  },
  methods: {
    file(e) {
      var formData = new FormData();
      var file = e.target.files[0];
      formData.append("Filedata", file);
      var t = file.type.split("/").pop().toLowerCase();
      if (t != "jpeg" && t != "jpg" && t != "png") {
        alert("Please select a valid image file (jpeg, jpg, png)");
        document.getElementById("file").value = "";
        return false;
      }
      if (file.size > 1024000) {
        alert("Max Upload size is 1MB only");
        document.getElementById("file").value = "";
        return false;
      }

      let f = e.target.files[0];
      let reader = new FileReader();

      reader.onloadend = () => {
        this.img = reader.result;
      };

      reader.readAsDataURL(f);
    },
    store() {
      //console.log(this.img);
      axios.post("/api/files/setProfilePhoto", { img: this.img }).then((res)=>{
        console.log(res.data);
      });
    },
  },
};
</script>