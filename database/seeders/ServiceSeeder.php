<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        // Service 1: Programming
        Service::create([
            'title' => [
                'en' => 'Programming Services',
                'ar' => 'خدمات البرمجة',
            ],
            'description' => [
                'en' => 'Tatwerat has a professional team of programmers, we are ready to create and develop web software in the fastest time and highest accuracy using the latest programming technologies',
                'ar' => 'تطويرات لديها فريق مبرمجين محترف , نحن جاهزين لإنشاء وتطوير برمجيات الويب في اسرع وقت واعلي دقه وبإستخدام احدث التقنيات البرمجية',
            ],
            'icon_class' => 'how_share',
            'order' => 1,
            'is_active' => true,
        ]);

        // Service 2: Design
        Service::create([
            'title' => [
                'en' => 'Design Services',
                'ar' => 'خدمات التصميم',
            ],
            'description' => [
                'en' => 'Design is a key factor in the success of any website, you can rely on us at Tatwerat to design your website to be compatible with all screen sizes and mobile devices.',
                'ar' => 'التصميم هو عامل اساسي فى نجاح اي موقع ,يمكنك الاعتماد علينا فى تطويرات لتصميم موقعك ليكون متوافق مع كافة مقاسات الشاشات والموبايل .',
            ],
            'icon_class' => 'how_win',
            'order' => 2,
            'is_active' => true,
        ]);

        // Service 3: Hosting
        Service::create([
            'title' => [
                'en' => 'Tatwerat Hosting',
                'ar' => 'استضافة تطويرات',
            ],
            'description' => [
                'en' => 'We appreciate the size of your business and help you reach the top with your website, our support team is at your service throughout the week, 24 hours a day',
                'ar' => 'نحن نقدر حجم اعمالك ونساعدك على الوصول بموقعك الى القمه , فريق الدعم فى خدمتك طوال ايام الاسبوع وعلى مدار 24 ساعه يومياً',
            ],
            'icon_class' => 'how_adv',
            'order' => 3,
            'is_active' => true,
        ]);
    }
}
