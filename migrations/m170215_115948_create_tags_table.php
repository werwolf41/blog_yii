<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tags`.
 */
class m170215_115948_create_tags_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tags', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255)->notNull(),
            'user_id'=>$this->integer(11),
        ]);

        $this->createIndex('idx_tags_user_id', 'tags', 'user_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tags');
    }
}
