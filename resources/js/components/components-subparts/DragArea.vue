<template>
    <div>
        <drag class="box red mt-5 " transfer-data="A">A</drag>
        <drag class="box blue mt-5" transfer-data="B">B</drag>
        <drag class="box green"></drag>
        <drag class="box orange"></drag>
        
    </div>
</template>
<script>
import { Drag } from "vue-drag-drop";

export default {
    name: 'dragArea',
    components:{
        'drag':Drag
    }
    
}
</script>

<style lang="scss" scoped>
.red{
    background: #d33;
}
.blue{
    background: #33d;
}.green{
    background: #3d3;
}.orange{
    background: #e73;
}
    
</style>