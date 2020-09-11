<?php

namespace common\models\user;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use common\models\Basic;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $status
 * @property string $user_name
 * @property string $user_password
 * @property string $user_email
 * @property int $user_groupe_id
 * @property int $user_groupe
 * @property int $on_org
 * @property int $on_saint
 * @property int $on_speaker
 * @property int $on_register
 * @property string $job
 * @property string $foto_url
 * @property string $auth_key_first
 * @property string $auth_key_second
 * @property string $user_middle_name
 * @property string $user_surname
 * @property string $user_first_name
 * @property string $auth_key
 * @property string $add_date
 * @property string $add_session
 * @property string $on_system
 * @property string $user_phone
 *
 */
class User extends Basic implements IdentityInterface
{

    const STATUS_WAIT       = 0;
    const STATUS_BLOCKED    = 5;
    const STATUS_ACTIVE     = 10;

    public $rememberMe = true;  //запомнить и оставить валидацию на 30 дней


    /**
     * Таблица пользователей
     *
     * @return string
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * Валидация
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['user_login'], 'match', 'pattern' => '#^[\w_-]+$#is'],
            [['user_login'], 'unique'],
            [['user_login', 'user_password'], 'string', 'max' => 255],
            [['status'], 'in', 'range' => array_keys(self::getStatusesArray())],
        ];
    }


    /**
     * Нименование полей
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID пользователя',
            'status' => 'Статус пользователя',
            'user_login' => 'Логин',
            'user_password' => 'Пароль',
        ];
    }

    /**
     * Получаем список статусов
     *
     * @return mixed
     * @throws \Exception
     */
    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    /**
     * Статусы пользователей
     *
     * @return array
     */
    public static function getStatusesArray()
    {
        return [
            self::STATUS_BLOCKED => 'Заблокирован',
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_WAIT => 'Ожидает подтверждения',
        ];
    }

    /**
     * Поиск по login пользователя
     *
     * @param $username
     * @return null|static
     */
    public static function findByUserlogin($user_login)
    {
        return static::findOne(['user_name' => $user_login, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Проверяем пароль
     *
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        if ($this->user_password == md5($password)) {
            return TRUE;
        } else {
            return FALSE;
        }
        //return Yii::$app->security->validatePassword($password, $this->user_password);
    }

    /**
     * Устанавливаем хэш пароля
     *
     * @param $user_password
     * @throws \yii\base\Exception
     */
    public function setUserPassword($user_password)
    {
        $this->user_password = md5($user_password);

    }

    /**
     * Находит экземпляр identity class используя ID пользователя
     *
     * @param int|string $id
     * @return void|IdentityInterface
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }


    /**
     * Возвращает ID пользователя
     *
     * @return int|mixed|string
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }


    /**
     * Пользователь ожидает проверки
     *
     * @return bool
     */
    public static function testUserHold($user_id)
    {
        if (User::findOne(['id' => $user_id, 'status'=>User::STATUS_WAIT])) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Пользователь заблокирован
     *
     * @return bool
     */
    public static function testUserStop($user_id)
    {
        if (User::findOne(['id' => $user_id, 'status'=>User::STATUS_BLOCKED])) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Пользователь активен
     *
     * @return bool
     */
    public static function testUserActive($user_id)
    {
        if (User::findOne(['id' => $user_id, 'status'=>User::STATUS_ACTIVE])) {
            return TRUE;
        }
        return FALSE;
    }


    /**
     * Разлогинивание пользователя
     */
    public static function logout()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }
    }


    /**
     * Получаем актуальную дату время
     *
     * @return string
     * @throws \Exception
     */
    public static function getNowDateTime()
    {
        $dateFile = new \DateTime();
        return $dateFile->format('Y-m-d H:i:s');
    }

    /**
     * Получаем актуальную дату
     *
     * @return string
     * @throws \Exception
     */
    public static function getNowDate()
    {
        $dateFile = new \DateTime();
        return $dateFile->format('Y-m-d');
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface|null the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled. The returned key will be stored on the
     * client side as a cookie and will be used to authenticate user even if PHP session has been expired.
     *
     * Make sure to invalidate earlier issued authKeys when you implement force user logout, password change and
     * other scenarios, that require forceful access revocation for old sessions.
     *
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
