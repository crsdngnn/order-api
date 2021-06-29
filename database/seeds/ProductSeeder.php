<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $array = [
            [
                'name' => 'Product 1',
                'available_stocks' => 999
            ],
            [
                'name' => 'Product 2',
                'available_stocks' => 999
            ],
            [
                'name' => 'Product 3',
                'available_stocks' => 999
            ],
            [
                'name' => 'Product 4',
                'available_stocks' => 999
            ],
            [
                'name' => 'Product 5',
                'available_stocks' => 999
            ],
            [
                'name' => 'Product 6',
                'available_stocks' => 999
            ],
        ];
        DB::table('products')->insert($array);
    }
}
