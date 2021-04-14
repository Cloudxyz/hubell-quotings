<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\User;
use App\Models\Discount;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;


class UsersImport implements OnEachRow, WithHeadingRow, WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();
        
        $user = User::create([
            'name' => $row['nombre'],
            'email' => $row['email'],
            'password' => Hash::make($row['contrasena']),
            ]);
            
        if($user->save()){
            $user->assignRole('Client');

            $profile = new Profile;
            $profile->user_id       = $user->id;
            $profile->lastname      = $row['apellido'];
            $profile->country       = $row['pais'];
            $profile->state         = $row['estado'];
            $profile->city          = $row['ciudad'];
            $profile->street        = $row['calle'];
            $profile->zip           = $row['cp'];
            $profile->phone         = $row['telefono'];
            $profile->client_number = $row['no_cliente'];

            if($profile->save()){
                $discounts = explode(";", $row['descuentos']);
                foreach($discounts as $discountString){
                    $discountClean = trim($discountString);
                    $discountNewClean = explode("/", $discountClean);
                    $brand = trim($discountNewClean[0]);
                    $discountNumber = trim($discountNewClean[1]);
                    
                    $discount = new Discount;
                    $discount->user_id = $user->id;
                    $discount->brand_id = Brand::where('name', $brand)->first()->id;
                    $discount->discount = $discountNumber;
                    $discount->save();
                }
            }
        }
    }
    
    public function uniqueBy()
    {
        return 'email';
    }
}
