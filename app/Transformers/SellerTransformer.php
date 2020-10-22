<?php

namespace App\Transformers;

use App\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
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
    public function transform(Seller $seller)
    {
        return [
            'id' => (int)$seller->id,
            'fullname' => (string)$seller->name,
            'email' => (string)$seller->email,
            'isVerified' => (int)$seller->verified,
            'creationDate' =>(string)$seller->created_at,
            'lastChange' => (string)$seller->updated_at,
            'deletedAt' => isset($seller->deleted_at) ? (string) $seller->deleted_at : null,

            'links'=> [
                [
                    'rel'=> 'self',
                    'href'=> route('sellers.show', $seller->id),
                ],
                [
                    'rel'=> 'seller.categories',
                    'href'=> route('sellers.categories.index', $seller->id),
                ],
                [
                    'rel'=> 'seller.products',
                    'href'=> route('sellers.products.index', $seller->id),
                ],
                [
                    'rel'=> 'seller.buyers',
                    'href'=> route('sellers.buyers.index', $seller->id),
                ],
                [
                    'rel'=> 'seller.transactions',
                    'href'=> route('sellers.transactions.index', $seller->id),
                ],
                [
                    'rel'=> 'user',
                    'href'=> route('users.show', $seller->id),
                ],
            ],
        ];
    }

    public static function getOriginalAttribute($index)
    {
        $attributes =  [
            'id' => 'id',
            'fullname' => 'name',
            'email' => 'email',
            'isVerified' => 'verified',
            'creationDate' =>'created_at',
            'lastChange' => 'updated_at',
            'deletedAt' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;

    }

    public static function transformedAttribute($index)
    {
        $attributes =  [
             'id' => 'id',
             'name' => 'fullname',
             'email' => 'email',
             'verified' => 'isVerified',
             'created_at' => 'creationDate',
             'updated_at' => 'lastChange',
             'deleted_at' => 'deletedAt',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;

    }
}
