<?php

namespace common\models\user\form;

use Yii;
use common\models\Basic;
use common\models\user\User;
/**
 * Базовая авторизация пользователя
 *
 * Class BasicLogin
 * @package app\models\form
 */
class LoginPasswordForm extends Basic
{
    /**
     * ID Пользователя
     *
     * @var
     */
    public $id;

    /**
     * Логин пользователя
     *
     * @var
     */
    public $user_login;

    /**
     * Пароль пользователя
     *
     * @var
     */
    public $user_password;

    /**
     * Экземпляр класса модели пользователя
     *
     * @var
     */
    public $identity;

    /**
     * Функция инциализации после загрузки (можно активировать в ручную)
     */

    /**
     * Нименование атрибутов
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_login' => 'Имя пользователя',
            'user_password' => 'Пароль пользователя',
        ];
    }


    public function afterLoad()
    {

        if (!empty($this->user_login) && User::find()->where(['user_login' => $this->user_login])->exists()) {
            $this->identity = User::findOne(['user_login' => $this->user_login]);
        }

        $this->id = ($this->identity) ? $this->identity->id : FALSE;
    }

    /**
     * Валидация формы
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['user_login', 'user_password'], 'string', 'max' => 255,],
        ];
    }

    /**
     * Базовая авторизация
     *
     * @return bool
     */
    public function basicLogin()
    {
        $groupe_true = FALSE;

		$identity = User::findOne(['id' => $this->id]);

		if ($identity && $identity->validatePassword($this->user_password)) {
			Yii::$app->user->login($identity,3600 * 24 * 30);
			return TRUE;
		}

        return FALSE;
    }



}