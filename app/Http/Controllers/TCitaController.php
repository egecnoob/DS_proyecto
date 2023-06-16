<?php

namespace App\Http\Controllers;

use Illuminate\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TCitaController extends Controller
{
    public function index() {
        $citas=DB::select("select * from TCita;");
        $pacientes=DB::select("select CodigoP from TPaciente;");
        return view("citas")->with(["citas" => $citas, "pacientes" => $pacientes]);
    }

    public function create(Request $request){
        try {
            $sql = DB::insert("INSERT INTO TCita (CodigoC, FechaHoraC, MotivoC, CodigoP) VALUES (?, ?, ?, ?)", [
                $request->txtCodigoC,
                $request->txtFechaHoraC,
                $request->txtMotivoC,
                $request->txtCodigoP
            ]); 
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Cita reservada correctamente");
        } else {
            return back()->with("incorrecto", "Error al reservar");
        }
    }

    public function update(Request $request){
        try {
            $sql = DB::update("UPDATE TCita SET FechaHoraC=?, MotivoC=? WHERE CodigoC=?", [
                $request->txtFechaHoraC,
                $request->txtMotivoC,
                $request->txtCodigoC,
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Cita actualizada correctamente");
        } else {
            return back()->with("incorrecto", "Error al actualizar");
        }
    }

    public function delete($id) {
        try {
            $sql = DB::delete("DELETE FROM TCita WHERE CodigoC = '$id';");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Cita eliminada correctamente");
        } else {
            return back()->with("incorrecto", "Error al eliminar");
        }
    }
}
