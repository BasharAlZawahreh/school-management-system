<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\Nationalitie;
use App\Models\Religion;
use App\Models\Specialization;
use App\Models\Type_Blood;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            NationalitiesSeeder::class,
        ]);

        User::factory()->create([
            'email' => 'a@a.com',
            'password' => '$2a$12$kk/1p/TlzK3D.0ybVGX5xOhxSWE0JWOfWMixSQgOiIQ85p/VtsXO6'
        ]);

        $bgs = ['O-', 'O+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
        foreach ($bgs as $bg) {

            Type_Blood::create([
                'name' => $bg
            ]);
        }

        $genders = [
            ['en'=> 'Male', 'ar'=> 'ذكر'],
            ['en'=> 'Female', 'ar'=> 'انثي'],

        ];
        foreach ($genders as $ge) {
            Gender::create(['name' => $ge]);
        }

        $specializations = [
            ['en'=> 'Arabic', 'ar'=> 'عربي'],
            ['en'=> 'Sciences', 'ar'=> 'علوم'],
            ['en'=> 'Computer', 'ar'=> 'حاسب الي'],
            ['en'=> 'English', 'ar'=> 'انجليزي'],
        ];
        foreach ($specializations as $S) {
            Specialization::create(['Name' => $S]);
        }

        $religions = [

            [
                'en'=> 'Muslim',
                'ar'=> 'مسلم'
            ],
            [
                'en'=> 'Christian',
                'ar'=> 'مسيحي'
            ],
            [
                'en'=> 'Other',
                'ar'=> 'غيرذلك'
            ],

        ];

        foreach ($religions as $R) {
            Religion::create(['name' => $R]);
        }
    }
}
