<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ActivityDayCode
 *
 * @property int $id
 * @property int $voter_id
 * @property string $reference
 * @property string $otp
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\ActivityDayVoter $voter
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayCode whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayCode whereOtp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayCode whereReference($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayCode whereVoterId($value)
 * @mixin \Eloquent
 */
class ActivityDayCode extends Model
{
    protected $fillable = ['voter_id'];

    public function voter()
    {
        return $this->belongsTo('App\ActivityDayVoter', 'voter_id');
    }
}
