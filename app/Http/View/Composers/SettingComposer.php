<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class SettingComposer
{
    /**
     * @var array
     */
    protected $filterArray = [
        'introduction',
        'banner',
        'seo',
        'about_seo',
        'event_seo',
        'results_seo',
        'why_seo',
        'resource_seo',
    ];

    /**
     * list seo in setting function
     *
     * @var array
     */
    protected $filterArraySeo = [
        'seo',
        'about_seo',
        'event_seo',
        'results_seo',
        'why_seo',
        'resource_seo',
    ];

    /**
     * @var default value
     */
    protected $setting;

    /**
     * SettingComposer constructor.
     */
    public function __construct()
    {
        $this->setting = $this->getSettingInformation();
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('setting', $this->setting);
    }

    /**
     * get all option information
     *
     * @return mixed
     */
    public function getSettingInformation()
    {
        if (Cache::has('siteOptionSetting')) {
            return Cache::get('siteOptionSetting');
        } else {
            $options = \App\Models\Option::get()->map(function ($value) {
                if (in_array($value->option_name, $this->filterArray)) {
                    $option_value = (array) json_decode($value->option_value);

                    if (in_array($value->option_name, $this->filterArraySeo)) {
                        return [$value->option_name => array_combine(array_column($option_value, 'locale'), $option_value)];
                    } else {
                        return [$value->option_name => $option_value];
                    }
                } else {
                    return [$value->option_name => $value->option_value];
                }
            })->collapse()->toArray();

            Cache::put('siteOptionSetting', $options, 60);
        }
    }
}