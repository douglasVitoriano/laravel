<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Residuos extends Model
{
    protected $fillable = [        
        'nome', 'tipo', 'categoria', 'tecnologia_tratamento', 'classe', 'un', 'peso'
     ];
 
     protected $attributes = [
      
         'nome' => '',
         'tipo' => '',
         'categoria' => '',
         'tecnologia_tratamento' => '',
         'classe' => '',
         'un' => '',
         'peso' => '',
         
     ];
     
     protected $table = 'tbl_residuos';
}
