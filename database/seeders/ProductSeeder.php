<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::table('products')->insert([
            [
                'name'=>'US Polo',
                "price"=>"750",
                "description"=>"Classic Polo T-shirts are transforming Fit & Comfort.With the best in class fabrics",
                "category"=>"T-shirt",
                "gallery"=>"https://images.meesho.com/images/products/9467959/0178a_256.jpg"
            ],
            [
                'name'=>'Shoe',
                "price"=>"2300",
                "description"=>"White & Grey Sneakers for Men",
                "category"=>"Shoe",
                "gallery"=>"https://assets.ajio.com/medias/sys_master/root/20210727/E1wM/60ff2434aeb269a9e353786f/-473Wx593H-460934422-offwhite-MODEL.jpg"
            ],
            [
                'name'=>'Casual Shirt',
                "price"=>"1450",
                "description"=>"Classic casual shirts are transforming Fit & Comfort.With the best in class fabrics",
                "category"=>"Shirt",
                "gallery"=>"https://assetscdn1.paytm.com/images/catalog/product/A/AP/APPU-S-POLO-ASSARVI7636579FB361D4/1562996919305_0..jpg"
            ],
            [
                'name'=>'Cap',
                "price"=>"650",
                "description"=>"Gelante Adult Unisex Baseball Hat Cap 100% Cotton Plain Blank Adjustable Size.",
                "category"=>"Cap",
                "gallery"=>"https://i5.walmartimages.com/asr/a23dbc89-1293-4937-a4dd-6f08178d16a3.763c9cfae5723b0fbf7a2fa9fe34af4c.jpeg?odnHeight=784&odnWidth=580&odnBg=FFFFFF"
             ]
        ]);
    }
}
