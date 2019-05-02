<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class SettingComposer
{
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
    protected function getSettingInformation()
    {
        if (Cache::has('siteOptionSetting')) {
            return Cache::get('siteOptionSetting');
        } else {
            $filterArray = ['introduction', 'banner', 'seo'];

            $options = \App\Models\Option::get()->map(function ($value) use ($filterArray) {
                if (in_array($value->option_name, $filterArray)) {
                    $option_value = (array) json_decode($value->option_value);

                    if ($value->option_name === 'seo') {
                        return [$value->option_name => array_combine(array_column($option_value, 'locale'), $option_value)];
                    } else {
                        $option_value['content'] = [];

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