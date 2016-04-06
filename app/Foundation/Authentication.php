<?php

namespace App\Foundation;

use SAuth;
use Validator;

use App\User;
use App\Oldmember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;


/**
 *
 *  2016/04/06 框架改写重构
 *
 *  因为没部署版本控制，一次意外的composer update使得代码遗失
 *
 *  以此警示
 *
 *  @author  alsKtpt <[<ktpt@me.com>]>
 * 
 */
trait Authentication
{

    protected $errorInfo = [];

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {

        return view($this->getLoginView());
    }


    protected function getLoginView()
    {
        return property_exists($this, 'loginView') ? $this->loginView : 'auth.login';
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        $credentials = $this->getCredentials($request);


        if ($this->loginAttempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors($this->errorInfo);
    }

    protected function loginAttempt(array $credentials = [], $remember = FALSE)
    {
        $Oldmember = Oldmember::where('sid', $credentials['sid'])->get();
        if (isset($Oldmember[0])) 
        {
            
        }
        else
        {
            array_push($this->errorInfo, '用户不存在！');
            return FALSE;
        }
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request)
    {

        return redirect()->intended($this->getRedirectPath());
    }


    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only($this->loginUsername(), 'password');
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'These credentials do not match our records.';
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        SAuth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }

}
