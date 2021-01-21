

<template>

<div id = "app" class="container mt-5">

 
            <h3>{{titulo}}</h3>

      <input
        type="text"
        class="form-control my-3"
        name=""
        id=""
        v-model="nuevaTarea"
        v-on:keyup.enter="agregarTarea"
      />

       <button class="btn btn-primary" @click="agregarTarea">Agregar</button>

      <div class="mt-3" v-for="(t,index) of tareas" :key="t.nombre">
        <div role="alert" :class="['alert' , t.estado ? 'alert-success' : 'alert-danger']">
          <div class="d-flex justify-content-between align-items-center">
              <div>
                 {{index+1}}.  {{t.nombre}}
              </div>
            <div>
              <button class="btn btn-success btn-sm" @click="editarTarea(index)">Agregar</button>
              <button class="btn btn-danger btn-sm" @click="eliminarTarea(index)">Eliminar</button>
            </div>
          </div>
        </div>

    
  
   
  </div>
</div> 
</template>

<script>
export default {
    name:'AgregarTareas',
       data() {
        return { 
         titulo:"Tareas",
        tareas: [],
        nuevaTarea: '',
        } 

    },
    methods: {
        agregarTarea(){
            console.log(this.nuevaTarea);
            this.tareas.push({
                nombre: this.nuevaTarea,
                estado: false
            });
            console.log(this.tareas)
            this.nuevaTarea= '';
            localStorage.setItem('peludets-vue',JSON.stringify(this.tareas));

        },
        editarTarea(index){
           this.tareas[index].estado=true;
           localStorage.setItem('peludets-vue',JSON.stringify(this.tareas));

        },
        eliminarTarea(index){
           this.tareas.splice(index,1)
           localStorage.setItem('peludets-vue',JSON.stringify(this.tareas));

        }
    },
    created: function () {
        let datosDB = JSON.parse(localStorage.getItem('peludets-vue'));
        if (datosDB ===null) {
            this.tareas = [];
        } else {
            this.tareas= datosDB;
        }

        
    }
}
</script>

