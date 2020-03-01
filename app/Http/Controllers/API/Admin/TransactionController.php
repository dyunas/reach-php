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
      created_at BETWEEN DATE_FORMAT(NOW() ,"%Y-01-01") AND DATE_FORMAT(NOW() ,"%Y-12-31")
    ');
  }

  public function getMonthlyTransactionsCount()
  {
    return DB::select('
      SELECT COUNT(*) as monthlyTransaction
      FROM `customer_orders`
      WHERE status = "Delivered" AND
      created_at BETWEEN DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))-
      1 DAY) AND LAST_DAY(CURDATE())
    ');
  }
}
