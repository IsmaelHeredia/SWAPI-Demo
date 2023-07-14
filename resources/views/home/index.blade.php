@extends('layouts.layout')
@section('content')

<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active show" id="home">
        <h1 class="text-center">Bienvenido a SWAPI</h1>
    </div>
    <div class="tab-pane fade" id="naves">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h1 class="h2">Naves espaciales</h1>
        </div>
        <br/>
        <br/>
        <div v-if="naves.length > 0">
            <div class="scrollbar">
                <table class="table table-hover" id="tabla_naves">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="nave in naves" :key="nave.id">
                            <td>[[nave.nombre]]</td>
                            <td>[[nave.cantidad]]</td>
                            <td>
                                <a class="btn btn-primary" style="margin-left: 10px;" @click="establecerCantidadNave(nave.id)">Establecer</a>
                                <a class="btn btn-primary" style="margin-left: 10px;" @click="aumentarCantidadNave(nave.id)">Aumentar</a>
                                <a class="btn btn-primary" style="margin-left: 10px;" @click="disminuirCantidadNave(nave.id)">Disminuir</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div v-else>
            <h4>No hay naves disponibles, primero necesita importar los datos en la sección de configuración</h4>
        </div>
    </div>
    <div class="tab-pane fade" id="vehiculos">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h1 id="playlist_name" class="h2">Vehiculos</h1>
        </div>
        <br/>
        <br/>
        <div v-if="vehiculos.length > 0">
            <div class="scrollbar">
                <table class="table table-hover" id="tabla_vehiculos">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr v-for="vehiculo in vehiculos" :key="vehiculo.id">
                            <td>[[vehiculo.nombre]]</td>
                            <td>[[vehiculo.cantidad]]</td>
                            <td>
                                <a class="btn btn-primary" style="margin-left: 10px;" @click="establecerCantidadVehiculo(vehiculo.id)">Establecer</a>
                                <a class="btn btn-primary" style="margin-left: 10px;" @click="aumentarCantidadVehiculo(vehiculo.id)">Aumentar</a>
                                <a class="btn btn-primary" style="margin-left: 10px;" @click="disminuirCantidadVehiculo(vehiculo.id)">Disminuir</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div v-else>
            <h4>No hay vehiculos disponibles, primero necesita importar los datos en la sección de configuración</h4>
        </div>
    </div>
    <div class="tab-pane fade" id="configuracion">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h1 class="h2">Configuracíon</h1>
        </div>
        <br/>
        <br/>
        <button class="btn btn-dark" @click="importarDatos()">Importar datos de SWAPI</button>
    </div>
    <div class="tab-pane fade" id="about">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">About</h1>
        </div>
        <h5>Programa : SWAPI</h5>
        <div class="tiny-space"></div>
        <h5>Version : 1.0</h5>
        <div class="tiny-space"></div>
        <h5>Descripción : Ejemplo de controlar las cantidades de los vehiculos y naves espaciales en la API de SWAPI</h5>
        <div class="tiny-space"></div>
        <h5>Autor : Ismael Heredia</h5>
    </div>
</div>

@endsection