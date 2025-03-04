<?php

namespace App\Http\Controllers;

use App\Helper\Responses;
use App\Models\Link;
use Illuminate\Http\Request;

class videoController extends Controller
{
    public function __construct(protected Responses $responses)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $link = Link::with('user')->where('uid', $id)->first();

        if (!$link) {
            return $this->responses->notFound('',trans('validation.not_found'));
        }

        return $this->responses->success($link, trans('validation.success'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
