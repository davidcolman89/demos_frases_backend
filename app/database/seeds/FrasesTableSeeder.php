<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FrasesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Frase::create([
				'autor' => $faker->name,
				'texto' => $faker->text
			]);
		}
	}

}
