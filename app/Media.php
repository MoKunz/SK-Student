<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Media
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $type
 * @property string $url
 * @property string $title
 * @property string $alt
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Media whereAlt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Media whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Media whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Media whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Media whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Media whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Media whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Media whereUserId($value)
 * @mixin \Eloquent
 */
class Media extends Model
{
    //
}
