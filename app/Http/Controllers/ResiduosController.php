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
        
        return view('residuos', compact('data'));
    }

    public function import(Request $request){
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
           ]);
        
        $path = $request->file('select_file')->getRealPath();
        
        $data = Excel::import(new ResiduosImport, $path);
       
        return back()->with('success', 'Dados do Excel Importado com sucesso! ');
    }   

    /**    
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        Residuos::whereId($id)->update($data);

        return redirect('/residuos')->with('success', 'Update realizado com sucesso!');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {        
        $show = Residuos::findOrFail($id);
        $show->delete();

        return redirect('/residuos')->with('success', 'Delete realizado com sucesso!');
    }
    
}
