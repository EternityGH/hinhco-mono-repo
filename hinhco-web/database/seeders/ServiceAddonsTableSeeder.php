<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Models\ServiceAddon;

class ServiceAddonsTableSeeder extends Seeder
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
                'id' => 1,
                'name' => 'Thay phông nền',
                'service_id' => 101,
                'price' => 20000,
                'qty' => 1,
                'status' => 1,
                'serviceaddon_image' => public_path('/images/category-images/photography.png'),
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Chỉnh màu / Ánh sáng',
                'service_id' => 101,
                'price' => 20000,
                'qty' => 1,
                'status' => 1,
                'serviceaddon_image' => public_path('/images/category-images/photography.png'),
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
            ],
        ];

        foreach ($data as $key => $val) {
            $featureImage = $val['serviceaddon_image'] ?? null;
            $serviceaddonData = Arr::except($val, ['serviceaddon_image']);
            $serviceaddon = ServiceAddon::create($serviceaddonData);
            if (isset($featureImage)) {
                $this->attachFeatureImage($serviceaddon, $featureImage);
            }
        }
    }

    private function attachFeatureImage($model, $publicPath)
    {
        $file = new \Illuminate\Http\File($publicPath);
        $media = $model->addMedia($file)->preservingOriginal()->toMediaCollection('serviceaddon_image');
        return $media;
    }
}