<?php

namespace App\Http\Controllers;

use App\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends  BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderRepositoryInterface $model)
    {
        $orders=$model->all();

        return $this->sendResponse($orders, 'Orders List');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_order(Request $request)
    {
        //Agrupa os produtos valores e qtdes e verifica se tem desconto
        $orderArticles=[];
        foreach ($request->input() as $articles){
            $orderArticles[$articles['ArticleCode']]['ArticleCode']=$articles['ArticleCode'];
            $orderArticles[$articles['ArticleCode']]['ArticleName']=$articles['ArticleName'];
            $orderArticles[$articles['ArticleCode']]['UnitPrice']=$articles['UnitPrice'];

            if(isset($orderArticles[$articles['ArticleCode']]['Quantity']))
                $orderArticles[$articles['ArticleCode']]['Quantity']+=$articles['Quantity'];
            else
                $orderArticles[$articles['ArticleCode']]['Quantity']=$articles['Quantity'];

            $orderArticles[$articles['ArticleCode']]['Total']=$orderArticles[$articles['ArticleCode']]['Quantity']*$orderArticles[$articles['ArticleCode']]['UnitPrice'];

            if($orderArticles[$articles['ArticleCode']]['Quantity']>=5 &&
                $orderArticles[$articles['ArticleCode']]['Quantity']<=9 &&
                $orderArticles[$articles['ArticleCode']]['Total']>500
            ){
                $orderArticles[$articles['ArticleCode']]['TotalDiscount']=$orderArticles[$articles['ArticleCode']]['Total']*0.85;
            }else{
                $orderArticles[$articles['ArticleCode']]['TotalDiscount']=0;
            }
        }
        //Faz o somatorio
        $TotalAmountWihtoutDiscount=$TotalAmountWithDiscount=0;
        foreach ($orderArticles as $orderArticle){
            $TotalAmountWihtoutDiscount+=$orderArticle['Total'];
            $TotalAmountWithDiscount+=$orderArticle['TotalDiscount'];
        }

        // Salva no BD
        $Order=Order::create([
            "OrderCode"=>md5(uniqid(rand(), true)),
            "OrderDate"=>Carbon::now(),
            "TotalAmountWihtoutDiscount"=>$TotalAmountWihtoutDiscount,
            "TotalAmountWithDiscount"=>$TotalAmountWithDiscount,
        ]);
        //Gera ORderCode
        $Order->update([
            "OrderCode"=>date("Y")."-".date('m')."-".$Order->OrderId
        ]);
        return $this->sendResponse($orderArticles, 'Orders List');
    }
}
