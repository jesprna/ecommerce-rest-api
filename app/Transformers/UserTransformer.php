<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
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
    public function transform(User $user)
    {
        return [
            'id' => (int)$user->id,
            'fullname' => (string)$user->name,
            'email' => (string)$user->email,
            'isVerified' => (int)$user->verified,
            'isAdmin' => ($user->admin === 'true'),
            'creationDate' => (string)$user->created_at,
            'lastChange' => (string)$user->updated_at,
            'deletedAt' => isset($user->deleted_at) ? (string) $user->deleted_at : null,

            'links'=> [
                [
                    'rel'=> 'self',
                    'href'=> route('users.show', $user->id),
                ],
            ],
        ];
    }

    public static function getOriginalAttribute($index)
    {
        $attributes =  [
            'id' =>'id',
            'fullname' => 'name',
            'email' => 'email',
            'isVerified' => 'verified',
            'isAdmin' => 'admin',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deletedAt' => 'deleted_at',
            'password'=> 'password',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;

    }

    public static function transformedAttribute($index)
    {
        $attributes =  [
             'id'=> 'id',
             'name'=> 'fullname',
             'email'=> 'email',
             'verified'=> 'isVerified',
             'admin'=> 'isAdmin',
             'created_at'=> 'creationDate',
             'updated_at'=> 'lastChange',
             'deleted_at'=> 'deletedAt',
             'password'=> 'password',

        ];

        return isset($attributes[$index]) ? $attributes[$index] :null;

    }
}
