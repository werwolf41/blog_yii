<?php

namespace app\models;

use Yii;
use yii\base\Security;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;


/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $sold
 * @property string $created_at
 * @property string $updated_at
 * @property string $last_sing_in
 *
 * @property Category[] $categories
 * @property Posts[] $posts
 * @property Tags[] $tags
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface

{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                 'value' => new Expression('NOW()'),
            ]

        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sold'], 'string', 'max'=>32],
            [['name', 'email', 'password'], 'required'],
            [['created_at', 'updated_at', 'last_sing_in'], 'safe'],
            [['name', 'email', 'password'], 'string', 'max' => 255],
            ['email', 'email'],
            [['email', 'password'], 'string', 'min'=>6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'sold' => 'Sold',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'last_sing_in' => 'Last Sing In',
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
