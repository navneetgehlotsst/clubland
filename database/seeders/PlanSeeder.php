<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plan = [
            [
                'name'=> 'Business Plan',
                'slug'=> 'business-plan',
                'stripe_plan' => 'prod_MTgCImnCfvdX7q',
                'price' => '10',
                'description' => 'Business Plan'
            ],
            [
                'name'=> 'Premium',
                'slug'=> 'premium-plan',
                'stripe_plan' => 'prod_MTgCImnCfvdX7q',
                'price' => '20',
                'description' => 'Premium Plan'
            ],
        ];
        foreach ($plan as $val){
            Plan::create($val);
        }
    }
}
