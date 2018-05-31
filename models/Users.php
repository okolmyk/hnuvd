<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $adminGroup
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName()
    {
        return '{{%users}}';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findByEmail($email)
    {
      return Users::find()->where(['email'=>$email])->one();
    }

    public static function findIdentityByAccessToken($token, $type = null){}

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }


    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['auth_key'], 'integer'],
            ['email', 'unique'],
            ['email', 'email'],
            [['adminGroup'], 'string'],
            [['email', 'password'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'adminGroup' => 'Admin Group',
            'auth_key' => 'Auth Key',
        ];
    }
}
