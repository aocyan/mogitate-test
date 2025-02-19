<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Season;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seasons = ['春', '夏', '秋', '冬'];

        foreach ($seasons as $season) {
            DB::table('seasons')->insertOrIgnore([
                'name' => $season,
            ]);
        }

        $kiwiId = DB::table('products')->insertGetId([
            'name' => 'キウイ',
            'price' => 800,
            'image' => 'products/kiwi.png',
            'description' => 'キウイは甘みと酸味のバランスが絶妙なフルーツです。ビタミンCなどの栄養素も豊富のため、美肌効果や疲労回復効果も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
        ]);

        $seasons = ['秋', '冬'];

        foreach($seasons as $season) {
            $seasonId = DB::table('seasons')->where('name', $season)->value('id');
            DB::table('product_season')->insert([
                'product_id' => $kiwiId,
                'season_id' => $seasonId,
            ]);
        }

        $strawberryId = DB::table('products')->insertGetId([
            'name' => 'ストロベリー',
            'price' => 1200,
            'image' => 'products/strawberry.png',
            'description' => '大人から子供まで大人気のストロベリー。当店では鮮度抜群の完熟いちごを使用しています。ビタミンCはもちろん食物繊維も豊富なため、腸内環境の改善も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
        ]);

        $seasons = ['春'];

        foreach($seasons as $season) {
            $seasonId = DB::table('seasons')->where('name', $season)->value('id');
            DB::table('product_season')->insert([
                'product_id' => $strawberryId,
                'season_id' => $seasonId,
            ]);
        }

        $orangeId = DB::table('products')->insertGetId([
            'name' => 'オレンジ',
            'price' => 850,
            'image' => 'products/orange.png',
            'description' => '当店では酸味と甘みのバランスが抜群のネーブルオレンジを使用しています。酸味は控えめで、甘さと濃厚な果汁が魅力の商品です。もぎたてフルーツのスムージをお召し上がりください！',
        ]);

        $seasons = ['冬'];

        foreach($seasons as $season) {
            $seasonId = DB::table('seasons')->where('name', $season)->value('id');
            DB::table('product_season')->insert([
                'product_id' => $orangeId,
                'season_id' => $seasonId,
            ]);
        }

        $watermelonId = DB::table('products')->insertGetId([
            'name' => 'スイカ',
            'price' => 700,
            'image' => 'products/watermelon.png',
            'description' => '甘くてシャリシャリ食感が魅力のスイカ。全体の90％が水分のため、暑い日の水分補給や熱中症予防、カロリーが気になる方にもおすすめの商品です。もぎたてフルーツのスムージーをお召し上がりください！',
        ]);

        $seasons = ['夏'];

        foreach($seasons as $season) {
            $seasonId = DB::table('seasons')->where('name', $season)->value('id');
            DB::table('product_season')->insert([
                'product_id' => $watermelonId,
                'season_id' => $seasonId,
            ]);
        }

        $peachId = DB::table('products')->insertGetId([
            'name' => 'ピーチ',
            'price' => 1000,
            'image' => 'products/peach.png',
            'description' => '豊潤な香りととろけるような甘さが魅力のピーチ。美味しさはもちろん見た目の可愛さも抜群の商品です。ビタミンEが豊富なため、生活習慣病の予防にもおすすめです。もぎたてフルーツのスムージーをお召し上がりください！',
        ]);

        $seasons = ['夏'];

        foreach($seasons as $season) {
            $seasonId = DB::table('seasons')->where('name', $season)->value('id');
            DB::table('product_season')->insert([
                'product_id' => $peachId,
                'season_id' => $seasonId,
            ]);
        }

        $muscatId = DB::table('products')->insertGetId([
            'name' => 'シャインマスカット',
            'price' => 1400,
            'image' => 'products/muscat.png',
            'description' => '爽やかな香りと上品な甘みが特長的なシャインマスカットは大人から子どもまで大人気のフルーツです。疲れた脳や体のエネルギー補給にも最適の商品です。もぎたてフルーツのスムージーをお召し上がりください！',
        ]);

        $seasons = ['夏', '秋'];

        foreach ($seasons as $season) {
            $seasonId = DB::table('seasons')->where('name', $season)->value('id');
            DB::table('product_season')->insert([
                'product_id' => $muscatId,
                'season_id' => $seasonId,
            ]);
        }

        $pineappleId = DB::table('products')->insertGetId([
            'name' => 'パイナップル',
            'price' => 800,
            'image' => 'products/pineapple.png',
            'description' => '甘酸っぱさとトロピカルな香りが特徴のパイナップル。当店では甘さと酸味のバランスが絶妙な国産のパイナップルを使用しています。もぎたてフルーツのスムージをお召し上がりください！',
        ]);

        $seasons = ['春', '夏'];

        foreach ($seasons as $season) {
            $seasonId = DB::table('seasons')->where('name', $season)->value('id');
            DB::table('product_season')->insert([
                'product_id' => $pineappleId,
                'season_id' => $seasonId,
            ]);
        }

        $grapesId = DB::table('products')->insertGetId([
            'name' => 'ブドウ',
            'price' => 1100,
            'image' => 'products/grapes.png',
            'description' => 'ブドウの中でも人気の高い国産の「巨峰」を使用しています。高い糖度と適度な酸味が魅力で、鮮やかなパープルで見た目も可愛い商品です。もぎたてフルーツのスムージーをお召し上がりください！',
        ]);

        $seasons = ['夏', '秋'];

        foreach ($seasons as $season) {
            $seasonId = DB::table('seasons')->where('name', $season)->value('id');
            DB::table('product_season')->insert([
                'product_id' => $grapesId,
                'season_id' => $seasonId,
            ]);
        }

        $bananaId = DB::table('products')->insertGetId([
            'name' => 'バナナ',
            'price' => 600,
            'image' => 'products/banana.png',
            'description' => '低カロリーでありながら栄養満点のため、ダイエット中の方にもおすすめの商品です。1杯でバナナの濃厚な甘みを存分に堪能できます。もぎたてフルーツのスムージーをお召し上がりください！',
        ]);

        $seasons = ['夏'];

        foreach ($seasons as $season) {
            $seasonId = DB::table('seasons')->where('name', $season)->value('id');
            DB::table('product_season')->insert([
                'product_id' => $bananaId,
                'season_id' => $seasonId,
            ]);
        }

        $melonId = DB::table('products')->insertGetId([
            'name' => 'メロン',
            'price' => 900,
            'image' => 'products/melon.png',
            'description' => '香りがよくジューシーで品のある甘さが人気のメロンスムージー。カリウムが多く含まれているためむくみ解消効果も抜群です。もぎたてフルーツのスムージーをお召し上がりください！',
        ]);

        $seasons = ['春', '夏'];

        foreach ($seasons as $season) {
            $seasonId = DB::table('seasons')->where('name', $season)->value('id');
            DB::table('product_season')->insert([
                'product_id' => $melonId,
                'season_id' => $seasonId,
            ]);
        }
    }
}
