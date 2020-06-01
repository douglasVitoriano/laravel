<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Residuos;
use App\Imports\ResiduosImport;
use DB;
use Excel;

class ResiduosController extends Controller
{
    public function index(){    
        $residuos = new Residuos();
        
        $data = $residuos->orderBy('nome', 'DESC')->get();
        
        return view('residuos', compact('data'));
    }

    public function import(Request $request){
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
           ]);
        
        $path = $request->file('select_file')->getRealPath();
        
        $data = Excel::import(new ResiduosImport, $path);
        // $data = Excel::load($path)->get();
        
        dd("aquiiiii", $data);
        // if($data->count() > 0){
        //     foreach($data->toArray() as $key => $value)
        //     {
        //         foreach($value as $row){
        //             $insert_data[] = array(
        //                 'Nome' => $row['nome'],
        //                 'Tipo' => $row['tipo'],
        //                 'Categoria' => $row['categoria'],
        //                 'TecnologiaTratamento' => $row['tecnologia_tratamento'],
        //                 'Classe' => $row['classe'],
        //                 'UN' => $row['un'],
        //                 'Peso' => $row['peso'],
        //             );
        //         }
        //     }

        //     if(!empty($insert_data)){
        //         DB::table('residuos')->insert($insert_data);
        //     }
        // }

        // return back()->with('success', 'Dados do Excel Importado com sucesso! ');
    }
    
}
