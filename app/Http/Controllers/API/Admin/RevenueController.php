<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RevenueController extends Controller
{
	public function getAnnualRevenue()
	{
		return DB::select('
            SELECT ((SUM(subTotal) * 0.05) + SUM(1.75)) as totalRevenue
            FROM customer_orders
            WHERE created_at >= DATE_FORMAT(NOW() ,"%Y-01-01") AND created_at <= DATE_FORMAT(NOW() ,"%Y-12-31")
            AND status = "delivered"
         ');
	}

	public function getMonthlyRevenue()
	{
		return DB::select('
            SELECT ((SUM(subTotal) * 0.05) + SUM(1.75)) as totalRevenue
            FROM customer_orders
            WHERE created_at >= DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW())) - 1 DAY) AND created_at <= LAST_DAY(CURDATE())
            AND status = "delivered"
          ');
	}

	public function getDateRangeRevenue(Request $request)
	{
		return DB::select('
            SELECT 
              a.order_id, a.status, (a.subTotal * 0.05) as merch_rev, (1.75) as delivery_rev, a.paymentMode, DATE_FORMAT(a.created_at, "%m-%d-%Y") as created_date,
              b.fname, b.lname,
              c.merchant_name
            FROM `customer_orders` a
            JOIN `dashers` b ON b.id = a.dasher_id
            JOIN `merchants` c ON c.id = a.merchant_id 
            WHERE a.status = "Delivered"
            AND a.created_at >= DATE("' . $request->start . '") AND a.created_at <= DATE("' . $request->end . '")
          ');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
