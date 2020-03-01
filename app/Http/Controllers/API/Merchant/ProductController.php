<?php

namespace App\Http\Controllers\API\Merchant;

use App\MerchantProduct;
use App\Http\Resources\ProductCollection as ProductCollection;
use App\Http\Controllers\Controller;
use App\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
  protected function formValidator($request)
  {
    return $request->validate([
      'avatar'      => 'image|mimes:jpeg,png|max:5000',
      'productName' => 'required|string',
      'category'    => 'required|numeric',
      'price'       => 'required|numeric',
      'status'      => 'required|string',
      'details'     => 'required|string',
    ]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $user = Auth::user();
    return ProductCollection::collection(MerchantProduct::where('merchant_id', $user->merchant->id)->get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->formValidator($request);

    $user = Auth::user();

    $product = MerchantProduct::create([
      'merchant_id'   => $user->merchant->id,
      'category_id'   => $request->category,
      'product_name'  => $request->productName,
      'product_price' => $request->price,
      'status'        => $request->status,
      'description'   => $request->details
    ]);

    $this->storeImage($product);

    return response()->json(['message' => 'Product successfully added!'], 201);
  }

  public function storeImage($product)
  {
    $product->update([
      'avatar' => request()->avatar->store('uploads', 'public')
    ]);
  }

  public function getBanner(Request $request)
  {
    return Merchant::where('id', $request->merchant_id)->select('photo')->get();
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

  public function getProductByCategories(Request $request)
  {
    return ProductCollection::collection(
      MerchantProduct::where('merchant_id', $request->merchant_id)
        ->where('category_id', $request->category_id)
        ->get()
    );
  }
}
