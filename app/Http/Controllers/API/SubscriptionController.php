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
     * @param \App\Models\Subscription $subscriptions
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Subscription $subscription
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Subscription $subscription)
    {
        $subscription->fill(['status' => 1]);
        $subscription->save();

        return $this->ok($subscription, SubscriptionTransformer::class);
    }

}
