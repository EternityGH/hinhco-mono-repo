<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'color' => '#FF5733',
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'Các dịch vụ chụp ảnh chuyên nghiệp đa dạng.',
                'id' => 1,
                'is_featured' => 1,
                'name' => 'Chụp ảnh',
                'status' => 1,
                'category_image' => public_path('/images/category-images/photography.png'),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $val) {
            $featureImage = $val['category_image'] ?? null;
            $categoryData = Arr::except($val, ['category_image']);
            $category = Category::create($categoryData);
            if ($featureImage) {
                $this->attachFeatureImage($category, $featureImage);
            }
        }
    }

    private function attachFeatureImage($model, $publicPath)
    {
        $file = new \Illuminate\Http\File($publicPath);
        $model->addMedia($file)->preservingOriginal()->toMediaCollection('category_image');
    }
}