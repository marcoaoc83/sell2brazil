<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'OrderId';
    protected $table = "orders";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'OrderCode','OrderDate', 'TotalAmountWihtoutDiscount', 'TotalAmountWithDiscount'
    ];
    public function Articles()
    {
        return $this->hasMany(OrderArticle::class,'OrderId','OrderId');
    }
}
