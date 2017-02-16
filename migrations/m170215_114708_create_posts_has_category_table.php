<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts_has_category`.
 */
class m170215_114708_create_posts_has_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('posts_has_category', [
            'id' => $this->primaryKey(),
            'posts_id'=> $this->integer(11),
            'category_id'=>$this->integer(11),
        ]);

        $this->createIndex('idx_posts_has_category_posts_id', 'posts_has_category', 'posts_id');

        $this->addForeignKey('fk_posts_posts_has_category_posts_id', 'posts_has_category', 'posts_id', 'posts', 'id');

        $this->createIndex('idx_posts_has_category_category_id', 'posts_has_category', 'category_id');

        $this->addForeignKey('fk_posts_has_category_category_id', 'posts_has_category', 'category_id', 'category', 'id');

    }



    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_posts_has_category_category_id', 'posts_has_category');
        $this->dropIndex('idx_posts_has_category_category_id', 'posts_has_category');
        $this->dropForeignKey('fk_posts_posts_has_category_posts_id', 'posts_has_category');
        $this->dropIndex('idx_posts_has_category_posts_id', 'posts_has_category');
        $this->dropTable('posts_has_category');
    }
}
