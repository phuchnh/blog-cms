<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends PostController
{
    /**
     * EventController constructor.
     */
    public function __construct()
    {
        // Set type of post
        $this->type_post = '';

        // load index blade layout
        $this->returnDataIndex = [
            'view'    => 'page.search.list',
            'plugins' => [
                'navigate'    => '',
                'subnavigate' => '',
                'slug'        => '',
            ],
        ];
    }
}
