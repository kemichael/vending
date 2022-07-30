<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
 
 protected $fillable = ['img_path'];

 public function company(){
    return $this -> belongsTo(Company::class);
 }

 //登録処理
 public function storeProduct($data) {
    DB::table('products') -> insert ([
        'product_name' => $data -> name,
        'company_id' => $data -> maker,
        'price' => $data -> price,
        'stock' => $data -> stock,
        'comment' => $data -> comment,
        'img_path' => 0,
    ]);
 }




}
