<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BaseDatosImport implements ToCollection
{
    public $data;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {

        $this->data = $rows;
    }
}
