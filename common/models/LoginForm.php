<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\user\User;

class LoginForm extends Model
{
    public $userlogin;
    public $password;
    public $rememberMe = true;

    private $_user;

    public function rules()
    {
        return [
            [['userlogin', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Не верное имя пользователя или пароль.');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userlogin' => 'Имя пользователя',
            'password' => 'Пароль пользователя',
            'rememberMe'=> 'Запомнить меня',
        ];
    }


    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->userlogin);
        }

        return $this->_user;
    }
}
