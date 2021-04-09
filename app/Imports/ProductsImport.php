<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ProductsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $brand = new Brand;
        $brand->name = $row['marca'];

        $brandExist = Brand::where('name', $row['marca'])->get();
        if($brandExist->isEmpty()){
            $brand->save();
        }

        return new Product([
            'division'         => $row['dv'],
            'brand'            => $row['marca'],
            'material'         => $row['material'],
            'description'      => $row['descripcion'],
            'amount'           => $row['amount'],
            'unit'             => $row['unit'],
            'per'              => $row['per'],
            'uom'              => $row['uom'],
            'min_package'      => $row['empaque_minimo'],
            'abc'              => $row['abc_code'],
        ]);

    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function uniqueBy()
    {
        return 'material';
    }
}
