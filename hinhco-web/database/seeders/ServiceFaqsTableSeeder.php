<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceFaqsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_faqs')->delete();

        DB::table('service_faqs')->insert([
            [
                'created_at' => '2024-01-31 11:58:45',
                'description' => 'Thời điểm tốt nhất để có những bức ảnh sản phẩm đẹp là khi ánh sáng tự nhiên đầy đủ và phù hợp với sản phẩm.',
                'id' => 1,
                'service_id' => 101,  // Chụp ảnh sản phẩm
                'status' => 1,
                'title' => 'Thời điểm nào phù hợp để chụp ảnh sản phẩm?',
                'updated_at' => '2024-01-31 11:58:45',
            ],
            [
                'created_at' => '2024-01-31 12:00:52',
                'description' => 'Dịch vụ chụp ảnh kỷ yếu của chúng tôi mang đến những bức ảnh chuyên nghiệp, lưu giữ khoảnh khắc đáng nhớ cùng bạn bè.',
                'id' => 2,
                'service_id' => 102,  // Chụp ảnh kỷ yếu
                'status' => 1,
                'title' => 'Dịch vụ chụp ảnh kỷ yếu có những ưu điểm gì?',
                'updated_at' => '2024-01-31 12:00:52',
            ],
        ]);
    }
}