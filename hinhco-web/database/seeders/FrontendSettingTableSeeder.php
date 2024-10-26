<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FrontendSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonDataSection1 = '{"section_1":1,"title":"Kết nối nhanh chóng đến dịch vụ HÌNH CÓ hoàn hảo","description":"Trải nghiệm sự tiện lợi: Hãy tin tưởng vào dịch vụ booking photographer của chúng tôi. Từ chụp ảnh cá nhân đến sự kiện, chúng tôi luôn sẵn sàng phục vụ bạn. Người bạn đồng hành hoàn hảo cho mọi khoảnh khắc!","current_location":"on","enable_search":"on","enable_post_job":"on","enable_popular_services":"on","category_id":["10","11","12","13"],"enable_popular_provider":"on","provider_id":["4","16","7","13"]}';
        $jsonDataSection2 = '{"section_2":1,"title":"Các Hạng Mục Hàng Đầu","category_id":["9","18","22","23"]}';
        $jsonDataSection3 = '{"section_3":1,"title":"Dịch Vụ Được Đánh Giá Cao","service_id":["35","66","87","85","84","39","40","79"]}';
        $jsonDataSection4 = '{"section_4":1,"title":"Featured Services","service_id":["13","27","35","44","45","53","66","68"]}';
        $jsonDataSection5 = '{"section_5":1,"title":"Nâng Tầm Doanh Thu và Chuyên Môn của Bạn Khi Tham Gia Cùng Chúng Tôi","email":"info@examples.com","contact_number":"+1(000)-235-7894","description":"Nhà cung cấp tận tâm, mang đến dịch vụ vượt trội. Chuyên môn được chứng minh để đảm bảo chất lượng và sự hài lòng của khách hàng. Cùng nhau nâng tầm dự án của bạn."}';
        $jsonDataSection6 = '{"section_6":1,"title":"Nâng Tầm Trải Nghiệm Của Bạn Với Ứng Dụng Của Chúng Tôi","description":"Discover a Range of Photographer Services and Stay Updated on the Latest Offers and Deals by Downloading Our App!"}';
        $jsonDataSection7 = '{"section_7":1,"title":"Giải Pháp Tinh Tế và Dịch Vụ Chuyên Nghiệp, Tinh Gọn Workflow","description":"Quy Trình Tinh Gọn: Lên Kế Hoạch, Thực Hiện, Hợp Tác, Thích Nghi. Tận Dụng Tự Động Hóa, Giao Tiếp và Linh Hoạt Để Đạt Năng Suất Cao Nhất.","url":"https:\/\/www.youtube.com\/watch?v=KswIQq7j_54","subtitle":["Admin To Provider","Provider To Photographer","Photographer To User"],"subdescription":["Admin hỗ trợ bookings của người dùng và phối hợp với providers để đảm bảo dịch vụ được thực hiện thành công.","Provider sắp xếp bookings của người dùng và sau đó liên lạc với photographer để đảm bảo dịch vụ được hoàn thành thành công.","Photographer hoàn thành booking của người dùng"]}';
        $jsonDataSection8 = '{"section_8":1,"title":"Your Recent Views & Beyond","description":"Dependable Photographer Service for Your Repairs, Renovations, and Maintenance. Skillful Professionals, Timely Solutions, and Guaranteed Customer Satisfaction."}';
        $jsonDataSection9 = '{"section_9":1,"title":"Khách Hàng Tin Tưởng Chúng Tôi","overall_rating":"on","description":"Hoàn Hảo Trong Từng Chi Tiết: 99,9% Khách Hàng Hài Lòng, Hơn 500 Đánh Giá và 5,068 Dịch Vụ Thành Công Đã Được Thực Hiện."}';
        $jsonDataFooterSection = '{"footer_setting":1,"enable_popular_category":1,"category_id":["9","26","24","22","25","16"],"enable_popular_service":1,"service_id":["11","12","13","35","66"]}';
        $jsonDataHeaderSection = '{"header_setting":1,"home":1,"service":1,"provider":1,"categories":1,"blogs":1,"bookings":1,"job_post":1,"enable_language":1,"enable_darknight_mode":1}';
        $jsonDataLoginRegisterSection = '{"login_register":1,"title":"Welcome To Our Photographer","description":"Masterful Photographer Services: Fixing, Repairing, and Enhancing Your Space with Expertise, Simplifying Life, One Project at a Time."}';
        \DB::table('frontend_settings')->delete();
        $section1Data = json_decode($jsonDataSection1, true);
        $section2Data = json_decode($jsonDataSection2, true);
        $section3Data = json_decode($jsonDataSection3, true);
        $section4Data = json_decode($jsonDataSection4, true);
        $section5Data = json_decode($jsonDataSection5, true);
        $section6Data = json_decode($jsonDataSection6, true);
        $section7Data = json_decode($jsonDataSection7, true);
        $section8Data = json_decode($jsonDataSection8, true);
        $section9Data = json_decode($jsonDataSection9, true);
        $sectionFooterData = json_decode($jsonDataFooterSection, true);
        $sectionHeaderData = json_decode($jsonDataHeaderSection, true);
        $sectionLoginRegisterData = json_decode($jsonDataLoginRegisterSection, true);
        \DB::table('frontend_settings')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'type' => 'landing-page-setting',
                    'key' => 'section_1',
                    'status' => '1',
                    'value' => json_encode($section1Data),
                ),
            1 =>
                array(
                    'id' => 2,
                    'type' => 'landing-page-setting',
                    'key' => 'section_2',
                    'status' => '1',
                    'value' => json_encode($section2Data),
                ),
            array(
                'id' => 3,
                'type' => 'landing-page-setting',
                'key' => 'section_3',
                'status' => '1',
                'value' => json_encode($section3Data),
            ),
            array(
                'id' => 4,
                'type' => 'landing-page-setting',
                'key' => 'section_4',
                'status' => '1',
                'value' => json_encode($section4Data),
            ),
            array(
                'id' => 5,
                'type' => 'landing-page-setting',
                'key' => 'section_5',
                'status' => '1',
                'value' => json_encode($section5Data),
            ),
            array(
                'id' => 6,
                'type' => 'landing-page-setting',
                'key' => 'section_6',
                'status' => '1',
                'value' => json_encode($section6Data),
            ),
            array(
                'id' => 7,
                'type' => 'landing-page-setting',
                'key' => 'section_7',
                'status' => '1',
                'value' => json_encode($section7Data),
            ),
            array(
                'id' => 8,
                'type' => 'footer-setting',
                'key' => 'footer-setting',
                'status' => '1',
                'value' => json_encode($sectionFooterData),
            ),
            array(
                'id' => 9,
                'type' => 'heder-menu-setting',
                'key' => 'heder-menu-setting',
                'status' => '1',
                'value' => json_encode($sectionHeaderData),
            ),
            array(
                'id' => 10,
                'type' => 'landing-page-setting',
                'key' => 'section_8',
                'status' => '1',
                'value' => json_encode($section8Data),
            ),
            array(
                'id' => 11,
                'type' => 'landing-page-setting',
                'key' => 'section_9',
                'status' => '1',
                'value' => json_encode($section9Data),
            ),
            array(
                'id' => 12,
                'type' => 'login-register-setting',
                'key' => 'login-register-setting',
                'status' => '1',
                'value' => json_encode($sectionLoginRegisterData),
            ),
        ));
    }
}
