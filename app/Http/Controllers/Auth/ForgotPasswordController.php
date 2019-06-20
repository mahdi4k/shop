<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Category;
use View;
use App\lib\Mobile_Detect;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected  $view;
    public function __construct()
    {

        $detect = new Mobile_Detect();
        if($detect->isMobile() || $detect->isTablet())
        {
            $this->view='mobile.';
        }
        else
        {
            $this->view='';
        }

        $this->middleware('guest');
        $cat=Category::where('parent_id',0)->get();
        View::share('category',$cat);
    }

    public function showLinkRequestForm()
    {
        $view_name=$this->view.'auth.passwords.email';
        return view($view_name);
    }
    public function username()
    {
        return 'username';
    }

}
