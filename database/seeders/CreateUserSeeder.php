<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosenObjAdmin = Dosen::factory()->create();
        $dosenObj = Dosen::factory()->create();

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('rahasia'),
        ]);

        $dosen = User::create([
            'name' => 'dosen',
            'email' => 'dosen@gmail.com',
            'password' => bcrypt('rahasia'),
        ]);

        $admin->dosen()->save($dosenObjAdmin);
        $dosen->dosen()->save($dosenObj);

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleDosen = Role::create(['name' => 'dosen']);


        $admin->assignRole([$roleAdmin->id]);
        $dosen->assignRole([$roleDosen->id]);

    }
}
