<?php


namespace App\Repositories\Eloquent;


use App\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository extends AbstractRepository implements OrderRepositoryInterface
{
    protected $model=Order::class;

}
