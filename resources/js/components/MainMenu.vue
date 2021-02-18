<template>
  <div class="container-fluid bg-azul-peludets">
    <!-- CABECERA -->
    <div class="row">
      <!-- LOGO -->
      <div class="mt-5 col-md-3 mx-auto d-flex justify-content-center">
        <route-link to="/" class="navbar-brand">
          <img
            src="../../img/logo/logo.png"
            alt="Peludets"
            style="width: 50%"
          />
        </route-link>
      </div>
    </div>

    <div class="row">
      <!-- MENU PRINCIPAL -->
      <nav class="col-md-12 navbar navbar-peludets navbar-expand-lg">
        <!-- BOTON RESPONSIVE -->
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#menuPrincipal"
          aria-controls="menuPrincipal"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="col-md-12 collapse navbar-collapse" id="menuPrincipal">
          <ul class="mr-auto"></ul>
          <!-- ELEMENTOS DEL MENÚ -->
          <ul class="navbar-nav mx-auto">
            <!-- EXPLORADOR -->
            <li class="nav-item">
              <router-link
                to="/explorador"
                class="nav-link lila-peludets font-weight-bold menu-link"
              >
                {{ $t("app.menuExplorador") }}
              </router-link>
            </li>
            <!-- PROFESIONALES -->
            <li class="nav-item">
              <router-link
                to="/profesionales"
                class="nav-link lila-peludets font-weight-bold menu-link"
              >
                {{ $t("app.menuProfesionales") }}
              </router-link>
            </li>
            <!-- DESCARGAS -->
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle lila-peludets font-weight-bold menu-link"
                href="#"
                id="opcionesDescarga"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                {{ $t("app.menuDescarga") }}
              </a>
              <div class="dropdown-menu" aria-labelledby="opcionesDescarga">
                <a
                  href="/bin/mac.zip"
                  class="lila-peludets font-weight-bold"
                  download
                  >Mac</a
                >
                <a
                  href="/bin/win.7z"
                  class="lila-peludets font-weight-bold"
                  download
                  >Windows</a
                >
                <a
                  href="/bin/linux.tar.gz"
                  class="lila-peludets font-weight-bold"
                  download
                  >Linux</a
                >
              </div>
            </li>
          </ul>
          <!-- USUARIO -->
          <ul class="navbar-nav mr-auto">
            <div class="dropdown">
              <button
                class="btn btn-lila-peludets dropdown-toggle"
                type="button"
                id="menuUsuario"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="fas fa-user fa-lg"></i>
              </button>
              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="menuUsuario"
              >
                <button class="dropdown-item" type="button">Action</button>
                <button class="dropdown-item" type="button">
                  Another action
                </button>
                <button class="dropdown-item" type="button">
                  Something else here
                </button>
              </div>
            </div>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</template>