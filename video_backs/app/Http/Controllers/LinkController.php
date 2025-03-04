<?php

namespace App\Http\Controllers;

use App\Helper\Responses;
use App\Http\Requests\LinkeRequest;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function __construct(protected Responses $responses)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->responses->success(
            Link::with('user')->orderBy('id', 'desc')->get(),
            trans('validation.success')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LinkeRequest $request)
    {
        $link = Link::create([
            'categorie_id' => $request->categorios,
            'user_id' => Auth::id(),
            'uid' => Str::uuid(),
            'title' => $request->title,
            'url' => $request->url,
            'text' => $request->description,
        ]);
        return $this->responses->success($link, trans('validation.success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uid)
    {
        $link = Link::with('user')->where('uid', $uid)->first();

        if (!$link) {
            return $this->responses->notFound('', trans('validation.not_found'));
        }

        return $this->responses->success($link, trans('validation.success'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uid)
    {
        $link = Link::where('uid', $uid)->first();

        if (!$link) {
            return $this->responses->notFound('', trans('validation.not_found'));
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'url' => 'sometimes|url',
            'text' => 'sometimes|string',
            'user_id'
        ]);

        if ($validator->fails()) {
            return $this->responses->notFound('', $validator->errors()->first());
        }

        $link->update($request->only(['title', 'url', 'text']));

        return $this->responses->success($link, trans('validation.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        $link = Link::where('id', $id)->first();
        if ($link->delete()) {
            return $this->responses->notFound('', trans('validation.success'));
        }
        return $this->responses->success(null, trans('validation.not_found'));
    }
}
