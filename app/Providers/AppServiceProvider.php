<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as BaseValidator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserController::class, function(){
           return new UserController(new HomeController("hello"));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend("notContainNumbers", function($atrr, $value, $params=[], BaseValidator $validator){
            if($value){
                if(preg_match('~[0-9]+~', $value)){
                    return false;
                }
            }
            return true;
        });
        Validator::replacer("notContainNumbers", function($message, $attr, $rule, $params){
            return $attr . " can not contain numbers.";
        });

        Validator::extend("adult", function($atrr, $value, $params=[], BaseValidator $validator){
            $now = new DateTime(date("Y-m-d"));
            $date = new DateTime($value);
            $interval = $now->diff($date);
            if($interval->y < 21){
                return false;
            }
            return true;
        });
        Validator::replacer("adult", function($message, $attr, $rule, $params){
            return "Your age must be at least 21.";
        });
        Validator::extend("beforeNow", function($atrr, $value, $params=[], BaseValidator $validator){
            $now = date("Y-m-d");
            if($value > $now){
                return false;
            }
            return true;
        });
        Validator::replacer("beforeNow", function($message, $attr, $rule, $params){
            return "You are not born yet!";
        });

    }
}
