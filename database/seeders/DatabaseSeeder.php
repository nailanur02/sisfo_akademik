<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void {
        User::updateOrCreate(
        ['email' => 'admin@admin.com'],
        [
            'name' => 'Administrator SISFO',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]
        );

        User::updateOrCreate(
        ['email' => 'guru@guru.com'],
        [
            'name' => 'Guru SISFO',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]
        );
    }
}

