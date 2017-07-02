<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\ActivityDayClub
 *
 * @property int $id
 * @property string $name
 * @property string $english_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayClub whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayClub whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayClub whereEnglishName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayClub whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayClub whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayClub whereUpdatedAt($value)
 */
    class ActivityDayClub extends \Eloquent
    {
    }
}

namespace App{
/**
 * App\ActivityDayVote
 *
 * @property int $voter_id
 * @property int $club_id
 * @property string $voted_at
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVote whereClubId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVote whereVotedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVote whereVoterId($value)
 */
    class ActivityDayVote extends \Eloquent
    {
    }
}

namespace App {
    /**
     * App\ActivityDayVoter
     *
     * @property int $id
     * @property int $student_id
     * @property int $grade
     * @property string $phone_number
     * @property string $ip_address
     * @property string $userAgent
     * @property \Carbon\Carbon $created_at
     * @property \Carbon\Carbon $updated_at
     * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereCreatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereGrade($value)
     * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereIpAddress($value)
     * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter wherePhoneNumber($value)
     * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereStudentId($value)
     * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereUpdatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\App\ActivityDayVoter whereUserAgent($value)
     */
    class ActivityDayVoter extends \Eloquent
    {
    }
}

namespace App {
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
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\News[] $news
     */
    class Media extends \Eloquent
    {
    }
}

namespace App {
    /**
 * App\News
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $slug
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
     * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\News whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News whereUserId($value)
     * @mixin \Eloquent
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $media
 */
	class News extends \Eloquent {}
}

namespace App{
/**
 * App\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property bool $default
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereDefault($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Permission extends \Eloquent {}
}

namespace App{
/**
 * App\Role
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Role extends \Eloquent {}
}

namespace App{
/**
 * App\Tag
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\News[] $news
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Tag extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $api_token
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\User whereApiToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

