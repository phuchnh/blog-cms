<?php

namespace App\Http\Controllers;

class ProgramController extends PostController
{
    /**
     * ProgramController constructor.
     */
    public function __construct()
    {
        // Set type of post
        $this->type_post = 'post_programs';

        // load index blade layout
        $this->returnDataIndex = [
            'view'    => 'page.event.list',
            'plugins' => [
                'navigate'    => 'event-program',
                'subnavigate' => 'program',
                'slug'        => 'program',
            ],
        ];

        // load detail layout
        $this->returnDataDetail = [
            'view'    => 'page.event.item',
            'plugins' => [
                'navigate'    => 'event-program',
                'subnavigate' => 'program',
                'slug'        => 'program',
            ],
        ];
    }
}
