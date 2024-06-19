<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\JobOffer;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Answer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create(); 
        $it_category=Category::create(['title' => 'IT']);
        $service_category = Category::create(['title' => 'Service']);
        $jurisprudence_category = Category::create(['title' => 'Jurisprudence']);
        Category::create(['title' => 'Transport']);
        Category::create(['title' => 'Marketing']);

        $user = User::role('Employer')->get()->first();
        $user_employee = User::role('Employee')->get()->first();

        $job_offer = JobOffer::factory()->for($service_category)->for($user)->count(4)->create();
        $job_offer1 = JobOffer::factory()->for($it_category)->for($user)->count(4)->create();
        JobOffer::factory()->for($jurisprudence_category)->for($user)->count(1)->create();

        Answer::factory()->for($job_offer->first(), 'job_offer')->for($user_employee)->count(2)->create();
        Answer::factory()->for($job_offer1->first(), 'job_offer')->for($user_employee)->count(2)->create();
    }
}
