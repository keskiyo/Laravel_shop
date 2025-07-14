<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Registered;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function resend(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->back()->with('error', 'Пользователь не авторизован');
        }
        
        if ($user->hasVerifiedEmail()) {
            return redirect()->back()->with('error', 'Email уже подтвержден');
        }
        
        $lastResendTime = Session::get('last_resend_time');
        $currentTime = time();
        
        if ($lastResendTime && ($currentTime - $lastResendTime) < 15) {
            $timeLeft = 15 - ($currentTime - $lastResendTime);
            return redirect()->back()
                ->with('error', 'Пожалуйста, подождите перед повторной отправкой')
                ->with('can_resend', false)
                ->with('resend_time', $timeLeft);
        }
        
        event(new Registered($user));
        
        Session::put('last_resend_time', $currentTime);
        
        return redirect()->back()
            ->with('success', 'Письмо для подтверждения отправлено повторно')
            ->with('can_resend', false)
            ->with('resend_time', 15);
    }
}
