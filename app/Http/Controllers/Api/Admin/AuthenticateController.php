<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\CheckExpiredRequest;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Admin\Auth\ResetPasswordRequest;
use App\Http\Requests\Admin\Auth\SendEmailResetPasswordRequest;
use App\Services\Auth\Admin\CheckExpiredService;
use App\Services\Auth\Admin\LoginService;
use App\Services\Auth\Admin\ResetPasswordService;
use App\Services\Auth\Admin\SendMailResetPasswordService;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    private $loginService;
    private $resetPasswordService;
    private $sendMailResetPassService;

    public function __construct(
        LoginService $loginService,
        ResetPasswordService $resetPasswordService,
        SendMailResetPasswordService $sendMailResetPassService
    ) {
        $this->loginService = $loginService;
        $this->resetPasswordService = $resetPasswordService;
        $this->sendMailResetPassService = $sendMailResetPassService;
    }

    /**
     * login user
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $result = $this->loginService
            ->setRequest($request)
            ->handle();

        return response()->success($result);
    }

    /**
     * get info user
     *
     * @return \Illuminate\Http\Response
     */
    public function getInfo()
    {
        $admin = Auth::user();

        return response()->success(['currentUser' => $admin]);
    }


    /**
     * logout user
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        return response()->successWithoutData();
    }

    /**
     * reset password user
     *
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $response = $this->resetPasswordService
            ->setRequest($request)
            ->handle();

        return response()->success($response);
    }


    /**
     * check expired url
     *
     * @return \Illuminate\Http\Response
     */
    public function checkExpired(CheckExpiredRequest $request)
    {
        $response = resolve(CheckExpiredService::class)
            ->setRequest($request)
            ->handle();

        return response()->success($response);
    }

    /**
     * send email to reset password
     *
     * @return \Illuminate\Http\Response
     */
    public function sendEmailResetPassword(SendEmailResetPasswordRequest $request)
    {
        $this->sendMailResetPassService
            ->setRequest($request)
            ->handle();

        return response()->successWithoutData();
    }
}
