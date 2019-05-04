<?php

namespace App\Http\Controllers;

class PressController extends PostController
{
    /**
     * PressController constructor.
     */
    public function __construct()
    {
        // Set type of post
        $this->type_post = 'post_presses';

        // load index blade layout
        $this->returnDataIndex = [
            'view'    => 'page.about.press',
            'plugins' => [
                'navigate'    => 'press',
                'subnavigate' => 'press',
                'slug'        => 'press',
            ],
        ];

        // load detail layout
        $this->returnDataDetail = [
            'view'    => 'page.about.pressitem',
            'plugins' => [
                'navigate'    => 'press',
                'subnavigate' => 'press',
                'slug'        => 'press',
            ],
        ];
    }
}
