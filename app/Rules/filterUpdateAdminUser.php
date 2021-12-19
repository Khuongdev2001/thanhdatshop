<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Input;
class filterUpdateAdminUser implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->log=null;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /* Check Updater Is Login */
        $userLogin=Auth::user();
        if(request("id")!=$userLogin->user_id){
            $this->log = "Không Thể Cập Nhật T.Tin N.Khác!";
            return false;
        }
        /* Check Mail Exist */
        $user=User::where("email",$value)->where("user_id","<>",request("id"))->first();
        if($user){
            $this->log= "Email đã tồn tại hệ thống!";
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->log;
    }
}
