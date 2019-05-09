<?php

namespace App\Http\Controllers\API;

use App\Models\Client;
use App\Models\Post;
use App\Models\User;

class SummaryController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function summaryAll()
    {
        $client = Client::query()->get()->count();
        $user = User::query()->get()->count();
        $postTypes = [
            'post_presses',
            'post_blogs',
            'post_events',
            'post_programs',
            'post_guides',
            'post_practices',
            'post_faq',
        ];

        // Count post type in DB
        $post = Post::query()->selectRaw('type, COUNT(*) AS count')
                    ->groupBy('type')
                    ->get();

        // Get post types which exist in DB
        $postTypesInDb = $post->map(function ($item) {
           return $item->type;
        })->toArray();

        $post = $post->flatMap(function ($item) use ($postTypes) {
            return [
                $item['type'] => $item['count'],
            ];
        });

        // Add post types which don't exist in DB
        $post = $post->merge(collect(array_diff($postTypes, $postTypesInDb))->flatMap(function ($item) {
            return [$item => 0];
        }));

        $data = [
            'client' => $client,
            'user'   => $user,
            'post'   => $post,
        ];

        return $this->ok($data);
    }
}
