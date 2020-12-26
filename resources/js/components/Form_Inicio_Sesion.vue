<template>
    <div class="row">
        <!-- Modal -->
        <div id="form-inicioSesion" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <h4 class="modal-title">Inicio de sesión</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="emailLogin" placeholder="Introduce tu email">
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="password" class="form-control" id="passLogin">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12">
                            <button id="btn-login" type="submit" class="btn btn-azul-peludets">Iniciar sesion</button>
                        </div>
                        <small><a href="">He olvidado mi contraseña</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    
}
</script>