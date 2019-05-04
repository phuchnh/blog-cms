<?php

namespace App\Http\Controllers;

class GuideController extends PostController
{
    /**
     * GuideController constructor.
     */
    public function __construct()
    {
        // Set type of post
        $this->type_post = 'post_guides';

        // load index blade layout
        $this->returnDataIndex = [
            'view'    => 'page.blog.index-row',
            'plugins' => [
                'navigate'    => 'resources',
                'subnavigate' => 'guided-meditation',
                'slug'        => 'guide',
            ],
        ];

        // load detail layout
        $this->returnDataDetail = [
            'view'    => 'page.blog.item',
            'plugins' => [
                'navigate'    => 'resources',
                'subnavigate' => 'guided-meditation',
                'slug'        => 'guide',
            ],
        ];
    }
}
