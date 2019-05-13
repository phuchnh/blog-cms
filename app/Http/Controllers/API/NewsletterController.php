<?php

namespace App\Http\Controllers\API;

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

        if ($search = $request->get('email')) {
            $data = $mailChimp->getApi()->get('search-members', [
                'query' => 'email:' . urlencode($request->get('email'))
            ]);
            $members = collect(Arr::get($data, 'full_search.members', []));
            $total =  Arr::get($data, 'full_search.total_items', 0);
        } else {
            $data = $mailChimp->getMembers('', [
                'count'  => $perPage + $offset,
                'offset' => $offset,
            ]);

            $members = collect(Arr::get($data, 'members', []));
            $total = Arr::get($data, 'total_items', 0);

            $members = $members->sortByDesc('id');
        }

        $result = new LengthAwarePaginator($members->forPage(1, $perPage), $total, $perPage, 1);

        return $this->ok($result);
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
