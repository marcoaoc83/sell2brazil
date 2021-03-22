<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /** @test */
    public function verifica_se_salva_orders()
    {

        $dados = [
            [
                "ArticleCode"=>1,
                "ArticleName"=>"Teste",
                "UnitPrice"=>100.54,
                "Quantity"=> 5
	        ],
            [
                "ArticleCode"=>2,
                "ArticleName"=>"Teste2",
                "UnitPrice"=>42.78,
                "Quantity"=> 4
            ],
            [
                "ArticleCode"=>1,
                "ArticleName"=>"Teste",
                "UnitPrice"=>100.54,
                "Quantity"=> 3
            ],
	];

        $response=$this->json('POST', 'api/CREATE_ORDER', $dados, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->decodeResponseJson();
        Log::info($response);

    }

    /** @test */
    public function verifica_se_lista_orders()
    {
        $response=$this->json('get', 'api/orders')
            ->assertStatus(200)
            ->decodeResponseJson();
        Log::info($response);

    }
}
