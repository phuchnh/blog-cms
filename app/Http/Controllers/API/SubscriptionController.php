<?php

namespace App\Http\Controllers\API;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Transformers\SubscriptionTransformer;

class SubscriptionController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Subscription $subscriptions, Request $request)
    {
        $subscriptions = $subscriptions->search($request);

        $paginator = $request->get('perPage');

        $subscriptions = $subscriptions
            ->sortable([$request->get('sort') => $request->get('direction')])
            ->orderBy('id', 'desc')->paginate($paginator);

        return $this->ok($subscriptions, SubscriptionTransformer::class);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Subscription $subscription
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Subscription $subscription)
    {
        return $this->ok($subscription, SubscriptionTransformer::class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
