<?php

namespace App\Http\Controllers;

class PracticeController extends PostController
{
    /**
     * PracticeController constructor.
     */
    public function __construct()
    {
        // Set type of post
        $this->type_post = 'post_pratices';

        // load index blade layout
        $this->returnDataIndex = [
            'view'    => 'page.blog.index-row',
            'plugins' => [
                'navigate'    => 'resources',
                'subnavigate' => 'daily-practices',
                'slug'        => 'practice',
            ],
        ];

        // load detail layout
        $this->returnDataDetail = [
            'view'    => 'page.blog.item',
            'plugins' => [
                'navigate'    => 'resources',
                'subnavigate' => 'daily-practices',
                'slug'        => 'practice',
            ],
        ];
    }
}
