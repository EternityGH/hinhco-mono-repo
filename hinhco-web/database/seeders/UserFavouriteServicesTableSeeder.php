<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserFavouriteServicesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_favourite_services')->delete();

        DB::table('user_favourite_services')->insert([
            [
                'id' => 1,
                'service_id' => 101, // Chụp ảnh sản phẩm
                'user_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-02-05 04:10:14',
                'updated_at' => '2024-02-05 04:10:14',
            ],
            [
                'id' => 2,
                'service_id' => 102, // Chụp ảnh kỷ yếu
                'user_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-02-05 04:12:50',
                'updated_at' => '2024-02-05 04:12:50',
            ],
            [
                'id' => 3,
                'service_id' => 101, // Chụp ảnh sản phẩm (người dùng ưa thích lại)
                'user_id' => 37,
                'deleted_at' => NULL,
                'created_at' => '2024-02-05 04:15:10',
                'updated_at' => '2024-02-05 04:15:10',
            ],
            [
                'id' => 4,
                'service_id' => 102, // Chụp ảnh kỷ yếu (người dùng khác ưa thích)
                'user_id' => 37,
                'deleted_at' => NULL,
                'created_at' => '2024-02-05 04:15:31',
                'updated_at' => '2024-02-05 04:15:31',
            ],
        ]);
    }
}