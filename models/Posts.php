<?php

namespace app\models;

use Yii;
use yii\base\Security;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $desctiption
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $image
 *
 * @property Users $user
 * @property PostsHasCategory[] $postsHasCategories
 * @property PostsHasTags[] $postsHasTags
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
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
            [['title', 'desctiption', 'content', 'created_at'], 'required'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['desctiption'], 'string', 'max' => 300],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'desctiption' => 'Описание',
            'content' => 'Текст',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
            'user_id' => 'Автор',
            'image' => 'Изображение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostsHasCategories()
    {
        return $this->hasMany(PostsHasCategory::className(), ['posts_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostsHasTags()
    {
        return $this->hasMany(PostsHasTags::className(), ['posts_id' => 'id']);
    }
}
