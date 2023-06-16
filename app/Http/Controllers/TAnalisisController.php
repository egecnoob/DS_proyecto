<?php

namespace App\Http\Controllers;

use Illuminate\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TAnalisisController extends Controller
{
    public function index() {
        $analisis=DB::select("select * from TAnalisis;");
        return view("analisis")->with("analisis", $analisis);
    }

    public function create(Request $request){
        try {
            $sql = DB::insert("INSERT INTO TAnalisis (CodigoA, FechaHoraA, DenominacionA, ResultadoA) VALUES (?, ?, ?, ?)", [
                $request->txtCodigoA,
                $request->txtFechaHoraA,
                $request->txtDenominacionA,
                $request->txtResultadoA
            ]); 
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Analisis guardado correctamente");
        } else {
            return back()->with("incorrecto", "Error al reservar");
        }
    }

    public function update(Request $request){
        try {
            $sql = DB::update("UPDATE TAnalisis SET FechaHoraA=?, DenominacionA=?, ResultadoA=? WHERE CodigoA=?", [
                $request->txtFechaHoraA,
                $request->txtDenominacionA,
                $request->txtResultadoA,
                $request->txtCodigoA
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Analisis actualizado correctamente");
        } else {
            return back()->with("incorrecto", "Error al actualizar");
        }
    }

    public function delete($id) {
        try {
            $sql = DB::delete("DELETE FROM TAnalisis WHERE CodigoA = '$id';");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Analisis eliminado correctamente");
        } else {
            return back()->with("incorrecto", "Error al eliminar");
        }
    }
}
