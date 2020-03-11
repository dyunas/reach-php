<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->delete();

    $users = [
      [
        'email'             => 'reach.dev2019@gmail.com',
        'email_verified_at' => now(),
        'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'account_type'      => 'admin',
        'remember_token'    => null,
      ],
      [
        'email'             => 'jonathan.jara@gmail.com',
        'email_verified_at' => now(),
        'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'account_type'      => 'merchant',
        'remember_token'    => null,
      ],
      [
        'email'             => 'gerick.adubal@gmail.com',
        'email_verified_at' => now(),
        'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'account_type'      => 'dasher',
        'remember_token'    => null,
      ],
      [
        'email'             => 'ariana.gonzales@gmail.com',
        'email_verified_at' => now(),
        'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'account_type'      => 'customer',
        'remember_token'    => null,
      ],
      [
        'email'             => 'louise.escasinas@gmail.com',
        'email_verified_at' => now(),
        'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'account_type'      => 'merchant',
        'remember_token'    => null,
      ],
      [
        'email'             => 'argie.cabrales@gmail.com',
        'email_verified_at' => now(),
        'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'account_type'      => 'dasher',
        'remember_token'    => null,
      ]
    ];

    foreach ($users as $user) {
      User::create($user);
    }
  }
}
