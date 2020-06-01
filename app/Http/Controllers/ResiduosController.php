<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ResiduosController extends Controller
{
    public function index(){
        $data = DB::table('residuos')->orderBy('nome', 'DESC')-get();

        return view('residuos', compact($data));
    }

    public function import(Request $request){
        $this->validate($request, [
            'select_file' =>    'riquired|mimes:xls,xlsx'
        ]);

        $path = $request->file('select_file')->getRealPath();
    }
    
}
