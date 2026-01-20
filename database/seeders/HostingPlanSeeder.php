<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HostingPlan;

class HostingPlanSeeder extends Seeder
{
    public function run()
    {
        // Silver Plan
        HostingPlan::create([
            'key' => 'silver',
            'name' => [
                'en' => 'Silver',
                'ar' => 'الفضى',
            ],
            'price' => '200',
            'currency' => [
                'en' => 'RS',
                'ar' => 'ر.س',
            ],
            'features' => [
                'space' => ['en' => '10 GB', 'ar' => '10 جيجا'],
                'traffic' => ['en' => '100 GB', 'ar' => '100 جيجا'],
                'support' => ['en' => '24 Hours', 'ar' => '24 ساعة'],
                'databases' => ['en' => 'Unlimited Databases', 'ar' => 'عدد لا نهائي من قواعد البيانات'],
                'subdomains' => ['en' => 'Unlimited Subdomains', 'ar' => 'عدد لا نهائي من النطاقات الفرعية'],
                'emails' => ['en' => 'Unlimited Email Accounts', 'ar' => 'عدد لا نهائي من حسابات البريد'],
                'ftp' => ['en' => 'Unlimited FTP', 'ar' => 'عدد لا نهائي من اف تي بي'],
                'custom_design' => false,
            ],
        ]);

        // Gold Plan
        HostingPlan::create([
            'key' => 'gold',
            'name' => [
                'en' => 'Gold',
                'ar' => 'الذهبى',
            ],
            'price' => '350',
            'currency' => [
                'en' => 'RS',
                'ar' => 'ر.س',
            ],
            'features' => [
                'space' => ['en' => '10 GB', 'ar' => '10 جيجا'],
                'traffic' => ['en' => '100 GB', 'ar' => '100 جيجا'],
                'support' => ['en' => '24 Hours', 'ar' => '24 ساعة'],
                'databases' => ['en' => 'Unlimited Databases', 'ar' => 'عدد لا نهائي من قواعد البيانات'],
                'subdomains' => ['en' => 'Unlimited Subdomains', 'ar' => 'عدد لا نهائي من النطاقات الفرعية'],
                'emails' => ['en' => 'Unlimited Email Accounts', 'ar' => 'عدد لا نهائي من حسابات البريد'],
                'ftp' => ['en' => 'Unlimited FTP', 'ar' => 'عدد لا نهائي من اف تي بي'],
                'custom_design' => false,
            ],
        ]);

        // Premium Plan
        HostingPlan::create([
            'key' => 'premium',
            'name' => [
                'en' => 'Premium',
                'ar' => 'المميز',
            ],
            'price' => '400',
            'currency' => [
                'en' => 'RS',
                'ar' => 'ر.س',
            ],
            'features' => [
                'space' => ['en' => '10 GB', 'ar' => '10 جيجا'],
                'traffic' => ['en' => '100 GB', 'ar' => '100 جيجا'],
                'support' => ['en' => '24 Hours', 'ar' => '24 ساعة'],
                'free_domain' => ['en' => 'Gift', 'ar' => 'هدية'],
                'databases' => ['en' => 'Unlimited Databases', 'ar' => 'عدد لا نهائي من قواعد البيانات'],
                'subdomains' => ['en' => 'Unlimited Subdomains', 'ar' => 'عدد لا نهائي من النطاقات الفرعية'],
                'emails' => ['en' => 'Unlimited Email Accounts', 'ar' => 'عدد لا نهائي من حسابات البريد'],
                'ftp' => ['en' => 'Unlimited FTP', 'ar' => 'عدد لا نهائي من اف تي بي'],
                'custom_design' => ['en' => 'Custom Design for Your Site', 'ar' => 'تصميم خاص بموقعك'],
            ],
        ]);
    }
}
