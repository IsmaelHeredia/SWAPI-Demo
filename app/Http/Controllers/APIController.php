<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;

use App\Models\NaveEspacial;
use App\Models\Vehiculo;

class APIController extends Controller
{

    // Metodo CURL para cargar datos de swapi
    public function consultar($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec ($ch);
        $err = curl_error($ch);
        curl_close ($ch);
        return json_decode($response);
    }

    // Se listan las naves y se insertan en la base de datos
    public function importarNaves() {

        $pagina_actual = 1;
        $fin_de_pagina = 0;

        while($fin_de_pagina == 0) {

            $datosNaves = $this->consultar('https://swapi.dev/api/starships/?page=' . $pagina_actual);

            foreach($datosNaves->results as $datos) {
                $nave = new NaveEspacial;
                $nave->nombre = $datos->name;
                $nave->cantidad = 0;
                $nave->save();
            }

            $pagina_actual++;

            if($datosNaves->next == "") {
                $fin_de_pagina = 1;
            }

        }
    }

    // Se listan los vehiculos y insertan en la base de datos
    public function importarVehiculos() {

        $pagina_actual = 1;
        $fin_de_pagina = 0;

        while($fin_de_pagina == 0) {

            $datosVehiculos = $this->consultar('https://swapi.dev/api/vehicles/?page=' . $pagina_actual);

            foreach($datosVehiculos->results as $datos) {
                $vehiculo = new Vehiculo;
                $vehiculo->nombre = $datos->name;
                $vehiculo->cantidad = 0;
                $vehiculo->save();
            }

            $pagina_actual++;

            if($datosVehiculos->next == "") {
                $fin_de_pagina = 1;
            }

        }
    }

    // Funcion para importar las naves y vehiculos a la base de datos
    public function importarDatos() {
        $cantidad_naves = NaveEspacial::count();
        $cantidad_vehiculos = Vehiculo::count();
        if($cantidad_naves == 0 && $cantidad_vehiculos == 0) {
            $this->importarNaves();
            $this->importarVehiculos();
            return response()->json([
                'status' => 1
            ]);
        } else {
            return response()->json([
                'status' => 0
            ]);
        }
    }

    // Se listan las naves ordenadas por id
    public function cargarNaves() {
        $naves = NaveEspacial::orderBy('id','DESC')->get();
        return Response::json(array('naves'=>$naves));
    }

    // Se listan los vehiculos ordenados por id
    public function cargarVehiculos() {
        $vehiculos = Vehiculo::orderBy('id','DESC')->get();
        return Response::json(array('vehiculos'=>$vehiculos));
    }

    // Se establece una cantidad definada en la nave especificada por id
    public function setearCantidadNave(Request $request) {
        $id = $request->input('id');
        $nueva_cantidad = $request->input('nueva_cantidad');
        if($nueva_cantidad > 0) {
            $nave = NaveEspacial::find($id);
            $nave->cantidad = $nueva_cantidad;
            $nave->save();
        }
        return response()->json([
            'status' => 1
        ]);
    }

    // Se aumenta la cantidad por 1 en la nave especificada por id
    public function aumentarCantidadNave(Request $request) {
        $id = $request->input('id');
        $nave = NaveEspacial::find($id);
        $nave->cantidad = $nave->cantidad + 1;
        $nave->save();
        return response()->json([
            'status' => 1
        ]);
    }

    // Se disminuye la cantidad por 1 en la nave especificada por id
    public function disminuirCantidadNave(Request $request) {
        $id = $request->input('id');
        $nave = NaveEspacial::find($id);
        if($nave->cantidad != 0) {
            $nave->cantidad = $nave->cantidad - 1;
            $nave->save();
        }
        return response()->json([
            'status' => 1
        ]);
    }

    // Se establece una cantidad definida en el vehiculo especificado por id
    public function setearCantidadVehiculo(Request $request) {
        $id = $request->input('id');
        $nueva_cantidad = $request->input('nueva_cantidad');
        if($nueva_cantidad > 0) {
            $vehiculo = Vehiculo::find($id);
            $vehiculo->cantidad = $nueva_cantidad;
            $vehiculo->save();
        }
        return response()->json([
            'status' => 1
        ]);
    }

    // Se aumenta la cantidad por 1 en el vehiculo especificado por id
    public function aumentarCantidadVehiculo(Request $request) {
        $id = $request->input('id');
        $vehiculo = Vehiculo::find($id);
        $vehiculo->cantidad = $vehiculo->cantidad + 1;
        $vehiculo->save();
        return response()->json([
            'status' => 1
        ]);
    }

    // Se disminuye la cantidad por 1 en el vehiculo especificado por id
    public function disminuirCantidadVehiculo(Request $request) {
        $id = $request->input('id');
        $vehiculo = Vehiculo::find($id);
        if($vehiculo->cantidad != 0) {
            $vehiculo->cantidad = $vehiculo->cantidad - 1;
            $vehiculo->save();
        }
        return response()->json([
            'status' => 1
        ]);
    }
}
