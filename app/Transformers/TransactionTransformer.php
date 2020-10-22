<?php

namespace App\Transformers;

use App\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
            'id' => (int)$transaction->id,
            'quantity' => (int)$transaction->quantity,
            'buyer' => (int)$transaction->buyer_id,
            'seller' => (int)$transaction->seller_id,
            'transaction' => (int)$transaction->transaction_id,
            'creationDate' => (string)$transaction->created_at,
            'lastChange' => (string)$transaction->updated_at,
            'deletedAt' => isset($transaction->deleted_at) ? (string) $transaction->deleted_at : null,


            'links'=> [
                [
                    'rel'=> 'self',
                    'href'=> route('transactions.show', $transaction->id),
                ],
                [
                    'rel'=> 'transaction.categories',
                    'href'=> route('transactions.categories.index', $transaction->id),
                ],
                [
                    'rel'=> 'transaction.seller',
                    'href'=> route('transactions.sellers.index', $transaction->id),
                ],
                [
                    'rel'=> 'buyer',
                    'href'=> route('buyers.show', $transaction->buyer_id),
                ],
                [
                    'rel'=> 'product',
                    'href'=> route('products.show', $transaction->product_id),
                ],
            ],
        ];
    }

    public static function getOriginalAttribute($index)
    {
        $attributes =  [
            'id' => 'id',
            'quantity' => 'quantity',
            'buyer' => 'buyer_id',
            'seller' => 'seller_id',
            'transaction' => 'transaction_id',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deletedAt' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;

    }

    public static function transformedAttribute($index)
    {
        $attributes =  [
              'id'=> 'id',
              'quantity'=> 'quantity',
              'buyer_id'=> 'buyer',
              'seller_id'=> 'seller',
              'transaction_id'=> 'transaction',
              'created_at'=> 'creationDate',
              'updated_at'=> 'lastChange',
              'deleted_at'=> 'deletedAt',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;

    }
}
