<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Models\SubCategory;

class SubCategoriesTableSeeder extends Seeder
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
                'deleted_at' => NULL,
                'description' => 'Dịch vụ chụp ảnh sản phẩm chuyên nghiệp.',
                'id' => 1,
                'is_featured' => 1,
                'name' => 'Chụp hình sản phẩm',
                'status' => 1,
                'subcategory_image' => public_path('/images/category-images/photography.png'),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'Dịch vụ chụp ảnh kỷ yếu lưu giữ kỷ niệm.',
                'id' => 2,
                'is_featured' => 1,
                'name' => 'Chụp hình kỷ yếu',
                'status' => 1,
                'subcategory_image' => public_path('/images/category-images/photography.png'),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'Dịch vụ chụp ảnh dã ngoại cho cá nhân.',
                'id' => 3,
                'is_featured' => 1,
                'name' => 'Chụp hình dã ngoại cá nhân',
                'status' => 1,
                'subcategory_image' => public_path('/images/category-images/photography.png'),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'Dịch vụ chụp ảnh dã ngoại cho nhóm.',
                'id' => 4,
                'is_featured' => 1,
                'name' => 'Chụp hình dã ngoại nhóm',
                'status' => 1,
                'subcategory_image' => public_path('/images/category-images/photography.png'),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $key => $val) {
            $featureImage = $val['subcategory_image'] ?? null;
            $subCategoryData = Arr::except($val, ['subcategory_image']);
            $sub_category = SubCategory::create($subCategoryData);
            if (isset($featureImage)) {
                $this->attachFeatureImage($sub_category, $featureImage);
            }
        }
    }

    private function attachFeatureImage($model, $publicPath)
    {
        $file = new \Illuminate\Http\File($publicPath);
        $media = $model->addMedia($file)->preservingOriginal()->toMediaCollection('subcategory_image');
        return $media;
    }
}