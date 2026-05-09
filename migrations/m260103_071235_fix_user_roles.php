<?php

use yii\db\Migration;

class m260103_071235_fix_user_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Update users with empty or null role to 'pengawas'
        $this->update('user', ['role' => 'pengawas'], ['OR', ['role' => null], ['role' => '']]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260103_071235_fix_user_roles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260103_071235_fix_user_roles cannot be reverted.\n";

        return false;
    }
    */
}
