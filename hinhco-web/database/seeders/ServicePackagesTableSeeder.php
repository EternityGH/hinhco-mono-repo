<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Models\ServicePackage;

class ServicePackagesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'category_id' => 1,
                'created_at' => now(),
                'description' => 'Gói chụp ảnh sản phẩm cơ bản.',
                'end_at' => '2025-12-31 23:59:59',
                'id' => 1,
                'is_featured' => 1,
                'name' => 'Gói chụp ảnh sản phẩm cơ bản',
                'package_type' => 'single',
                'price' => 1500000,
                'provider_id' => 49,
                'start_at' => now(),
                'status' => 1,
                'package_attachment' => public_path('/images/category-images/photography.png'),
                'subcategory_id' => 1,
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'created_at' => now(),
                'description' => 'Gói chụp ảnh kỷ yếu nhóm.',
                'end_at' => '2025-12-31 23:59:59',
                'id' => 2,
                'is_featured' => 1,
                'name' => 'Gói chụp ảnh kỷ yếu nhóm',
                'package_type' => 'single',
                'price' => 2000000,
                'provider_id' => 49,
                'start_at' => now(),
                'status' => 1,
                'package_attachment' => public_path('/images/category-images/photography.png'),
                'subcategory_id' => 2,
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $key => $val) {
            $featureImage = $val['package_attachment'] ?? null;
            $servicePackageData = Arr::except($val, ['package_attachment']);
            $service_package = ServicePackage::create($servicePackageData);
            if (isset($featureImage)) {
                $this->attachFeatureImage($service_package, $featureImage);
            }
        }
    }

    private function attachFeatureImage($model, $publicPath)
    {
        $file = new \Illuminate\Http\File($publicPath);
        $media = $model->addMedia($file)->preservingOriginal()->toMediaCollection('package_attachment');
        return $media;
    }
}