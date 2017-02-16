<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts_has_tags".
 *
 * @property integer $id
 * @property integer $posts_id
 * @property integer $tags_id
 *
 * @property Tags $tags
 * @property Posts $posts
 */
class PostsHasTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts_has_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['posts_id', 'tags_id'], 'integer'],
            [['tags_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['tags_id' => 'id']],
            [['posts_id'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::className(), 'targetAttribute' => ['posts_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'posts_id' => 'Posts ID',
            'tags_id' => 'Tags ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tags_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasOne(Posts::className(), ['id' => 'posts_id']);
    }
}
