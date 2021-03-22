<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderArticle extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'ArticleId';
    protected $table = "orders_articles";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'OrderId','ArticleCode', 'ArticleName', 'UnitPrice', 'Quantity'
    ];
}
