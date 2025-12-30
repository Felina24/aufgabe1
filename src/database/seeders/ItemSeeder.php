<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $userId = 1;

        $items = [
            [
                'name' => '腕時計',
                'price' => 15000,
                'brand_name' => 'Rolax',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'image_path' => 'products/watch.jpg',
                'status' => '良好',
            ],
            [
                'name' => 'HDD',
                'price' => 5000,
                'brand_name' => '西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'image_path' => 'products/hdd.jpg',
                'status' => '目立った傷や汚れなし',
            ],
            [
                'name' => '玉ねぎ3束',
                'price' => 300,
                'brand_name' => null,
                'description' => '新鮮な玉ねぎ3束のセット',
                'image_path' => 'products/onion.jpg',
                'status' => 'やや傷や汚れあり',
            ],
            [
                'name' => '革靴',
                'price' => 4000,
                'brand_name' => null,
                'description' => 'クラシックなデザインの革靴',
                'image_path' => 'products/shoes.jpg',
                'status' => '状態が悪い',
            ],
            [
                'name' => 'ノートPC',
                'price' => 40000,
                'brand_name' => null,
                'description' => '高性能なノートパソコン',
                'image_path' => 'products/laptop.jpg',
                'status' => '良好',
            ],
            [
                'name' => 'マイク',
                'price' => 8000,
                'brand_name' => null,
                'description' => '高音質のレコーディング用マイク',
                'image_path' => 'products/mic.jpg',
                'status' => '目立った傷や汚れなし',
            ],
            [
                'name' => 'ショルダーバッグ',
                'price' => 3500,
                'brand_name' => 'おしゃれなショルダーバッグ',
                'description' => 'おしゃれなショルダーバッグ',
                'image_path' => 'products/bag.jpg',
                'status' => 'やや傷や汚れあり',
            ],
            [
                'name' => 'タンブラー',
                'price' => 500,
                'brand_name' => null,
                'description' => '使いやすいタンブラー',
                'image_path' => 'products/tumbler.jpg',
                'status' => '状態が悪い',
            ],
            [
                'name' => 'コーヒーミル',
                'price' => 4000,
                'brand_name' => 'Starbacks',
                'description' => '手動のコーヒーミル',
                'image_path' => 'products/coffeemill.jpg',
                'status' => '良好',
            ],
            [
                'name' => 'メイクセット',
                'price' => 2500,
                'brand_name' => null,
                'description' => '便利なメイクアップセット',
                'image_path' => 'products/makeup.jpg',
                'status' => '目立った傷や汚れなし',
            ],
        ];

        foreach ($items as $item) {
            Item::create([
                'user_id'      => $userId,
                'image_path'   => $item['image_path'],
                'name'         => $item['name'],
                'brand_name'   => $item['brand_name'],
                'price'        => $item['price'],
                'description'  => $item['description'],
                'status'       => $item['status'],
            ]);
        }
    }
}
