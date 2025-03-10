<?php
namespace App\Http\Logins;
use App\Helper\Responses;
use App\Http\Controllers\Controller;
use App\Http\Requests\OtpLoginRequest;
use App\Jobs\SendSmsJob;
use App\Models\User;
use App\Traits\OtpTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OtpController extends Controller
{
    use OtpTrait;

    public function __construct(protected Responses $responses)
    {
    }

    public function index(Request $request)
    {
        $mobile = $request->mobile;
        $name = $request->name;

        $codeRandom = generateCodeRandom();
        $text = 'کد تایید:' . $codeRandom . PHP_EOL . ' گروه فناوری اطلاعات';

         //if is users ok
        if ($user = User::where(['mobile' => $mobile])->first()) {
            SendSmsJob::dispatchSync($mobile, $text);
            Log::info('send sms', ['result' => $mobile, $codeRandom]);
            $this->setCacheAddMinutes($codeRandom, 'otp_code', $codeRandom, 'getUser', $user);
            return $this->responses->success($user, trans('validation.success'));
         }
          ///mobile and
        if($mobile && $name ) {
            $result = User::create(['name' => $name, 'mobile' => $mobile, 'email' => $mobile . '@gmail.com', 'password' => $mobile]);
            $result->roles()->attach(2);
            if ($result) {
                SendSmsJob::dispatchSync($mobile, $text);
                Log::info('send sms', ['result' => $mobile, $codeRandom]);
                $this->setCacheAddMinutes($codeRandom, 'otp_code', $codeRandom, 'getUser', $user);

                return $this->responses->success($result, trans('validation.success'));
            }
        }
        if($mobile) {
            return $this->responses->success('', trans('validation.success'));
        }

        return $this->responses->notFound('', trans('validation.Otp_search'));
    }
    /**
     * Display a listing of the resource.
     */
    public function store(OtpLoginRequest  $request)
    {
        $code = $request['code'];
        $otpCode = $this->getCache('otp_code', $code);

        if ($otpCode != $code) {
            return $this->responses->notFound('', trans('validation.errOtp'));
        }

        if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->mobile], true)) {
            $accessToken = 'Bearer ' . Auth::user()->createToken('Laravel spuutouts')->accessToken;
            return $this->responses->successLogin([
                'list' => User::with('roles')->where(['id' => Auth::id()])->first(),
                'access_token' => $accessToken,
            ], trans('auth.success-message'), $accessToken);
        }
        return Responses::create()->notFound('', trans('auth.account-not-found'));
    }



    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
