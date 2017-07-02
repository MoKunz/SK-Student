<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ActivityDayClub
 *
 * @property int $id
 * @property string $name
 * @property string $english_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActivityDayVoter[] $voters
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayClub whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayClub whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayClub whereEnglishName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayClub whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayClub whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayClub whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ActivityDayClub extends Model
{
    public function voters()
    {
        return $this->hasMany('App\ActivityDayVoter', 'club_id');
    }
}
