<?php

namespace App\Http\Controllers;

class EventController extends PostController
{
    /**
     * EventController constructor.
     */
    public function __construct()
    {
        // Set type of post
        $this->type_post = 'post_events';

        // load index blade layout
        $this->returnDataIndex = [
            'view'    => 'page.event.list',
            'plugins' => [
                'navigate'    => 'event',
                'subnavigate' => 'event',
                'slug'        => 'event',
            ],
        ];

        // load detail layout
        $this->returnDataDetail = [
            'view'    => 'page.event.item',
            'plugins' => [
                'navigate'    => 'event',
                'subnavigate' => 'event',
                'slug'        => 'event',
            ],
        ];
    }
}
