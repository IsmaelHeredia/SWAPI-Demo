<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  <title>{{ 'SWAPI' }}</title>
  <link rel="icon" href="{{ asset('images/icono.png') }}">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/toastr.min.js') }}"></script>
  <script src="{{ asset('js/vue-next.js') }}"></script>
  <script src="{{ asset('js/axios.min.js') }}"></script>
</head>
<body>
    <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow gray">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0 black" href="#">SWAPI</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
        <a class="nav-link"><i class="fa fa-user-circle icon" aria-hidden="true"></i> admin</a>
        </li>
    </ul>
    </nav>

    <div id="app" class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar black">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">
                <i class="fa fa-home icon" aria-hidden="true"></i>Home <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#naves">
                <i class="fa fa-space-shuttle icon" aria-hidden="true"></i>Naves espaciales
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#vehiculos">
                <i class="fa fa-car icon" aria-hidden="true"></i>Vehiculos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#configuracion">
                <i class="fa fa-cog icon" aria-hidden="true"></i>Configuración
                </a>
            </li>    
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#about">
                <i class="fa fa-info-circle icon" aria-hidden="true"></i>About
                </a>
            </li>       
            </ul>
        </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            @if(Session::has('message_fail'))
            <div class="alert alert-danger alert-dismissible message">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('message_fail') }}
            </div>
            @endif
            @if(Session::has('message_ok'))
            <div class="alert alert-success alert-dismissible message">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('message_ok') }}
            </div>
            @endif
        @yield('content')
        </main>
        
    </div>
    </div>

</body>
<script>

this.axios.interceptors.request.use(function (config) {

  document.body.classList.add('loading-indicator');

  return config
}, function (error) {
  return Promise.reject(error);
});

  this.axios.interceptors.response.use(function (response) {

  document.body.classList.remove('loading-indicator');

  return response;
}, function (error) {
  return Promise.reject(error);
});

var url_api = "";

const app = Vue.createApp({
  delimiters: ["[[", "]]"],
  data() {
    return {
        tutoriales: [],
        naves: [],
        vehiculos: []
    }
  },
  mounted: function() { // Se cargan las tablas de naves y vehiculos
    this.listarNaves();
    this.listarVehiculos();
  },
  computed: {},
  methods: {
    importarDatos: function() { // Se carga la API para insertar las naves y vehiculos en la base de datos
      axios
      .get(url_api + "api/importarDatos/")
      .then(response => {
        var respuesta = response.data.status;
        if(respuesta == 1) {
          this.listarNaves();
          this.listarVehiculos();
          toastr.success("Los datos fueron importados");
        } else {
          toastr.warning("Los datos ya estan importados");
        }
      })
      .catch(function (error) {
        console.log(error);
        toastr.error("Ocurrio un error en la consulta");
      })
    },
    listarNaves: function() { // Se listan las naves en la tabla
      axios
      .get(url_api + "api/cargarNaves/")
      .then(response => {
        this.naves = response.data.naves
      })
      .catch(function (error) {
        console.log(error);
        toastr.error("Ocurrio un error en la consulta");
      })
    },
    listarVehiculos: function() { // Se listan los vehiculos en la tabla
      axios
      .get(url_api + "api/cargarVehiculos/")
      .then(response => {
        this.vehiculos = response.data.vehiculos
      })
      .catch(function (error) {
        console.log(error);
        toastr.error("Ocurrio un error en la consulta");
      })
    },
    establecerCantidadNave: function(id_nave) { // Se establece una nueva cantidad la nave especificada
      var nueva_cantidad = prompt("Indique la cantidad :", "");
      if(nueva_cantidad != "" && parseInt(nueva_cantidad) == nueva_cantidad) {
        axios
          .post(url_api + "api/setearCantidadNave",{"id":id_nave,"nueva_cantidad":nueva_cantidad})
          .then(response => {
            this.listarNaves();
            toastr.success("La cantidad fue actualizada");
          })
          .catch(function (error) {
            console.log(error);
            toastr.error("Ocurrio un error en la consulta");
          })
      } else {
        toastr.warning("Indique la cantidad");
      }
    },
    aumentarCantidadNave: function(id_nave) { // Se aumenta por 1 la cantidad de la nave especificada
      axios
        .post(url_api + "api/aumentarCantidadNave",{"id":id_nave})
        .then(response => {
          var datos = response.data;
          this.listarNaves();
          toastr.success("La cantidad fue actualizada");
        })
        .catch(function (error) {
          console.log(error);
          toastr.error("Ocurrio un error en la consulta");
        })
    },
    disminuirCantidadNave: function(id_nave) { // Se disminuye por 1 la cantidad de la nave especificada
      axios
        .post(url_api + "api/disminuirCantidadNave",{"id":id_nave})
        .then(response => {
          var datos = response.data;
          this.listarNaves();
          toastr.success("La cantidad fue actualizada");
        })
        .catch(function (error) {
          console.log(error);
          toastr.error("Ocurrio un error en la consulta");
        })
    },
    establecerCantidadVehiculo: function(id_vehiculo) { // Se establece una cantidad fija en el vehiculo especificado
      var nueva_cantidad = prompt("Indique la cantidad :", "");
      if(nueva_cantidad != "" && parseInt(nueva_cantidad) == nueva_cantidad) {
        axios
          .post(url_api + "api/setearCantidadVehiculo",{"id":id_vehiculo,"nueva_cantidad":nueva_cantidad})
          .then(response => {
            var datos = response.data;
            this.listarVehiculos();
            toastr.success("La cantidad fue actualizada");
          })
          .catch(function (error) {
            console.log(error);
            toastr.error("Ocurrio un error en la consulta");
          })
      } else {
        toastr.warning("Indique la cantidad");
      }
    },
    aumentarCantidadVehiculo: function(id_vehiculo) { // Se aumentar por 1 la cantidad de un vehiculo especificado
      axios
        .post(url_api + "api/aumentarCantidadVehiculo",{"id":id_vehiculo})
        .then(response => {
          var datos = response.data;
          this.listarVehiculos();
          toastr.success("La cantidad fue actualizada");
        })
        .catch(function (error) {
          console.log(error);
          toastr.error("Ocurrio un error en la consulta");
        })
    },
    disminuirCantidadVehiculo: function(id_vehiculo) { // Se disminuye por 1 la cantidad de un vehiculo especificado
      axios
        .post(url_api + "api/disminuirCantidadVehiculo",{"id":id_vehiculo})
        .then(response => {
          var datos = response.data;
          this.listarVehiculos();
          toastr.success("La cantidad fue actualizada");
        })
        .catch(function (error) {
          console.log(error);
          toastr.error("Ocurrio un error en la consulta");
        })
    },
  },
});

app.mount("#app");

$(function() {
  $(".modal").modal();
});

</script>

</html>