<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illumiinate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Company;

class ProductEditController extends Controller
{
    //表示用DB処理
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