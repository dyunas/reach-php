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
            WHERE created_at BETWEEN DATE_FORMAT(NOW() ,"%Y-01-01") AND DATE_FORMAT(NOW() ,"%Y-12-31")
            AND status = "delivered"
         ');
  }

  public function getMonthlyRevenue()
  {
    return DB::select('
            SELECT ((SUM(subTotal) * 0.05) + SUM(1.75)) as totalRevenue
            FROM customer_orders
            WHERE created_at BETWEEN DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW())) - 1 DAY) AND LAST_DAY(CURDATE())
            AND status = "delivered"
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
