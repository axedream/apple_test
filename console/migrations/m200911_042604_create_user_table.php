<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m200911_042604_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'user_login' => $this->string(),
            'user_password' => $this->string(),
        ]);

        //Creating default user name
        $model = new \common\models\user\User;
        $model->user_login = 'admin';
        $model->setUserPassword('tomas4321');
        $model->save();


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
