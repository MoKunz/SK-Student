<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ActivityDayVoter
 *
 * @property int $id
 * @property int $student_id
 * @property int $grade
 * @property string $phone_number
 * @property string $ip_address
 * @property string $user_agent
 * @property int $club_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\ActivityDayClub $club
 * @property-read \App\ActivityDayCode $code
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereClubId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereGrade($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereIpAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter wherePhoneNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereStudentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereUserAgent($value)
 * @mixin \Eloquent
 */
class ActivityDayVoter extends Model
{
    public function code()
    {
        return $this->hasOne('App\ActivityDayCode', 'voter_id');
    }

    public function club()
    {
        return $this->belongsTo('App\ActivityDayClub', 'club_id');
    }
}
