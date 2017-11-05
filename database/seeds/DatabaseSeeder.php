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
        $this->command->info('Ajout d\'auteurs');

        $this->call(ScoresTableSeeder::class);
        $this->command->info('Ajout de partitions');

        $this->call(UsersTableSeeder::class);
        $this->command->info('Création de comptes utilisateurs');
    }
}
