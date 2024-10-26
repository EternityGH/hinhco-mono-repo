<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Models\Service;
use App\Models\ProviderServiceAddressMapping;

class ServicesTableSeeder extends Seeder
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
                'added_by' => 1,
                'advance_payment_amount' => NULL,
                'category_id' => 1,
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'Dịch vụ chụp ảnh sản phẩm với tối đa 45 phút.',
                'discount' => 0.0,
                'duration' => '00:45',
                'id' => 101,
                'is_enable_advance_payment' => 0,
                'is_featured' => 1,
                'is_slot' => 0,
                'name' => 'Chụp ảnh sản phẩm',
                'price' => 1500000,
                'provider_id' => 49,
                'service_type' => 'service',
                'status' => 1,
                'service_attachment' => public_path('/images/category-images/photography.png'),
                'subcategory_id' => 1,
                'type' => 'fixed',
                'updated_at' => now(),
            ],
            [
                'added_by' => 1,
                'advance_payment_amount' => NULL,
                'category_id' => 1,
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'Dịch vụ chụp ảnh kỷ yếu với tối đa 45 phút.',
                'discount' => 0.0,
                'duration' => '00:45',
                'id' => 102,
                'is_enable_advance_payment' => 0,
                'is_featured' => 1,
                'is_slot' => 0,
                'name' => 'Chụp ảnh kỷ yếu',
                'price' => 2000000,
                'provider_id' => 49,
                'service_type' => 'service',
                'status' => 1,
                'service_attachment' => public_path('/images/category-images/photography.png'),
                'subcategory_id' => 2,
                'type' => 'fixed',
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $key => $val) {
            $featureImage = $val['service_attachment'] ?? null;
            $serviceData = Arr::except($val, ['provider_address_mapping', 'service_attachment']);
            $service = Service::create($serviceData);
            if (isset($featureImage)) {
                $this->attachFeatureImage($service, $featureImage);
            }

            if (isset($val['provider_address_mapping'])) {
                $addresses = $val['provider_address_mapping'];
                foreach ($addresses as $addressData) {
                    $address = new ProviderServiceAddressMapping($addressData);
                    $address->save();
                }
            }
        }
    }
    private function attachFeatureImage($model, $publicPath)
    {

        $file = new \Illuminate\Http\File($publicPath);

        $media = $model->addMedia($file)->preservingOriginal()->toMediaCollection('service_attachment');

        return $media;

    }
}