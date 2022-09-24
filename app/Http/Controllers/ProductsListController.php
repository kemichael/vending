<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illumiinate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Company;


class ProductsListController extends Controller
{
    public function showList(Request $request) {    
       
        $keyword = $request->input('keyword');
        $company = $request->input('company');
        $price_under = $request->input('price-u');
        $price_over = $request->input('price-o');
        $stock_under = $request->input('stock-u');
        $stock_over = $request->input('stock-o');

        $query = Product::sortable();


        $query->select('products.*', 'companies.company_name')
        ->join('companies', function ($query) use ($request) {
            $query->on('products.company_id', '=', 'companies.id');
        });

        // 商品名検索
        if(!is_null($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }

        // メーカー名検索
        if(!is_null($company)) {
            $query-> where('company_name', '=', "$company");
        }

        //価格検索上限
        if($price_under === 'u100') {
            $query->where('products.price', '<=', '100');
        }elseif($price_under === 'u200') {
            $query->where('products.price', '<=', '200');
        }

        //価格検索下限
        if($price_over === 'o100') {
            $query->where('products.price', '>=', '100');
        }elseif($price_over === 'o200') {
            $query->where('products.price', '>=', '200');
        }

        //在庫数検索上限
        if($stock_under === 'u100') {
            $query->where('products.stock', '<=', '100');
        }elseif($stock_under === 'u200') {
            $query->where('products.stock', '<=', '200');
        }elseif($stock_under ==='u300') {
            $query->where('products.stock', '<=', '300');
        }

        // 在庫数検索下限
        if($stock_over === 'o50') {
            $query->where('products.stock', '>=', '50');
        }elseif($stock_over === 'o100') {
            $query->where('products.stock', '>=', '100');
        }elseif($stock_over === 'o200') {
            $query->where('products.stock', '>=', '200');
        }elseif($stock_over === 'o300') {
            $query->where('products.stock', '>=', '300');
        }
      
        $products = $query->get();

        $companies_list = Company::all();
        
        return view('products', compact('products', 'keyword', 'company', 'companies_list', 'price_under', 'price_over', 'stock_over', 'stock_under' ));
    }

    //削除用
    public function delete($id) {

        DB::beginTransaction();

        try {
            $product = Product::find($id);
            $product->delete(); 
            DB::commit();
        }catch (\Exceptioin $e)  {
            DB::rollback();
            return back();            
        }
        return redirect('products');
    }


    //詳細表示用DB処理
    public function detail($id) {

        $detail = Product::find($id);
        $detail->join('companies', 'products.company_id', '=' , 'companies.id')
        ->select('products.*', 'companies.company_name');
        
        return view('product_detail', compact('detail'));
    }


    //編集画面表示用DB処理
    public function edit($id) {
        $edit = Product::find($id);
        $edit->join('companies', 'products.company_id', '=' , 'companies.id')
        ->select('products.*', 'companies.company_name');

        $companies =  Company::all();

        return view('product_edit', compact('edit', 'companies'));
    }   

    //編集内容反映用処理
    public function update(Request $request, $id) {

        $product = Product::find($id);

        $product->product_name = $request->input('name');
        $product->company_id = $request->input('maker');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->comment = $request->input('comment');

        $product->save();
        return redirect(route('products'));
    }


    //新規登録画面表示
    public function regist() {
        $companies = Company::all();
    
        return view('product_regist', compact('companies'));
    }

    //新規登録処理
    public function store(Request $request) {
        
        

        try {
            DB::beginTransaction();

            $model = new Product();

            $model->storeProduct($request);

            DB::commit();

        } catch (\Exceptioin $e)  {
            DB::rollback();
            return back();
        }

        $img = $request->file('img_path');

        // 画像情報がセットされていれば、保存処理を実行
        if (isset($img)) {
            // storage > public > img配下に画像が保存される
            $path = $img->store('img','public');
            // store処理が実行できたらDBに保存処理を実行
            if ($path) {
                // DBに登録する処理
                Product::create([
                    'img_path' => $path,
                ]);
            }
        }
            //登録後、一覧画面へリダイレクト
            return redirect(route('products'));
     }
}
