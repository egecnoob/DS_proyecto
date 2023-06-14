<?php

namespace App\Http\Controllers;

use Illuminate\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TPacienteController extends Controller
{
    public function index() {
        $pacientes=DB::select("select * from TPaciente;");
        return view("pacientes")->with("pacientes", $pacientes);
    }

    public function create(Request $request){
        try {
            $sql = DB::insert("INSERT INTO TPaciente (CodigoP, TipoDocP, NroDocP, PaternoP, MaternoP, NombresP, EnfermedadesPreviasP, SexoP, CelularP, FechaNacimientoP) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                $request->txtCodigoP,
                $request->txtTipoDocP,
                $request->txtNroDocP,
                $request->txtPaternoP,
                $request->txtMaternoP,
                $request->txtNombresP,
                $request->txtEnfermedadesPreviasP,
                $request->txtSexoP,
                $request->txtCelularP,
                $request->txtFechaNacimientoP
            ]); 
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Paciente agregado correctamente");
        } else {
            return back()->with("incorrecto", "Error al agregar");
        }
    }

    public function update(Request $request){
        try {
            $sql = DB::update("UPDATE TPaciente SET TipoDocP=?, NroDocP=?, PaternoP=?, MaternoP=?, NombresP=?, EnfermedadesPreviasP=?, SexoP=?, CelularP=?, FechaNacimientoP=? WHERE CodigoP=?", [
                $request->txtTipoDocP,
                $request->txtNroDocP,
                $request->txtPaternoP,
                $request->txtMaternoP,
                $request->txtNombresP,
                $request->txtEnfermedadesPreviasP,
                $request->txtSexoP,
                $request->txtCelularP,
                $request->txtFechaNacimientoP,
                $request->txtCodigoP
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Paciente actualizado correctamente");
        } else {
            return back()->with("incorrecto", "Error al actualizar");
        }
    }

    public function delete($id) {
        try {
            $sql = DB::delete("DELETE FROM TPaciente WHERE CodigoP = '$id';");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Paciente eliminado correctamente");
        } else {
            return back()->with("incorrecto", "Error al eliminar");
        }
    }
}
