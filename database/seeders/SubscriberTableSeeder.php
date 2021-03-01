<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class SubscriberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscriber::factory(5)->create();
    }
}
