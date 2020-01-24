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

    Merchant::create(
      [
        'user_id'        => 2,
        'merchant_name'  => 'Jollibee',
        'location'       => 'Pacita Avenue, San Pedro, Laguna, 4023',
        'latitude'       => '14.3423567',
        'longitude'      => '121.0574553',
        'contact_num'    => '88682871',
        'opening'        => '00:00',
        'closing'        => '00:00'
      ]
    );
  }
}
