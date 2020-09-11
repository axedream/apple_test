<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;

class Basic extends ActiveRecord
{
    public $session;


    /**
     * Первичная инициализация для всех моделей
     */
    public function init()
    {
        if (isset(Yii::$app->session)   ) {
            $this->session = Yii::$app->session;
            if (!$this->session->isActive) {
                $this->session->open();
            }
        }
    }
}