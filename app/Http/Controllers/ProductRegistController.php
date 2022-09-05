<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illumiinate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Company;

class ProductRegistController extends Controller
{
    // 登録画面表示
    public function regist() {
        $companies = Company::all();
        
        return view('product_regist', compact('companies'));
    }

    // 登録処理
    public function store(Request $request) {
        
        DB::beginTransaction();

        try {
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

