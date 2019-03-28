<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Taxonomy
 *
 * @property int $id
 * @property string $type
 * @property int $parent_id
 * @property int $position
 * @property int $real_depth
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taxonomy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taxonomy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taxonomy query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taxonomy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taxonomy whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taxonomy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taxonomy whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taxonomy wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taxonomy whereRealDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taxonomy whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Taxonomy whereUpdatedAt($value)
 */
	class Taxonomy extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $tilte
 * @property string|null $description
 * @property string|null $content
 * @property int $publish
 * @property string|null $type
 * @property string|null $slug
 * @property string|null $thumbnail
 * @property int $created_by
 * @property int $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostMeta[] $postMeta
 * @property-read \Franzose\ClosureTable\Extensions\Collection|\App\Models\Taxonomy[] $taxonomies
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePublish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereTilte($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post withoutTrashed()
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostMeta
 *
 * @property int $id
 * @property int $post_id
 * @property string $meta_key
 * @property string $meta_value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMeta whereMetaKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMeta whereMetaValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMeta wherePostId($value)
 */
	class PostMeta extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostTaxonomy
 *
 * @property int $id
 * @property int $taxonomy_id
 * @property int $post_id
 * @property int $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTaxonomy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTaxonomy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTaxonomy query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTaxonomy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTaxonomy whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTaxonomy wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTaxonomy whereTaxonomyId($value)
 */
	class PostTaxonomy extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $type
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Hierarchy
 *
 * @property int $id
 * @property int $ancestor
 * @property int $descendant
 * @property int $depth
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hierarchy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hierarchy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hierarchy query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hierarchy whereAncestor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hierarchy whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hierarchy whereDescendant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hierarchy whereId($value)
 */
	class Hierarchy extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Faq
 *
 * @property int $id
 * @property string $tilte
 * @property string|null $description
 * @property string|null $content
 * @property int $publish
 * @property string|null $type
 * @property string|null $slug
 * @property string|null $thumbnail
 * @property int $created_by
 * @property int $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostMeta[] $postMeta
 * @property-read \Franzose\ClosureTable\Extensions\Collection|\App\Models\Taxonomy[] $taxonomies
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq wherePublish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereTilte($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faq whereUpdatedBy($value)
 */
	class Faq extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $type
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

