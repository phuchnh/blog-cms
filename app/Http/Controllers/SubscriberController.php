<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Http\Requests\API\CreateSubscriberRequest;
use Spatie\Newsletter\Newsletter;

class SubscriberController extends Controller
{
    private $slugs = [
        'meeting',
        'company',
        'individual',
        'newsletter',
    ];

    private $mailchimp;

    public function __construct(Newsletter $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('subscriber.show', $this->slugs[0]));
    }

    /**
     * save date to mailchimp & DB
     *
     * @param \App\Http\Requests\API\CreateSubscriberRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(CreateSubscriberRequest $request)
    {
        $type = $request->get('type');

        $email = $request->get('email');

        # set config newsletter
        \Config::set('newsletter.lists.subscribers.id', config('newsletter.listIDS')[$request->type]);

        # check email
        $isSubscribed = $this->mailchimp->hasMember($email);
        $mailChimpInput = $this->inputMailchimpData($request, $type);

        # add email to mailchimp
        if ($isSubscribed) {
            $this->mailchimp->subscribe($email, $mailChimpInput);
        }

        # add DB type == meeting
        $inputData = $request->validated();
        $inputData['content'] = $this->filterDataContent($request);

        # create record DB
        Subscription::create($inputData);

        return view('page.form.success', [
            'navigate' => '',
            'slug'     => '',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        return view('page.form.'.$slug, [
            'navigate' => '',
            'slug'     => '',
        ]);
    }

    /**
     * get input data
     *
     * @param $request
     * @param $type
     * @return array
     */
    private function inputMailchimpData($request, $type)
    {
        if ($type === $this->slugs[0]) {
            return $this->inputTypeMeeting($request);
        } elseif ($type === $this->slugs[1]) {
            return $this->inputTypeCompany($request);
        } elseif ($type === $this->slugs[2]) {
            return $this->inputTypeIndividual($request);
        } elseif ($type === $this->slugs[3]) {
            return $this->inputTypeNewsletter($request);
        } else {
            return [];
        }
    }

    /**
     * get data for company
     *
     * @param $request
     * @param $type
     * @return array
     */
    private function inputTypeCompany($request)
    {
        return [
            'MMERGE1' => $request->get('name'),
            'MMERGE2' => $request->get('industry'),
            'MMERGE6' => $request->get('purpose'),
            'MMERGE3' => $request->get('position'),
            'MMERGE4' => $request->get('phone'),
            'MMERGE5' => $request->get('company_name'),
        ];
    }

    /**
     * get data for individual
     *
     * @param $request
     * @param $type
     * @return array
     */
    private function inputTypeIndividual($request)
    {
        return [
            'FNAME'   => $request->get('name'),
            'MMERGE2' => $request->get('purpose'),
            'PHONE'   => $request->get('phone'),
        ];
    }

    /**
     * get data for book a meeting
     *
     * @param $request
     * @param $type
     * @return array
     */
    private function inputTypeMeeting($request)
    {
        return [
            'FNAME'   => $request->get('name'),
            'PHONE'   => $request->get('phone'),
            'MMERGE2' => $request->get('purpose'),
            'MMERGE2' => $request->get('industry'),
            'MMERGE5' => $request->get('purpose'),
            'MMERGE3' => $request->get('time'),
        ];
    }

    /**
     * get data for newsletter
     *
     * @param $request
     * @param $type
     * @return array
     */
    private function inputTypeNewsletter($request)
    {
        return [
            'MMERGE3' => $request->get('name'),
        ];
    }

    /**
     * convert input to string
     *
     * @param $request
     * @return string
     */
    private function filterDataContent($request)
    {
        $data = $request->all();

        $string_array = [];
        foreach ($data as $key => $value) {
            if ($key !== '_token' && $key !== '_method') {
                $string_array[] = '"'.$key.'":"'.$value.'"';
            }
        }

        return $string_array ? '{'.implode(',', $string_array).'}' : '';
    }
}
