<?php

namespace App\Http\Controllers;

use App\Helper\Responses;
use App\Models\Categorie;

class CategorieController extends Controller
{
    public function __construct(protected Responses $responses)
    {
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->responses->success(Categorie::all(), trans('validation.success'));
    }
}
