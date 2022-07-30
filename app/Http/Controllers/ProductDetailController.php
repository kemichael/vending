<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illumiinate\Database\Eloquent\Model;
use Illuminaate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Company;

class ProductDetailController extends Controller
{
    public function detail($id) {
        $detail = Product::Join('companies', 'products.company_id', '=' , 'companies.id')
        ->select('products.*', 'companies.company_name')
        ->find($id);

        return view('product_detail', compact('detail'));
    }
}
