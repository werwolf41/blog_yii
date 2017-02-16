<?php

use yii\db\Migration;

/**
 * Handles adding auth_and_other to table `users`.
 */
class m170216_101256_add_auth_and_other_column_to_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('users', 'password');
        $this->dropColumn('users', 'sold');
        $this->addColumn('users', 'auth_key', $this->string(32));
        $this->addColumn('users', 'password_hash', $this->string(255)->unique());
        $this->addColumn('users', 'password_reset_token', $this->string(255));
        $this->addColumn('users', 'status', $this->smallInteger(6)->notNull()->defaultValue(10));
        $this->alterColumn('users', 'name',$this->string(255)->unique());
        $this->alterColumn('users', 'email', $this->string(255)->unique());

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('users', 'sold', $this->string(255));
        $this->addColumn('users', 'password', $this->string(255));
        $this->dropColumn('users', 'auth_key');
        $this->dropColumn('users', 'password_hash');
        $this->dropColumn('users', 'password_reset_token');
        $this->dropColumn('users', 'status');
    }
}
