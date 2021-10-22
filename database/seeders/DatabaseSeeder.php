<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Order;
use App\Models\Item;
use App\Models\Type;
use App\Models\Discount;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *[
     * @return void
     */
    public function run()
    {
        $options = [
            'announcement.text' => '',
            'banner.text' => '',
            'deliver_fee' => 0,
            'deliver_free.price' => 0,
            'discount.condition' => 0,
            'discount.price' => 0,
            'heaven.key' => 'false',
            'open.area' => '[]',
            'website.open' => 'true',
        ];
        foreach($options as $key => $option) {
            $target = new Option();
            $target->option_key = $key;
            $target->option_value = $option;
            $target->save();
        }
        // \App\Models\User::factory(10)->create();
//        Order::factory(50)->create();
//        Item::factory(5)->create();
//        Type::factory(5)->create();
//        Discount::factory(5)->create();
    }
}
