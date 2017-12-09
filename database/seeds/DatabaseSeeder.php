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
        $this->command->info('Ajout des auteurs');

        $this->call(ScoresTableSeeder::class);
        $this->command->info('Ajout des partitions');

        $this->call(UsersTableSeeder::class);
        $this->command->info('Création des comptes utilisateurs');

        $this->call(ScoresRequestTableSeeder::class);
        $this->command->info('Création des demandes de partitions');

        $this->call(CommentsTableSeeder::class);
        $this->command->info('Création des commentaires de partitions');
    }
}
