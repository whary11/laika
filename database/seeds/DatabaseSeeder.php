<?php

use Illuminate\Database\Seeder;
use App\Municipality;
use App\Department;
use App\Country;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);




        //Paises
        $colombia = Country::create([
            'name' => 'Colombia'
        ]);
        $mexico = Country::create([
            'name' => 'México'
        ]);

        // $argentina = Country::create([
        //     'name' => 'México'
        // ]);

        //Departamentos

        $chivas = Department::create([
            'name' => 'Chivas',
            'country_id' => $mexico->id
        ]);

        $choco = Department::create([
            'name' => 'Chocó',
            'country_id' => $colombia->id
        ]);
        $cundinamarca = Department::create([
            'name' => 'Cundinamarca',
            'country_id' => $colombia->id
        ]);

        $valle = Department::create([
            'name' => 'Valle del cauca',
            'country_id' => $colombia->id
        ]);

        $antioquia = Department::create([
            'name' => 'Antioquia',
            'country_id' => $colombia->id
        ]);



        //Municipios

        Municipality::create([
            'name' => 'Quibaya',
            'department_id' => $chivas->id
        ]);
        $bogota = Municipality::create([
            'name' => 'Bogotá',
            'department_id' => $cundinamarca->id
        ]);
        $quibdo = Municipality::create([
            'name' => 'Quibdó',
            'department_id' => $choco->id
        ]);

        Municipality::create([
            'name' => 'Cali',
            'department_id' => $valle->id
        ]);

        Municipality::create([
            'name' => 'Medellín',
            'department_id' => $antioquia->id
        ]);

        User::create([
            'name' => 'Luis Raga',
            'email' => 'whary11@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'municipality_id' => $quibdo->id

        ]);




        factory(App\User::class, 20)->create();
    }
}
