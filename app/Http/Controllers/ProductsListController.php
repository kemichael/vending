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

        if(!empty($company)) {
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


    //detail詳細表示用DB処理
    public function detail($id) {

        $detail = Product::Join('companies', 'products.company_id', '=' , 'companies.id')
        -> select('products.*', 'companies.company_name')
        -> find($id);

        return view('product_detail', compact('detail'));
    }


    //edit表示用DB処理
    public function edit($id) {
        $edit = Product::Join('companies', 'products.company_id', '=' , 'companies.id')
        -> select('products.*', 'companies.company_name')
        -> find($id);

        $companies =  Company::all();

        return view('product_edit', compact('edit', 'companies'));
    }   

    //編集内容反映用処理
    public function update(Request $request, $id) {

        $product = Product::find($id);

        $product -> product_name = $request -> input('name');
        $product -> company_id = $request -> input('maker');
        $product -> price = $request -> input('price');
        $product -> stock = $request -> input('stock');
        $product -> comment = $request -> input('comment');

        $product -> save();
        return redirect(route('products'));
    }
}
