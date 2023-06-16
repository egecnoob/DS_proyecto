<?php

namespace App\Http\Controllers;

use Illuminate\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TTratamientoController extends Controller
{
    public function index() {
        $tratamientos=DB::select("select * from TTratamiento;");
        $CON=DB::select("select CodigoCon from TConsulta_Diagnostico_Triaje;");
        return view("tratamientos")->with(["tratamientos" => $tratamientos, "CON" => $CON]);
    }

    public function create(Request $request){
        try {
            $sql = DB::insert("INSERT INTO TTratamiento (CodigoTra, FechaHoraTra, DescripcionTra, DosisTra, FrecuenciaTra, DuracionTra, CodigoCon) VALUES (?, ?, ?, ?, ?, ?, ?)", [
                $request->txtCodigoTra,
                $request->txtFechaHoraTra,
                $request->txtDescripcionTra,
                $request->txtDosisTra,
                $request->txtFrecuenciaTra,
                $request->txtDuracionTra,
                $request->txtCodigoCon
            ]); 
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Tratamiento guardado correctamente");
        } else {
            return back()->with("incorrecto", "Error al reservar");
        }
    }

    public function update(Request $request){
        try {
            $sql = DB::update("UPDATE TTratamiento SET FechaHoraTra=?, DescripcionTra=?, DosisTra=?, FrecuenciaTra=?, DuracionTra=? WHERE CodigoTra=?", [
                $request->txtFechaHoraTra,
                $request->txtDescripcionTra,
                $request->txtDosisTra,
                $request->txtFrecuenciaTra,
                $request->txtDuracionTra,
                $request->txtCodigoTra
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Tratamiento actualizado correctamente");
        } else {
            return back()->with("incorrecto", "Error al actualizar");
        }
    }

    public function delete($id) {
        try {
            $sql = DB::delete("DELETE FROM TTratamiento WHERE CodigoTra = '$id';");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Tratamiento eliminado correctamente");
        } else {
            return back()->with("incorrecto", "Error al eliminar");
        }
    }
}
