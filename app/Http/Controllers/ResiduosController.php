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
        
        $data = $residuos->orderBy('nome')->get();
        
        return new Response(json_encode($data) , 200);
    }

    public function import(Request $request){
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
           ]);
        
        $path = $request->file('select_file')->getRealPath();
        
        $data = Excel::import(new ResiduosImport, $path);

        if(!$data === "success"){
            return new Response(json_encode($data) , 500);
        }

        return new Response(json_encode('Dados do Excel Importado com sucesso!') , 200);
    }   

    /**    
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $data = $request->all();
            $resp = Residuos::whereId($id)->update($data);
            if(!$resp){                                     
                abort(500,'Erro ao atualizar os dados!');
            }
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            abort(500,'Erro ao inserir os dados! '. $e);
        }
        return new Response(json_encode('Update realizado com sucesso!') , 200);
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {     
        DB::beginTransaction();

        try {
            $residuos = Residuos::findOrFail($id);
            $resp = $residuos->delete();

            if(!$resp){                                     
                abort(500,'Erro ao atualizar os dados!');
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            abort(500,'Erro ao inserir os dados! '. $e);
        }

        return new Response(json_encode('Delete realizado com sucesso!') , 200);
    }
    
}
