<?php

namespace App\Http\Controllers;

class BlogController extends PostController
{
    /**
     * BlogController constructor.
     */
    public function __construct()
    {
        // Set type of post
        $this->type_post = 'post_blogs';

        // load index blade layout
        $this->returnDataIndex = [
            'view'    => 'page.blog.index-mix',
            'plugins' => [
                'navigate'    => 'resources',
                'subnavigate' => 'blogs',
                'slug'        => 'blog',
            ],
        ];

        // load detail layout
        $this->returnDataDetail = [
            'view'    => 'page.blog.item',
            'plugins' => [
                'navigate'    => 'resources',
                'subnavigate' => 'blogs',
                'slug'        => 'blog',
            ],
        ];
    }
}
