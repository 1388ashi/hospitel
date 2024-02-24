<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'label' => 'شماره تلفن',
                'name' => 'phone',
                'type' => 'number',                
                'value' => '0911317892',
                'group' => 'social',
                'created_at' => now(),
                'updated_at' => now()
                ] ,
            [

                'label' => 'توضیحات',
                'name' => 'description',
                'type' => 'textarea',                
                'value' => 'none',
                'group' => 'social',
                'created_at' => now(),
                'updated_at' => now()
                ] ,
            [

                'label' => 'آدرس',
                'name' => 'address',
                'type' => 'text',                
                'value' => 'none',
                'group' => 'general',
                'created_at' => now(),
                'updated_at' => now()
                ] ,
                [
                    
                'label' => 'پروفایل',
                'name' => 'profile',
                'type' => 'file',                
                'value' => 'none',
                'group' => 'social',
                'created_at' => now(),
                'updated_at' => now()
                ] ,
            [
                'label' => 'تلفن پشتیبانی',
                'name' => 'number',
                'type' => 'number',                
                'value' => '0944657899',
                'group' => 'general',
                'created_at' => now(),
                'updated_at' => now()
                ] ,
                [
                'label' => 'لوگو',
                'name' => 'logo',
                'type' => 'file',                
                'value' => 'non',
                'group' => 'general',
                'created_at' => now(),
                'updated_at' => now(),
                ]
            ]);
    }
}
