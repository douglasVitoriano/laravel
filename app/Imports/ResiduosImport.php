<?php

namespace App\Imports;

use App\Entities\Residuos;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithMappedCells;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use DB;

class ResiduosImport implements ToModel, WithValidation, WithHeadingRow, WithEvents
{
    use Importable, RegistersEventListeners;

    public static function beforeImport(BeforeImport $event)
    {
        // $worksheet = $event->reader->getActiveSheet();
        // $highestRow = $worksheet->getHighestRow(); 
        // $highestColumn      = $worksheet->getHighestColumn();       
        
        // if ($highestRow < 2) {
        //     $error = \Illuminate\Validation\ValidationException::withMessages([]);
        //     $failure = new Failure(1, 'rows', [0 => 'Now enough rows!']);
        //     $failures = [0 => $failure];
        //     throw new ValidationException($error, $failures);
        // }
        
        // foreach ($worksheet->getRowIterator() as $row) {
           
        //     $cellIterator = $row->getCellIterator();
        //     $cellIterator->setIterateOnlyExistingCells(FALSE); 
            
        //     foreach ($cellIterator as $cell) {
                
        //             //  $cell->getValue() ;
        //             if(!is_null($cell->getValue())){
        //                 dd("tefsfgsdfgsdf", $cell->getValue());
        //             }
                     
        //     }
           
        // }
       
    }

    // public function mapping(): array
    // {
    //     return [
    //         'nome'                  => 'B6',           
    //         'tipo'                  => 'C6',
    //         'categoria'             => 'D6',
    //         'tecnologia_tratamento' => 'E6',
    //         'classe'                => 'F6',
    //         'un'                    => 'G6',
    //         'peso'                  => 'H6',
    //     ];
    // }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       
        return new Residuos([
            'nome'                  => $row['nome'],
            'tipo'                  => $row['tipo'],
            'categoria'             => $row['Categoria'],
            'tecnologia_tratamento' => $row['tecnologia_tratamento'],
            'classe'                => $row['classe'],
            'un'                    => $row['un'],
            'peso'                  => $row['peso'],

        ]);
    }

    // public function sheets(): array
    // {
       
    //     return [
    //         0 => new Residuos(),
    //     ];
    // }

    public function rules(): array
    {
        return [
        ];
    }
}