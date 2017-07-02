<?php

namespace App\Http\Controllers\App;

use App\ActivityDayClub;
use App\ActivityDayCode;
use App\ActivityDayVoter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityDayOTP;
use App\Http\Requests\ActivityDayVote;
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
            $code->save();
            $this->sendSMS($voter->phone_number, $code->reference);
            $ref = $code->reference;
            $message = 'OTP has been generated and sent to following phone number (' . $voter->phone_number . ')';
        }
        return [
            'success' => $success,
            'message' => $message,
            'ref' => $ref,
        ];
    }

    /**
     * TODO: IMPLEMENT THIS ASAP
     * @param $phone
     * @param $ref
     */
    private function sendSMS($phone, $ref)
    {

    }

}
