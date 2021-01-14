<style>
@import "../../css/home.css";

</style>

<template>


<div>
<div class="row mt-4">
   <!-- TABLE  -->
   <div class="col-md-6">
   <h1 style="text-align: center;  color: rgb(64, 49, 114);"> Solicitudes de Trabajos Pendientes</h1>
      <br>

      <!---TABLA DE SOLICITUDES PENDIENTES-->
      <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Aceptar</th>
      <th scope="col">Rechazar</th>
    </tr>
  </thead>
  <div id="tabla">
    <div class="filas">
      <td class="id card_attr" scope="row">1</td>
      <td class="name card_attr">name</td>
      <td class="description card_attr">Description</td>
      <td><button class="task-delete btn btn-success">Aceptar</button></td>
      <td><button class="task-delete btn btn-danger ">Rechazar</button></td>
    </div>
    
  </div>
</table>

   </div>



   <!---DONDE ESTA EL CALENDARIO--->
   <div id='calendar' class="col-md-5 mx-auto cal">
   </div>
</div>

<!-- Modal -->
<div class="row mt-5">
   <!-- Modal -->
   <div id="form-trabajos" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="container-fluid">
                  <div class="col-md-12">
                     <h4 class="modal-title"></h4>
                  </div>
               </div>
            </div>
            <div class="modal-body col-md-12">
               <form action="registroUsuario.php" method="post">
                  <div class="form-group">
                     <table id="listaTrabajos" class="table">
                        <thead class="text-center">
                           <tr>
                              <th scope="col">Nombre</th>
                              <th scope="col">Mascota</th>
                              <th scope="col">Contacto</th>
                              <th scope="col"></th>
                           </tr>
                        </thead>
                        <tbody class="text-center">
                        </tbody>
                     </table>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button id="cerrarModal" type="submit" class="btn btn-danger" value="">Cerrar</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>
  
</template>