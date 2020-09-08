<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
	public function getAnnualTransactionsCount()
	{
		return DB::select('
      SELECT COUNT(*) as annualTransaction
      FROM `customer_orders`
      WHERE status = "Delivered" AND
      created_at >= DATE_FORMAT(NOW() ,"%Y-01-01") AND created_at <= DATE_FORMAT(NOW() ,"%Y-12-31")
    ');
	}

	public function getMonthlyTransactionsCount()
	{
		return DB::select('
      SELECT COUNT(*) as monthlyTransaction
      FROM `customer_orders`
      WHERE status = "Delivered" AND
      created_at >= DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))-
      1 DAY) AND created_at <= LAST_DAY(CURDATE())
    ');
	}

	public function getDateRangeTransactions(Request $request)
	{
		return DB::select('
      SELECT 
        a.order_id, a.status, a.subTotal, a.distance, a.delivery_fee, a.total, a.paymentMode, DATE_FORMAT(a.created_at, "%m-%d-%Y") as created_date,
        b.fname, b.lname,
        c.merchant_name
      FROM `customer_orders` a
      JOIN `dashers` b ON b.id = a.dasher_id
      JOIN `merchants` c ON c.id = a.merchant_id 
      WHERE a.status = "Delivered"
      AND a.created_at >= DATE("' . $request->start . '") AND a.created_at <= DATE("' . $request->end . '")
    ');
	}
}
