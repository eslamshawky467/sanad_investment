<?php

namespace Database\Seeders;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationaltiesSeeder extends Seeder
{
    public function run()
    {
DB::table('countries')->delete();
$nationals = [
    [
        'name_en'=> 'Qatar',
        'name_ar'=> 'قطري'
    ],
[

'name_en'=> 'Albanian',
'name_ar'=> 'ألباني'
],
    [
        'name_en'=> 'Afghan',
        'name_ar'=> 'أفغانستاني'
    ],
[

'name_en'=> 'Algerian',
'name_ar'=> 'جزائري'
],

[

'name_en'=> 'Andorran',
'name_ar'=> 'أندوري'
],
[

'name_en'=> 'Angolan',
'name_ar'=> 'أنقولي'
],
[

'name_en'=> 'argentina',
'name_ar'=> 'أرجنتيني'
],
[

'name_en'=> 'armenia',
'name_ar'=> 'أرميني'
],

[

'name_en'=> 'Australian',
'name_ar'=> 'أسترالي'
],
[

'name_en'=> 'Austrian',
'name_ar'=> 'نمساوي'
],
[

'name_en'=> 'Azerbaijani',
'name_ar'=> 'أذربيجاني'
],
[

'name_en'=> 'Bahraini',
'name_ar'=> 'بحريني'
],
[

'name_en'=> 'Russian',
'name_ar'=> 'روسي'
],
[

'name_en'=> 'Belgian',
'name_ar'=> 'بلجيكي'
],


[

'name_en'=> 'Bolivian',
'name_ar'=> 'بوليفي'
],

[
'name_en'=> 'Botswanan',
'name_ar'=> 'بوتسواني'
],
[
'name_en'=> 'Bouvetian',
'name_ar'=> 'بوفيهي'
],
[
'name_en'=> 'Brazilian',
'name_ar'=> 'برازيلي'
],

[

'name_en'=> 'Bruneian',
'name_ar'=> 'بروني'
],


[

'name_en'=> 'Cameroonian',
'name_ar'=> 'كاميروني'
],
[

'name_en'=> 'Canadian',
'name_ar'=> 'كندي'
],


[

'name_en'=> 'Chadian',
'name_ar'=> 'تشادي'
],
[

'name_en'=> 'Chilean',
'name_ar'=> 'شيلي'
],
[

'name_en'=> 'Chinese',
'name_ar'=> 'صيني'
],


[

'name_en'=> 'Colombian',
'name_ar'=> 'كولومبي'
],
[

'name_en'=> 'Comorian',
'name_ar'=> 'جزر القمر'
],


[

'name_en'=> 'Costa Rican',
'name_ar'=> 'كوستاريكي'
],
[

'name_en'=> 'Croatian',
'name_ar'=> 'كوراتي'
],
[

'name_en'=> 'Cuban',
'name_ar'=> 'كوبي'
],
[

'name_en'=> 'Cyprus',
'name_ar'=> 'قبرصي'
],
[

'name_en'=> 'Czech',
'name_ar'=> 'تشيكي'
],
[
'name_en'=> 'Danish',
'name_ar'=> 'دنماركي'
],
[

'name_en'=> 'Ecuadorian',
'name_ar'=> 'إكوادوري'
],
[

'name_en'=> 'Egyptian',
'name_ar'=> 'مصري'
],

[

'name_en'=> 'Ethiopian',
'name_ar'=> 'أثيوبي'
],

[

'name_en'=> 'Finland',
'name_ar'=> 'فنلندي'
],
[

'name_en'=> 'France',
'name_ar'=> 'فرنسي'
],


[

'name_en'=> 'Gabonese',
'name_ar'=> 'غابوني'
],
[

'name_en'=> 'Gambian',
'name_ar'=> 'غامبي'
],
[

'name_en'=> 'Georgian',
'name_ar'=> 'جيورجي'
],
[

'name_en'=> 'German',
'name_ar'=> 'ألماني'
],
[

'name_en'=> 'Ghanaian',
'name_ar'=> 'غاني'
],
[
'name_en'=> 'Greek',
'name_ar'=> 'يوناني'
],
[
'name_en'=> 'Guatemalan',
'name_ar'=> 'غواتيمالي'
],
[

'name_en'=> 'Guinean',
'name_ar'=> 'غيني'
],


[

'name_en'=> 'Haitian',
'name_ar'=> 'هايتي'
],

[

'name_en'=> 'Honduras',
'name_ar'=> 'هندوراسي'
],


[

'name_en'=> 'Icelandic',
'name_ar'=> 'آيسلندي'
],
[

'name_en'=> 'Indian',
'name_ar'=> 'هندي'
],

[

'name_en'=> 'Indonesian',
'name_ar'=> 'أندونيسيي'
],
[

'name_en'=> 'Iranian',
'name_ar'=> 'إيراني'
],
[

'name_en'=> 'Iraqi',
'name_ar'=> 'عراقي'
],
[

'name_en'=> 'Irish',
'name_ar'=> 'إيرلندي'
],
[

'name_en'=> 'Italian',
'name_ar'=> 'إيطالي'
],


[

'name_en'=> 'Jamaican',
'name_ar'=> 'جمايكي'
],
[

'name_en'=> 'Japanese',
'name_ar'=> 'ياباني'
],
[

'name_en'=> 'Jordanian',
'name_ar'=> 'أردني'
],


[

'name_en'=> 'North Korean',
'name_ar'=> 'كوري'
],
[

'name_en'=> 'South Korean',
'name_ar'=> 'كوري'
],

[

'name_en'=> 'Kuwait',
'name_ar'=> 'كويتي'
],


[

'name_en'=> 'Latvian',
'name_ar'=> 'لاتيفي'
],
[

'name_en'=> 'Lebanese',
'name_ar'=> 'لبناني'
],

[

'name_en'=> 'Liberian',
'name_ar'=> 'ليبيري'
],
[

'name_en'=> 'Libyan',
'name_ar'=> 'ليبي'
],

[

'name_en'=> 'Lithuanian',
'name_ar'=> 'لتوانيي'
],
[

'name_en'=> 'Luxembourger',
'name_ar'=> 'لوكسمبورغي'
],


[

'name_en'=> 'Macedonian',
'name_ar'=> 'مقدوني'
],
[

'name_en'=> 'Malagasy',
'name_ar'=> 'مدغشقري'
],
[

'name_en'=> 'Malawian',
'name_ar'=> 'مالاوي'
],
[

'name_en'=> 'Malaysian',
'name_ar'=> 'ماليزي'
],
[

'name_en'=> 'Maldivian',
'name_ar'=> 'مالديفي'
],
[

'name_en'=> 'Malian',
'name_ar'=> 'مالي'
],



[

'name_en'=> 'Mauritanian',
'name_ar'=> 'موريتانيي'
],
[

'name_en'=> 'Mexican',
'name_ar'=> 'مكسيكي'
],






[

'name_en'=> 'Moroccan',
'name_ar'=> 'مغربي'
],
[

'name_en'=> 'Mozambican',
'name_ar'=> 'موزمبيقي'
],

[

'name_en'=> 'Namibian',
'name_ar'=> 'ناميبي'
],



[

'name_en'=> 'Netherlands',
'name_ar'=> 'هولندي'
],

[

'name_en'=> 'New Zeland',
'name_ar'=> 'نيوزيلندي'
],

[

'name_en'=> 'Nigerian',
'name_ar'=> 'نيجيري'
],


[

'name_en'=> 'Norway',
'name_ar'=> 'نرويجي'
],
[

'name_en'=> 'Omani',
'name_ar'=> 'عماني'
],
[

'name_en'=> 'Pakistani',
'name_ar'=> 'باكستاني'
],

[

'name_en'=> 'Palestinian',
'name_ar'=> 'فلسطيني'
],

[

'name_en'=> 'Parguay',
'name_ar'=> 'بارجواي'
],
[

'name_en'=> 'Peruvian',
'name_ar'=> 'بيرو'
],
[

'name_en'=> 'Filipino',
'name_ar'=> 'فلبيني'
],

[

'name_en'=> 'Polish',
'name_ar'=> 'بوليني'
],
[

'name_en'=> 'Portuguese',
'name_ar'=> 'برتغالي'
],


[

'name_en'=> 'Romanian',
'name_ar'=> 'روماني'
],
[

'name_en'=> 'Russian',
'name_ar'=> 'روسي'
],
[

'name_en'=> 'Rwandan',
'name_ar'=> 'رواندا'
],
[

'name_en'=> 'Saudi name_arabian',
'name_ar'=> 'سعودي'
],
[

'name_en'=> 'Senegal',
'name_ar'=> 'سنغالي'
],
[

'name_en'=> 'Serbian',
'name_ar'=> 'صربي'
],

[
'name_en'=> 'Sierra Leonean',
'name_ar'=> 'سيراليوني'
],
[

'name_en'=> 'Singaporean',
'name_ar'=> 'سنغافوري'
],
[

'name_en'=> 'Slovak',
'name_ar'=> 'سولفاكي'
],
[

'name_en'=> 'Slovenia',
'name_ar'=> 'سولفيني'
],

[

'name_en'=> 'Somali',
'name_ar'=> 'صومالي'
],
[

'name_en'=> 'South African',
'name_ar'=> 'أفريقي'
],

[

'name_en'=> 'South Sudanese',
'name_ar'=> 'سوادني جنوبي'
],
[

'name_en'=> 'Spanish',
'name_ar'=> 'إسباني'
],

[

'name_en'=> 'Sudanese',
'name_ar'=> 'سوداني'
],


[

'name_en'=> 'Swedish',
'name_ar'=> 'سويدي'
],
[

'name_en'=> 'Swiss',
'name_ar'=> 'سويسري'
],
[

'name_en'=> 'Syrian',
'name_ar'=> 'سوري'
],


[

'name_en'=> 'Tanzanian',
'name_ar'=> 'تنزانيي'
],
[

'name_en'=> 'Thai',
'name_ar'=> 'تايلندي'
],

[

'name_en'=> 'Togolese',
'name_ar'=> 'توغي'
],



[

'name_en'=> 'Tunisian',
'name_ar'=> 'تونسي'
],
[

'name_en'=> 'Turkish',
'name_ar'=> 'تركي'
],



[

'name_en'=> 'Ugandan',
'name_ar'=> 'أوغندي'
],
[

'name_en'=> 'Ukrainian',
'name_ar'=> 'أوكراني'
],
[

'name_en'=> 'UAE',
'name_ar'=> 'إماراتي'
],
[

'name_en'=> 'British',
'name_ar'=> 'بريطاني'
],
[

'name_en'=> 'American',
'name_ar'=> 'أمريكي'
],

[
'name_en'=> 'Uruguay',
'name_ar'=> 'أورغواي'
],
[

'name_en'=> 'Uzbek',
'name_ar'=> 'أوزباكستاني'
],
[
'name_en'=> 'Venzuela',
'name_ar'=> 'فنزويلي'
],
[

'name_en'=> 'Vietnamese',
'name_ar'=> 'فيتنامي'
],
[
'name_en'=> 'Vatican',
'name_ar'=> 'فاتيكاني'
],
[
'name_en'=> 'Yemen',
'name_ar'=> 'يمني'
],
];
foreach ($nationals as $key => $value){
Country::create($value);
}
}
}
