<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m170215_114016_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(11),
            'title'=>$this->string(255)->notNull(),
            'user_id'=>$this->integer(11),
        ]);
        $this->createIndex('idx_category_user_id', 'category', 'user_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category');
    }
}
