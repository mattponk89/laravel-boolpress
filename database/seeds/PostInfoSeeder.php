<?php

use Illuminate\Database\Seeder;

class PostInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PostInfo::class, 50)->create();
    }
}
