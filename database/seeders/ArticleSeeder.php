<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Str; // Ajoutez cette ligne
class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('fr_FR');
        
        for ($i = 0; $i < 10; $i++) {
            $nom = $faker->sentence(6, true);
            $date = $faker->dateTimeBetween('-1 year', 'now');
            $tempId = $i + 1; // ID temporaire
            
            // Inclure l'URL lors de l'insertion
            DB::table('articles')->insert([
                'nom_article' => $nom,
                'titre' => $faker->sentence(4, true),
                'contenus' => $faker->paragraphs(5, true),
                'date' => $date,
                'url' => $tempId . '-' . Str::slug($nom) . '-' . $date->format('d-m-Y'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}