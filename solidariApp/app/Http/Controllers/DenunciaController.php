<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;
use App\Models\Usuario;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class DenunciaController extends Controller
{
    //
    public function altaDenuncia( Request $request ){
        try{
            session_start();
            if(isset($_SESSION['usuario']))
            {
                if(UsuarioController::tienePermisoPara("registrarDenuncia"))
                {
                    $datosReporte = json_decode($request->getContent());

                    //VALIDACIONES
                    if( $datosReporte->descripcion == ''){
                        return response()->json([
                            'resultado' => 0,
                            'message' => 'ingrese una descripcion'
                        ]);
                    }
                    else if( strlen($datosReporte->descripcion) < 4 ){
                        return response()->json([
                            'resultado' => 0,
                            'message' => 'ingrese una descripcion de al menos 4 caracteres'
                        ]);
                    }
                    else if( $datosReporte->fecha == ''){
                        return response()->json([
                            'resultado' => 0,
                            'message' => 'ingrese una fecha'
                        ]);
                    }
                    else if( !strtotime( $datosReporte->fecha ) ){
                        return response()->json([
                            'resultado' => 0,
                            'message' => 'ingrese una fecha valida'
                        ]);
                    }
                    else{
                        $datosReporte->idDenunciante = $_SESSION['usuario']->idUsuario;
                        $denuncia = new Denuncia;
                        $denuncia->idMotivoDenuncia = $datosReporte->motivo;
                        $denuncia->fechaDenuncia = $datosReporte->fecha;
                        $denuncia->idDenunciante = $datosReporte->idDenunciante;
                        $denuncia->idDenunciado = $datosReporte->idDenunciado;
                        $denuncia->descripcionDenuncia = $datosReporte->descripcion;
                        $denuncia->save();
                        return response()->json([
                            'resultado' => 1,
                            'message' => 'denuncia realizada'
                        ]);
                    }
                }
                else
                {
                    return response()->json([
                        'resultado' => 0,
                        'message' => "ACCION NO PERMITIDA",
                    ]);
                }
            }
            else
            {
                return response()->json([
                    'resultado' => 0,
                    'message' => 'No estas logueado'
                ]);
            }
        }
        catch (\Exception $e)
        {
            return response()->json([
                'resultado' => 0,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getDenuncias(){
        if(UsuarioController::tienePermisoPara("verDenuncia"))
        {
            $denuncias = Denuncia::getDenuncias();
            foreach ($denuncias as $key => $denuncia) {
                $denuncia['denunciante'] = Usuario::getUsuario( $denuncia->idDenunciante);
                $denuncia['denunciado'] = Usuario::getUsuario( $denuncia->idDenunciado);
            }
            return response()->json([
                'denuncias' => $denuncias
            ]);
        }
    }

    public function confirmarDenuncia( Request $request ){
        try {
            if(UsuarioController::tienePermisoPara("confirmarDenuncia"))
            {
                DB::beginTransaction();
                Denuncia::confirmarDenuncia( $request->idDenuncia );
                Usuario::bloquearUsuario( $request->idDenunciado );
                DB::commit();
                return response()->json([
                    'resultado' => 1,
                    'message'=> 'usuario bloqueado'
                ]);
            }
            else
            {
                return response()->json([
                    'resultado' => 0,
                    'message' => "ACCION NO PERMITIDA"
                ]);
            }
        }
        catch (\Exception $e)
        {
            return response()->json([
                'resultado' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

}
