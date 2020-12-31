<?php

namespace App\Imports;

use App\Material;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class MaterialImport implements
    ToModel,
    WithHeadingRow,
    SkipsOnError

{
    use Importable, SkipsErrors;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Material([
            'material_name' => $row['material_name'],
            'category' => $row['category'],
            'unit' => $row['unit'],
            'price' => $row['price'],
            'details' => $row['details'],
        ]);
    }
}
