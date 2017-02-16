<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts_has_tags`.
 */
class m170215_120049_create_posts_has_tags_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('posts_has_tags', [
            'id' => $this->primaryKey(),
            'posts_id'=> $this->integer(11),
            'tags_id'=>$this->integer(11),
        ]);

        $this->createIndex('idx_posts_has_tags_posts_id', 'posts_has_tags', 'posts_id');

        $this->addForeignKey('fk_posts_posts_has_tags_posts_id', 'posts_has_tags', 'posts_id', 'posts', 'id');

        $this->createIndex('idx_posts_has_tags_tags_id', 'posts_has_tags', 'tags_id');

        $this->addForeignKey('fk_posts_has_tags_tags_id', 'posts_has_tags', 'tags_id', 'tags', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_posts_has_tags_tags_id', 'posts_has_tags');
        $this->dropIndex('idx_posts_has_tags_tags_id', 'posts_has_tags');
        $this->dropForeignKey('fk_posts_posts_has_tags_posts_id', 'posts_has_tags');
        $this->dropIndex('idx_posts_has_tags_posts_id', 'posts_has_tags');
        $this->dropTable('posts_has_tags');
    }
}
