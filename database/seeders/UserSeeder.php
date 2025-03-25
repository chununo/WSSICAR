<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			'name'      => "admin",
			'email'     => "admin@pancopilco.mx",
			'password'  => "LilitEv@304290"
        ];

		$admin = User::create($data);
        $admin->assignRole("admin");

        $data = [
			'name'      => "copilco",
			'email'     => "copilco@pancopilco.mx",
			'password'  => "Nor@304290923"
        ];

		$copilco = User::create($data);
        $copilco->assignRole("sucursal");
    }
}
