<?php

namespace app\models;

use Yii;
use yii\base\Security;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;


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
class Users extends \yii\db\ActiveRecord
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
            [['sold'], 'integer'],
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
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tags::className(), ['user_id' => 'id']);
    }


}
