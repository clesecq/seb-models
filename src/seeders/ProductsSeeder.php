<?php

namespace Database\Seeders;

use Database\Models\Product;
use Database\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bid = ProductCategory::create(['name' => 'Boissons'])->id;
        $sid = ProductCategory::create(['name' => 'Snachs'])->id;
        $cid = ProductCategory::create(['name' => 'Boissons Chaudes'])->id;

        Product::createMany([
            ['name' => 'Coca-Cola', 'price' => 0.7, 'category_id' => $bid, 'alert_level' => 4],
            ['name' => 'Coca-Cola Cherry', 'price' => 0.7, 'category_id' => $bid, 'alert_level' => 8],
            ['name' => 'Coca-Cola Zero', 'price' => 0.7, 'category_id' => $bid, 'alert_level' => 3],
            ['name' => 'Fanta Citron', 'price' => 0.7, 'category_id' => $bid, 'alert_level' => 8],
            ['name' => 'Fanta Orange', 'price' => 0.7, 'category_id' => $bid, 'alert_level' => 4],
            ['name' => 'Ice Tea pêche', 'price' => 0.7, 'category_id' => $bid, 'alert_level' => 4],
            ['name' => 'Monster Energy', 'price' => 1.5, 'category_id' => $bid, 'alert_level' => 6],
            ['name' => 'Oasis Tropical', 'price' => 0.7, 'category_id' => $bid, 'alert_level' => 4],
            ['name' => 'Orangina', 'price' => 0.7, 'category_id' => $bid, 'alert_level' => 4],
            ['name' => 'Schweppes Agrum', 'price' => 0.7, 'category_id' => $bid, 'alert_level' => 4],
            ['name' => 'Pepsi', 'price' => 0.7, 'category_id' => $bid, 'alert_level' => 2],
            ['name' => 'Capri Sun', 'price' => 0.5, 'category_id' => $bid, 'alert_level' => 5],
            ['name' => 'Eau', 'price' => 0.5, 'category_id' => $bid, 'alert_level' => 3],

            ['name' => 'Bounty', 'price' => 0.5, 'category_id' => $sid, 'alert_level' => 3],
            ['name' => 'Kinder Bueno White', 'price' => 0.7, 'category_id' => $sid, 'alert_level' => 5],
            ['name' => 'Kinder Bueno', 'price' => 0.7, 'category_id' => $sid, 'alert_level' => 5],
            ['name' => 'Chips Nature', 'price' => 0.3, 'category_id' => $sid, 'alert_level' => 3],
            ['name' => 'Chips BBQ', 'price' => 0.3, 'category_id' => $sid, 'alert_level' => 3],
            ['name' => 'KitKat', 'price' => 0.5, 'category_id' => $sid, 'alert_level' => 5],
            ['name' => 'Lion', 'price' => 0.5, 'category_id' => $sid, 'alert_level' => 5],
            ['name' => 'Mars', 'price' => 0.5, 'category_id' => $sid, 'alert_level' => 5],
            ['name' => 'M&M\'s', 'price' => 0.5, 'category_id' => $sid, 'alert_level' => 4],
            ['name' => 'Skittles', 'price' => 0.3, 'category_id' => $sid, 'alert_level' => 4],
            ['name' => 'Snickers', 'price' => 0.5, 'category_id' => $sid, 'alert_level' => 4],
            ['name' => 'Twix', 'price' => 0.5, 'category_id' => $sid, 'alert_level' => 5],
            ['name' => 'Yum Yum Bœuf', 'price' => 0.5, 'category_id' => $sid, 'alert_level' => 3],
            ['name' => 'Yum Yum Poulet', 'price' => 0.5, 'category_id' => $sid, 'alert_level' => 3],
            ['name' => 'Yum Yum Curry', 'price' => 0.5, 'category_id' => $sid, 'alert_level' => 3],
            ['name' => 'Yum Yum Wok', 'price' => 0.5, 'category_id' => $sid, 'alert_level' => 3],
            ['name' => 'Yum Yum Crevettes', 'price' => 0.5, 'category_id' => $sid, 'alert_level' => 3],

            ['name' => 'Chocolat Chaud', 'price' => 0.3, 'category_id' => $cid, 'alert_level' => 5],
            ['name' => 'Expresso', 'price' => 0.3, 'category_id' => $cid, 'alert_level' => 3],
            ['name' => 'Longo Intenso', 'price' => 0.3, 'category_id' => $cid, 'alert_level' => 6],
            ['name' => 'Thé vert menthe', 'price' => 0.3, 'category_id' => $cid, 'alert_level' => 6],

            ['name' => 'T - Café Classique', 'price' => 0.3, 'category_id' => $cid, 'alert_level' => 0],
            ['name' => 'T - Thé Earl grey', 'price' => 0.3, 'category_id' => $cid, 'alert_level' => 0],
            ['name' => 'T - Café Long Classique', 'price' => 0.3, 'category_id' => $cid, 'alert_level' => 0],
            ['name' => 'T - Café Petit Dej\'', 'price' => 0.3, 'category_id' => $cid, 'alert_level' => 0],
            ['name' => 'T - Chocolat Chaud', 'price' => 0.3, 'category_id' => $cid, 'alert_level' => 0],
        ]);
    }
}
