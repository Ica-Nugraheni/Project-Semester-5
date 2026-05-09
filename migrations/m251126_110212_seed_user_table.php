<?php

use yii\db\Migration;

class m251126_110212_seed_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'username'      => 'admin',
            'password'      => Yii::$app->security->generatePasswordHash('admin123'),
            'nama_lengkap'  => 'Administrator',
            'email'         => 'admin@gmail.com',
            'role'          => 'admin',
        ]);

        $this->insert('user', [
            'username'      => 'pengawas',
            'password'      => Yii::$app->security->generatePasswordHash('pengawas123'),
            'nama_lengkap'  => 'Pengawas Sistem',
            'email'         => 'pengawas@gmail.com',
            'role'          => 'pengawas',
        ]);
    }
    
    public function safeDown()
    {
        $this->delete('user', ['username' => 'admin']);
        $this->delete('user', ['username' => 'pengawas']);
    }
    
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251126_110212_seed_user_table cannot be reverted.\n";

        return false;
    }
    */
}
