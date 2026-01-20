<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactMethod;

class ContactMethodSeeder extends Seeder
{
    public function run()
    {
        // 1. Phone
        ContactMethod::create([
            'title' => [
                'en' => 'Phone',
                'ar' => 'الهاتف',
            ],
            'content' => [
                'en' => '+002 01011606782',
                'ar' => '+002 01011606782',
            ],
            'icon_class' => 'how_share', // Reusing existing classes for now
            'order' => 1,
            'is_active' => true,
        ]);

        // 2. Email
        ContactMethod::create([
            'title' => [
                'en' => 'Email',
                'ar' => 'البريد الإلكتروني',
            ],
            'content' => [
                'en' => 'sales@tatwerat.com',
                'ar' => 'sales@tatwerat.com',
            ],
            'icon_class' => 'how_win',
            'order' => 2,
            'is_active' => true,
        ]);

        // 3. Address/Location
        ContactMethod::create([
            'title' => [
                'en' => 'Address',
                'ar' => 'العنوان',
            ],
            'content' => [
                'en' => 'Cairo, Egypt',
                'ar' => 'القاهرة، مصر',
            ],
            'icon_class' => 'how_adv',
            'order' => 3,
            'is_active' => true,
        ]);
    }
}
