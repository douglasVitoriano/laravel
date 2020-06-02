<?php

namespace App\Imports;

use App\Entities\Residuos;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;

class ResiduosImport implements ToCollection
{
    public function collection(Collection $rows)
    {           
        $array_value=[]; 
        $array_comb=[];          
        foreach ($rows as $row => $value) 
        {
            if(!is_null($value[$row])){
                if (in_array("Nome Comum do Resíduo", $value->toArray())) { 
                    continue;
                }else{
                    foreach($value as $key => $data){
                        if(!is_null($data)){
                            $array_value[$row][$key] = $data;
                        }                        
                    }                    
                }
            }          
        }
        foreach($array_value as $k => $v ){
            $a = array(1 => 'nome',2 => 'tipo',3 => 'categoria',4 => 'tecnologia_tratamento',5 => 'classe',6 => 'un',7 => 'peso');
            $b = $array_value[$k];
            $array_comb[$k] = array_combine($a, $b);
        }
        
        DB::beginTransaction();
        
        try {
            foreach($array_comb as $insert){            
                $resp = Residuos::create($insert);

                if(!$resp){                                     
                    abort(500,'Erro ao inserir os dados!');
                }
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            abort(500,'Erro ao inserir os dados! '. $e);
        }

        return $this;
    }    
}