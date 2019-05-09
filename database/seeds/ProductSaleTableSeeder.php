<?php

use Illuminate\Database\Seeder;

class ProductSaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ProductSale::class, 500)->create();
    }
}
