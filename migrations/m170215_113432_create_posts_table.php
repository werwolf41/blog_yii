<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts`.
 */
class m170215_113432_create_posts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(11),
            'title'=> $this->string(255)->notNull(),
            'desctiption'=> $this->string(300)->notNull(),
            'content'=>$this->text()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'user_id'=>$this->integer(11),
            'image'=>$this->string(),
        ]);

        $this->createIndex('idx_posts_user_id', 'posts', 'user_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('posts');
    }
}
