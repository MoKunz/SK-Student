<?php

namespace App\Http\Controllers\App;

use App\ActivityDayClub;
use App\ActivityDayCode;
use App\ActivityDayPopcorn;
use App\ActivityDayVoter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityDayOTP;
use App\Http\Requests\ActivityDayVote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActivityDayController extends Controller
{
    public function vote(ActivityDayVote $request)
    {
        $voter = ActivityDayVoter::where('phone_number', $request->get('phone'))->first();
        if (!empty($voter)) {
            $code = $voter->code;
            if (!empty($code)) {
                if ($request->get('otp') === $code->otp) {
                    // register the vote
                    $clubID = $request->get('club');
                    $code->delete();
                    $voter->club_id = $clubID;
                    $voter->save();
                    return [
                        'success' => true,
                        'message' => 'Your vote has been registered!'
                    ];
                } else {
                    // reject
                    return [
                        'success' => false,
                        'message' => 'Invalid OTP!'
                    ];
                }
            } else {
                return response(['success' => false, 'message' => 'You must request the otp first!'], 403);
            }
        } else {
            return response(['success' => false, 'message' => 'Phone number not found!'], 404);
        }
    }

    public function status(Request $request)
    {
        /** @var ActivityDayVoter $voter */
        $voter = ActivityDayVoter::where('phone_number', $request->get('phone'))->first();
        if (!empty($voter)) {
            // voted
            if ($voter->club_id != null) {
                // try to query popcorn
                return [
                    'voted' => true,
                    'popcorn' => $this->popcornTaken($voter)
                ];
            }
        }
        return [
            'voted' => false,
            'popcorn' => false,
        ];
    }

    public function popcorn(Request $request)
    {
        /** @var ActivityDayVoter $voter */
        $voter = ActivityDayVoter::where('phone_number', $request->get('phone'))->first();
        if (!$this->popcornTaken($voter)) {
            // check password
            $pass = env('ACTIVITY_DAY_POPCORN');
            if ($pass == $request->get('pass')) {
                $popcorn = new ActivityDayPopcorn();
                $popcorn->voter_id = $voter->id;
                $popcorn->save();
                return [
                    'success' => true,
                    'message' => 'Success!'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Invalid password!'
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'You have already taken a popcorn.'
            ];
        }
    }

    private function popcornTaken($voter)
    {
        if (!empty($voter)) {
            if (ActivityDayPopcorn::where('voter_id', $voter->id)->count()) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function clubs()
    {
        return ActivityDayClub::select('id', 'name')->orderBy('name')->get()->toArray();
    }

    public function requestOTP(ActivityDayOTP $request)
    {
        $userAgent = $request->get('userAgent');
        $voter = ActivityDayVoter::where('phone_number', $request->get('phone'))->first();
        $message = '';
        $success = true;
        $ref = '';
        if (!empty($voter) && $voter->club_id != null) {
            $success = false;
            $message = 'This phone number has already been used.';
        } else {
            $voter = $voter ?? new ActivityDayVoter();
            $voter->student_id = 55555;
            $voter->user_agent = $userAgent;
            $voter->phone_number = $request->get('phone');
            $voter->club_id = null;
            $voter->ip_address = $request->ip();
            $voter->save();
            $code = ActivityDayCode::firstOrNew(['voter_id' => $voter->id]);
            $code->reference = strtolower(str_random(6));
            $code->otp = random_int(100000, 999999);
            $code->voter_id = $voter->id;
            if ($this->sendSMS($voter->phone_number, $code->otp, $code->reference)) {
                $code->save();
                $ref = $code->reference;
                $message = 'OTP has been generated and sent to following phone number (' . $voter->phone_number . ')';
            } else {
                $code->delete();
                $voter->delete();
                $success = false;
                $message = 'Problem while sending sms, please make sure your mobile phone number is valid and try again later.';
            }
        }
        return [
            'success' => $success,
            'message' => $message,
            'ref' => $ref,
        ];
    }

    /**
     *
     * @param $phone
     * @param $ref
     * @return bool
     */
    private function sendSMS($phone, $pin, $ref)
    {
        if (env('SMS_DEBUG', false))
            return true;
        $username = env('SMS_USERNAME');
        $password = env('SMS_PASSWORD');
        $message = urlencode("#SKActivityPark\nVOTE PIN: " . $pin . " (Ref:" . $ref . ")\nMore info: skkornor.com");
        $phoneList = $phone;
        $sender = 'SMSMKT.COM';
        $parameter = 'User=' . $username . '&Password=' . $password . '&Msnlist=' . $phoneList . '&Msg=' . $message . '&Sender=' . $sender;
        $API_URL = 'http://member.smsmkt.com/SMSLink/SendMsg/index.php';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);

        $result = explode(',', curl_exec($ch));
        $status = explode('=', $result[0])[1];
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        info(Carbon::now()->toDateTimeString() . ' Raw response: ' . $result);
        curl_close($ch);
        if ($code == 200 && intval($status) == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function summary()
    {
        $voters = ActivityDayVoter::all()->groupBy('club_id');
        $votersMap = [];
        foreach ($voters as $key => $value) {
            $votersMap[$key]["count"] = count($value);
            if (isset($value[0]->club)) $votersMap[$key]["name"] = $value[0]->club->name;
        }
        sort($votersMap);
        return $votersMap;
    }

}
