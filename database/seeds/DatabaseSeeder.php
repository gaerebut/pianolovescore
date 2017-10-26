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
        $this->call(AuthorsTableSeeder::class);
        $this->command->info('Remplissage de la table "authors"');

        $this->call(ScoresTableSeeder::class);
        $this->command->info('Remplissage de la table "scores"');
    }
}
