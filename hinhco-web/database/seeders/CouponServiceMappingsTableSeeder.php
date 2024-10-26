<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponServiceMappingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupon_service_mappings')->delete();

        DB::table('coupon_service_mappings')->insert([
            [
                'id' => 1,
                'coupon_id' => 1,
                'service_id' => 101, // Chụp ảnh sản phẩm
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'coupon_id' => 1,
                'service_id' => 102, // Chụp ảnh kỷ yếu
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}