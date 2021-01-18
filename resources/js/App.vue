<style>
@import "../css/app.css";
@import "../css/main_menu.css";
@import "../css/footer.css";
</style>
 
<template>
  <div class="container-fluid">
    <div>
      <!-- Sin sesion -->
      <!--Formulario registro -->
      <form_registro></form_registro>
      <!--Formulario inicio sesion -->
      <form_inicio_sesion></form_inicio_sesion>
      <!-- Menu Nav -->
      <div class="row">
        <nav
          id="navbar-peludets"
          class="container-fluid navbar navbar-expand-md sticky-top bg-azul-peludets"
        >
          <router-link to="/" class="navbar-brand"
            ><img src="../img/logo/logo.png" alt="Peludets!" />
          </router-link>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <router-link to="/explorador" class="nav-link"
                  >Explorador</router-link
                >
              </li>
              <li class="nav-item">
                <router-link to="/profesionales" class="nav-link"
                  >Profesionales</router-link
                >
              </li>
              <li class="nav-item d-md-none mx-auto">
                <button
                  id="inicio-sesion"
                  type="button"
                  class="btn btn-lila-peludets btn-sm mr-2"
                  data-toggle="modal"
                  data-target="#form-inicioSesion"
                >
                  Iniciar sesión
                </button>
                <button
                  id="registro"
                  type="button"
                  class="btn btn-lila-peludets btn-sm"
                  data-toggle="modal"
                  data-target="#form-registro"
                >
                  Registrate!
                </button>
              </li>
            </ul>
            <router-link to="/login" class="navbar-brand">
            <ul class="navbar-nav navbar-right">
              
              <li class="nav-item">
                
                  <button
                    id="inicio-sesion"
                    type="button"
                    class="btn btn-lila-peludets btn-sm mr-2"
                    data-toggle="modal"
                    data-target="#form-inicioSesion"
                  >
                    Iniciar sesión
                  </button>
              </li>
              <li class="nav-item">
                  <button
                    id="registro"
                    type="button"
                    class="btn btn-lila-peludets btn-sm"
                    data-toggle="modal"
                    data-target="#form-registro"
                  >
                    Registrate!
                  </button>
                
              </li>
              
            </ul>
            </router-link>
          </div>
        </nav>
      </div>
    </div>
    
    <router-view></router-view>

    <!-- Footer -->
    <div class="row">
      <footer class="container-fluid font-small bg-azul-peludets pt-4 mt-3">
        <div class="text-center text-md-left">
          <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
              <h5 class="text-uppercase">Footer Content</h5>
              <p>
                Here you can use rows and columns to organize your footer
                content.
              </p>
            </div>
            <hr class="clearfix w-100 d-md-none pb-3" />
            <div class="col-md-3 mb-md-0 mb-3">
              <h5 class="text-uppercase">Contacto</h5>
              <ul class="list-unstyled">
                <li>
                  <p>Badia del valles, 08214</p>
                </li>
                <li>
                  <p>Hoña uwu</p>
                </li>
                <li>
                  <p>Barcelona, ESPAÑA</p>
                </li>
              </ul>
            </div>
            <div class="col-md-3 mb-md-0 mb-3">
              <h5 class="text-uppercase">Redes sociales</h5>
              <ul class="list-unstyled">
                <li class="redes-sociales">
                  <a class="mr-2" href="https://twitter.com/" target="blank"
                    ><i class="fab fa-twitter-square"></i
                  ></a>
                  <a class="mr-2" href="htttps://instagram.com/" target="blank"
                    ><i class="fab fa-instagram-square"></i
                  ></a>
                  <a href="htttps://facebook.com/" target="blank"
                    ><i class="fab fa-facebook-square"></i
                  ></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="container-fluid footer-copyright text-center py-3">
            © 2020 Peludets!
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      usuario: {},
    }
  
  },
  methods: {
    recuperarSession() {
        this.axios
        .post("http://localhost/api/session/get")
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => console.log(error))
        .finally(() => (this.loading = false));
    },
  },
    beforeMount(){
      this.recuperarSession();
    }
};
</script>