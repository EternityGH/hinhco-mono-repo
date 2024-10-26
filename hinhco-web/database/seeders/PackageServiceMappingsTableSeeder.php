<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageServiceMappingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('package_service_mappings')->delete();

        $mappings = [
            [
                'created_at' => now(),
                'id' => 11,
                'service_id' => 101, // Chụp ảnh ngoài trời
                'service_package_id' => 1,
                'updated_at' => now(),
            ],
            [
                'created_at' => now(),
                'id' => 12,
                'service_id' => 102, // Chụp ảnh kỷ yếu
                'service_package_id' => 1,
                'updated_at' => now(),
            ],
            [
                'created_at' => now(),
                'id' => 13,
                'service_id' => 103, // Chụp ảnh dã ngoại cá nhân
                'service_package_id' => 3,
                'updated_at' => now(),
            ],
            [
                'created_at' => now(),
                'id' => 14,
                'service_id' => 104, // Chụp ảnh dã ngoại nhóm
                'service_package_id' => 3,
                'updated_at' => now(),
            ],
        ];

        foreach ($mappings as $mapping) {
            // Kiểm tra tồn tại của service_id và service_package_id trước khi chèn
            $serviceExists = DB::table('services')->where('id', $mapping['service_id'])->exists();
            $packageExists = DB::table('service_packages')->where('id', $mapping['service_package_id'])->exists();

            if ($serviceExists && $packageExists) {
                DB::table('package_service_mappings')->insert($mapping);
            } else {
                // Ghi log hoặc cảnh báo nếu cần thiết
                \Log::warning("Service ID {$mapping['service_id']} hoặc Package ID {$mapping['service_package_id']} không tồn tại.");
            }
        }
    }
}