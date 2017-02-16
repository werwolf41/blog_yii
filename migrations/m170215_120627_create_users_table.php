<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m170215_120627_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(11),
            'name'=>$this->string(255),
            'email'=>$this->string(255),
            'password'=>$this->string(255),
            'sold'=>$this->string(32),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'last_sing_in' => $this->datetime(),
        ]);

        $this->addForeignKey('fk_posts_user_id_users_id', 'posts', 'user_id', 'users', 'id');
        $this->addForeignKey('fk_category_user_id_users_id', 'category', 'user_id', 'users', 'id');
        $this->addForeignKey('fk_tags_user_id_users_id', 'tags', 'user_id', 'users', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_tags_user_id_users_id', 'tags');
        $this->dropForeignKey('fk_category_user_id_users_id', 'category');
        $this->dropForeignKey('fk_posts_user_id_users_id', 'posts');
        $this->dropTable('users');
    }
}
