<?php

namespace App\Transformers;

use App\Models\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    /**
     * transform json for meta
     *
     * @param \App\Models\Post $post
     * @return array
     */
    public function transformWithMeta(Post $post)
    {
        // transform meta
        $postMetaArray = $post->postMeta;
        if ($postMetaArray) {
            foreach ($postMetaArray as $postMeta) {
                $postMetaResult[$postMeta->meta_key] = $postMeta->meta_value;
            }
        }

        return [
            'id'          => $post->id,
            'title'       => $post->title,
            'content'     => $post->content,
            'description' => $post->description,
            'publish'     => $post->publish,
            'slug'        => $post->slug,
            'media'       => $post->media,
            'meta'        => isset($postMetaResult) ? $postMetaResult : [],
            'created_at'  => $post->created_at,
            'created_by'  => $post->created_by,
            'updated_at'  => $post->updated_at,
            'updated_by'  => $post->updated_by,
        ];
    }
}
