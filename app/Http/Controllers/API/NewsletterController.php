<?php

namespace App\Http\Controllers\API;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Spatie\Newsletter\Newsletter;

class NewsletterController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param \Spatie\Newsletter\Newsletter $mailChimp
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Newsletter $mailChimp, Request $request)
    {
        $page = $request->get('page');
        $perPage = $request->get('perPage');
        $offset = ($page - 1) * $perPage;

        # set config newsletter
        if ($search = $request->get('email')) {
            $listId = array_get(config('newsletter.lists'), $request->get('type') . '.id', 0);
            $data = $mailChimp->getApi()->get('search-members', [
                'query' => 'email:' . urlencode($request->get('email')),
                'list_id' => $listId
            ]);
            $members = collect(Arr::get($data, 'full_search.members', []));
            $total =  Arr::get($data, 'full_search.total_items', 0);
        } else {
            $data = $mailChimp->getMembers($request->get('type'), [
                'count'  => $perPage + $offset,
                'offset' => $offset,
            ]);

            $members = collect(Arr::get($data, 'members', []));
            $total = Arr::get($data, 'total_items', 0);

            //$members = $members->sortByDesc('id');
        }

        $result = new LengthAwarePaginator($members->forPage(1, $perPage), $total, $perPage, 1);

        return $this->ok($result);
    }

    public function exportCSV(Request $request) {
        $listId = array_get(config('newsletter.lists'), $request->get('type') . '.id', 0);
        $http = new Client();
        $httpResponse = $http->post('https://us15.api.mailchimp.com/export/1.0/list', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'apikey' => '0a1d9c6e34b21c56d1b851b6c3da5562-us15',
                'id' => $listId,
            ]
        ]);
        $body = $httpResponse->getBody()->getContents();
        $data = collect($request->get('data'))->flatten();
        $data = $data->map(function ($item) {
           $item = str_replace(['[', ']'], '', $item);
           return explode(PHP_EOL, $item);
        })->flatten();
        $name = 'subscriber';
        //$data = explode(PHP_EOL, $data);
        return response()->stream(function () use ($data) {
           $handle = fopen('php://output', 'w');
           // export utf-8
           fputs($handle, chr(0xEF).chr(0xBB).chr(0xBF));

           $data->chunk(100)->each(function ($chunk) use ($handle) {
                $chunk->each(function ($item) use ($handle) {
                   $record = [];
                   $record[] = str_getcsv($item);
                   fputcsv($handle, array_flatten($record));
                });
           });
           fclose($handle);
        }, 200, [
            'Content-Encoding'    => 'UTF-8',
            'Content-Type'        => 'application/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$name.'.csv"',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param string $email
     * @param \Spatie\Newsletter\Newsletter $mailChimp
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($email, Newsletter $mailChimp)
    {
        $member = $mailChimp->getMember($email);
        return $this->ok($member);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
