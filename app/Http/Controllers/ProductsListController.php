<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illumiinate\Database\Eloquent\Model;
use Illuminaate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Company;


class ProductsListController extends Controller
{
    public function showList(Request $request) {    
       
        //$lists = new Product;
        //$products = $lists -> getList();
       //上のコードをコメントアウト、下ははずと検索できる……
       //memo:以下のコードもモデルにまとめてみる？
        $keyword = $request -> input('keyword');
        $company = $request -> input('company');

        $query = Product::query();

        $query -> select('products.*', 'companies.company_name')
        -> join('companies', function ($query) use ($request) {
            $query -> on('products.company_id', '=', 'companies.id');
        });

        if(!empty($keyword)) {
            $query -> where('product_name', 'LIKE', "%{$keyword}%");
        }

        if(!empty($company)){
            $query -> where('company_name', 'LIKE', "$company");
        }
      
        $products = $query -> get();

        $companies_list = Company::all();
        

        return view('products', compact('products', 'keyword', 'company', 'companies_list' ));
    }

    //削除用
    public function delete($id) {
        $product = Product::find($id);
        $product -> delete();

        return redirect('products');
    }
}
