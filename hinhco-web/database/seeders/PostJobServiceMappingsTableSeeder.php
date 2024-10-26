<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostJobServiceMappingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_job_service_mappings')->delete();

        DB::table('post_job_service_mappings')->insert(array(
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'id' => 1,
                'post_request_id' => 1,
                'service_id' => 101, // Chụp ảnh sản phẩm
                'updated_at' => now(),
            ],
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'id' => 2,
                'post_request_id' => 2,
                'service_id' => 102, // Chụp ảnh kỷ yếu
                'updated_at' => now(),
            ],
        ));
    }
}