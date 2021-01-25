<template>
  <div class="wrapper">
    <drop class="drop" @drop="handleDrop">
      <div v-for="d in divs" :key="d.id">{{ d.data }}</div>
    </drop>
    
  </div>
</template>

<script>
import { Drop } from "vue-drag-drop";
export default {
  name: "dropArea",
  components: {
    drop: Drop,
  },
  data: function () {
    return {
      divs: [],
    };
  },
  methods: {
    handleDrop: function (data, event) {
      var newitem = {
        data: data,
        id: this.divs.length,
      };
      this.divs.push(newitem);
    },
  },
};
</script>

<style lang="scss" scoped>
$gap: 10px;
$width: 450px;
$height: 450px;
.wrapper {
  top: 30px;
  left: 160px;
  width: 450px;
  height: 450px;
  border: 2px solid white;
  z-index: 2;
  display: grid;
  grid-template-columns: repeat(4, ($width - $gap)/2);
  grid-template-rows: repeat(4, ($height - $gap)/2);
}
.drop {
  background: #9a9997;
  display: flex;
  flex-wrap: wrap;
  align-content: flex-start;
  div {
    margin: 5px 5px;
    color: #011;
  }
}
</style>