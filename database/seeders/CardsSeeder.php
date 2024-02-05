<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cards=[
            [
                'name'=>'Malthus Chitake',
                'number'=>1452385626745698,
                'expiry_date'=>'07/27',
                'cvv'=>256
            ],
            [
                'name'=>'Mark Conway',
                'number'=>5682365741298563,
                'expiry_date'=>'07/25',
                'cvv'=>853
            ],
            [
                'name'=>'Jamal Kamwenda',
                'number'=>6523987436851286,
                'expiry_date'=>'07/28',
                'cvv'=>445
            ]
        ];
        foreach ($cards as $card){
            Card::create($card);
        }
    }
}
