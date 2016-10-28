<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(master_user_seeder_template::class);
        $this->call(master_module_seeder_template_v2::class);
    }
}
