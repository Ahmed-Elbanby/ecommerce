<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nations = [
            ['name' => 'China', 'arabic_name' => 'الصين'],
            ['name' => 'India', 'arabic_name' => 'الهند'],
            ['name' => 'United States', 'arabic_name' => 'الولايات المتحدة'],
            ['name' => 'Indonesia', 'arabic_name' => 'إندونيسيا'],
            ['name' => 'Pakistan', 'arabic_name' => 'باكستان'],
            ['name' => 'Brazil', 'arabic_name' => 'البرازيل'],
            ['name' => 'Nigeria', 'arabic_name' => 'نيجيريا'],
            ['name' => 'Bangladesh', 'arabic_name' => 'بنغلاديش'],
            ['name' => 'Russia', 'arabic_name' => 'روسيا'],
            ['name' => 'Mexico', 'arabic_name' => 'المكسيك'],
            ['name' => 'Japan', 'arabic_name' => 'اليابان'],
            ['name' => 'Ethiopia', 'arabic_name' => 'إثيوبيا'],
            ['name' => 'Philippines', 'arabic_name' => 'الفلبين'],
            ['name' => 'Egypt', 'arabic_name' => 'مصر'],
            ['name' => 'Vietnam', 'arabic_name' => 'فيتنام'],
            ['name' => 'DR Congo', 'arabic_name' => 'جمهورية الكونغو الديمقراطية'],
            ['name' => 'Turkey', 'arabic_name' => 'تركيا'],
            ['name' => 'Iran', 'arabic_name' => 'إيران'],
            ['name' => 'Germany', 'arabic_name' => 'ألمانيا'],
            ['name' => 'Thailand', 'arabic_name' => 'تايلاند'],
            ['name' => 'United Kingdom', 'arabic_name' => 'المملكة المتحدة'],
            ['name' => 'France', 'arabic_name' => 'فرنسا'],
            ['name' => 'Italy', 'arabic_name' => 'إيطاليا'],
            ['name' => 'South Africa', 'arabic_name' => 'جنوب أفريقيا'],
            ['name' => 'Tanzania', 'arabic_name' => 'تنزانيا'],
            ['name' => 'Myanmar', 'arabic_name' => 'ميانمار'],
            ['name' => 'Kenya', 'arabic_name' => 'كينيا'],
            ['name' => 'South Korea', 'arabic_name' => 'كوريا الجنوبية'],
            ['name' => 'Colombia', 'arabic_name' => 'كولومبيا'],
            ['name' => 'Spain', 'arabic_name' => 'إسبانيا'],
            ['name' => 'Argentina', 'arabic_name' => 'الأرجنتين'],
            ['name' => 'Uganda', 'arabic_name' => 'أوغندا'],
            ['name' => 'Ukraine', 'arabic_name' => 'أوكرانيا'],
            ['name' => 'Algeria', 'arabic_name' => 'الجزائر'],
            ['name' => 'Sudan', 'arabic_name' => 'السودان'],
            ['name' => 'Iraq', 'arabic_name' => 'العراق'],
            ['name' => 'Poland', 'arabic_name' => 'بولندا'],
            ['name' => 'Canada', 'arabic_name' => 'كندا'],
            ['name' => 'Morocco', 'arabic_name' => 'المغرب'],
            ['name' => 'Afghanistan', 'arabic_name' => 'أفغانستان'],
            ['name' => 'Saudi Arabia', 'arabic_name' => 'المملكة العربية السعودية'],
            ['name' => 'Peru', 'arabic_name' => 'بيرو'],
            ['name' => 'Venezuela', 'arabic_name' => 'فنزويلا'],
            ['name' => 'Malaysia', 'arabic_name' => 'ماليزيا'],
            ['name' => 'Uzbekistan', 'arabic_name' => 'أوزبكستان'],
            ['name' => 'Nepal', 'arabic_name' => 'نيبال'],
            ['name' => 'Mozambique', 'arabic_name' => 'موزمبيق'],
            ['name' => 'Ghana', 'arabic_name' => 'غانا'],
            ['name' => 'Yemen', 'arabic_name' => 'اليمن'],
        ];

        DB::table('nationalities')->insert($nations);
    }
}
