<?php

use App\Merchant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MerchantSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('merchants')->delete();

    $merchants = [
      [
        'user_id'        => 2,
        'merchant_name'  => 'Jollibee Pacita',
        'description'    => 'Sa Jollibee, Bida ang saya',
        'location'       => 'Pacita Avenue, San Pedro, Laguna, 4023',
        'latitude'       => '14.3423567',
        'longitude'      => '121.0574553',
        'contact_num'    => '88682871',
        'opening'        => '00:00',
        'closing'        => '00:00'
      ],
      [
        'user_id'        => 5,
        'merchant_name'  => 'Turks Shawarma Rosario Complex',
        'location'       => '13 Rosario Complex, San Pedro, Laguna, 4023',
        'description'    => 'Let\'s make everyday Turksday!',
        'latitude'       => '14.3361873',
        'longitude'      => '121.0458407',
        'contact_num'    => '9121234567',
        'opening'        => '09:00',
        'closing'        => '20:00'
      ]
    ];

    foreach ($merchants as $merchant) {
      Merchant::create($merchant);
    }
  }
}
