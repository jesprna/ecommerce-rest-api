<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Http\Controllers\ApiController;


class CategoryBuyerController extends ApiController
{
    public  function __construct()
    {
       parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $this->allowedAdminAction();
        $buyers = $category->products()->whereHas('transactions')->with('transctions.buyer')
            ->get()
            ->pluck('transctions')
            ->collapse()
            ->pluck('buyer')
            ->unique('id')
            ->values();
        return $this->showAll($buyers);
    }


}
