<?php

namespace App\Http\Controllers\API\Merchant;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RevenueController extends Controller
{
	public function getDailyRevenue()
	{
		return DB::select('
            SELECT SUM(subTotal - (subTotal * 0.05)) as totalRevenue
            FROM customer_orders
						WHERE created_at = NOW()
						AND merchant_id = ' . Auth::user()->merchant->id . '
            AND status = "delivered"
         ');
	}

	public function getMonthlyRevenue()
	{
		return DB::select('
            SELECT SUM(subTotal - (subTotal * 0.05)) as totalRevenue
            FROM customer_orders
						WHERE created_at >= DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW())) - 1 DAY) AND created_at <= LAST_DAY(CURDATE())
						AND merchant_id = ' . Auth::user()->merchant->id . '
            AND status = "delivered"
          ');
	}
}
