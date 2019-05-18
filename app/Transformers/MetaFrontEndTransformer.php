<?php

namespace App\Transformers;

use App\Models\Meta;
use Flugg\Responder\Transformers\Transformer;

class MetaFrontEndTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param \App\Models\Meta $meta
     * @return array
     */
    public function transform(Meta $meta)
    {
        return [
            $meta->meta_key => $meta->meta_value,
        ];
    }

    /**
     * transform to Array
     *
     * @param $metas
     * @return array
     */
    public function transformArray($metas)
    {
        $result = [];
        foreach ($metas as $meta) {
            if ($meta->meta_key === 'seo') {
                $result[$meta->meta_key] = $this->transformSeo($meta->meta_value);
            } else {
                $result[$meta->meta_key] = $meta->meta_value;
            }
        }

        return $result;
    }

    /**
     * transform Seo data
     *
     * @param $data
     * @return array
     */
    private function transformSeo($data)
    {
        $result = [];
        foreach ($data as $item) {
            $result[$item['locale']] = $item;
        }

        return $result;
    }
}
