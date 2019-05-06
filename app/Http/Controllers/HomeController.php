<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Client;

use App\Transformers\ClientTransformer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // load Press
        $data['press'] = $this->loadInThePress('post_presses');

        // load Client
        $data['clients'] = $this->loadClient();

        // load Event And Program
        $data['eventAndProgram'] = $this->loadEventAndProgram();

        return view('page.home', [
            'data'        => $data,
            'navigate'    => 'home',
            'subnavigate' => 'home',
            'slug'        => 'home',
        ]);
    }

    /**
     * load in the press data
     *
     * @param string $type
     * @return \Illuminate\Support\Collection
     */
    private function loadInThePress($type)
    {
        /** @var \App\Models\Post $post */
        $post = Post::ofLocale(app()->getLocale())
                    ->whereType($type)
            //->whereHas('metas', function ($query) {
            //    /**@var \Illuminate\Database\Eloquent\Builder $query */
            //    $query->where([
            //        'meta_key'   => 'home',
            //        'meta_value' => 'true',
            //    ]);
            //})
                    ->limit(6)->latest();

        // Transform Post Data
        return $this->loadTransformDataPost($post);
    }

    /**
     * load client
     *
     * @return \Illuminate\Support\Collection
     */
    private function loadClient()
    {
        $data = Client::get();
        $data = $this->loadTransformData($data, ClientTransformer::class);

        return $data;
    }

    private function loadEventAndProgram()
    {
        /** @var \App\Models\Post $post */
        $post = Post::ofLocale(app()->getLocale())
                    ->whereType('post_events')
                    ->orWhere('type', 'post_programs')
                    ->limit(6)
                    ->latest();

        // Transform Post Data
        return $this->loadTransformDataPost($post);
    }
}
