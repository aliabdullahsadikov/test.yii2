<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * ContactForm is the model behind the contact form.
 */
class SignupForm extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [

            [['email','password'],'required'],
            ['email','unique','targetClass'=>'app\models\User'],
            ['password','string','min'=>2,'max'=>10]
        ];
    }

    public function signup()
    {
        $user = new User();
        $user->email = $this->email;
        $user->setPassword($this->password);
        return $user->save(); //вернет true или false
    }


}
