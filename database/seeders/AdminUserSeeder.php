<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\HeaderLink;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        // Create default header links
        $defaultLinks = [
            [
                'label_ar' => 'الاستضافة',
                'label_en' => 'Hosting',
                'url' => '#',
                'order' => 1,
            ],
            [
                'label_ar' => 'الريسيلرات',
                'label_en' => 'Resellers',
                'url' => '#',
                'order' => 2,
            ],
            [
                'label_ar' => 'السيرفرات',
                'label_en' => 'Servers',
                'url' => '#',
                'order' => 3,
            ],
            [
                'label_ar' => 'عروض ال VPS',
                'label_en' => 'VPS Offers',
                'url' => '#',
                'order' => 4,
            ],
            [
                'label_ar' => 'البرمجة',
                'label_en' => 'Programming',
                'url' => '#',
                'order' => 5,
            ],
            [
                'label_ar' => 'التصميم',
                'label_en' => 'Design',
                'url' => '#',
                'order' => 6,
            ],
            [
                'label_ar' => 'الدعم الفني',
                'label_en' => 'Technical Support',
                'url' => '#',
                'order' => 7,
            ],
            [
                'label_ar' => 'إتصل بنا',
                'label_en' => 'Contact Us',
                'url' => '#',
                'order' => 8,
            ],
        ];

        foreach ($defaultLinks as $link) {
            HeaderLink::firstOrCreate(
                ['url' => $link['url'], 'label_en' => $link['label_en']], // Check by URL and English label
                $link
            );
        }
    }
}
