<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("products")->insert([
            "name"=>"oppo",
            "description"=>"n publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.",
            "price"=>9000,
            "quantity"=>10,
            "image"=>"1.png",
            "category_id"=>1
        ]);
        DB::table("products")->insert([
            "name"=>"dell",
            "description"=>"n publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.",
            "price"=>29000,
            "quantity"=>5,
            "image"=>"2.png",
            "category_id"=>2
        ]);
    }
}
