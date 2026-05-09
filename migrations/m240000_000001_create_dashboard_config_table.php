<?php
use yii\db\Migration;

/**
 * Handles the creation of table `{{%dashboard_config}}`.
 */
class m240000_000001_create_dashboard_config_table extends Migration
{
    /** {@inheritdoc} */
    public function safeUp()
    {
        $this->createTable('{{%dashboard_config}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string(255)->notNull()->unique(),
            'label' => $this->string(255)->notNull(),
            'value' => $this->text()->null(),
            'note' => $this->text()->null(),
            'meta' => $this->text()->null(),
            'sort' => $this->integer()->defaultValue(0),
            'visible' => $this->tinyInteger(1)->notNull()->defaultValue(1),
        ]);

        // Insert default sample widgets
        $this->batchInsert('{{%dashboard_config}}', ['key','label','value','note','sort','visible'], [
            ['total_guru','Total Guru','87','+3 guru baru bulan ini',10,1],
            ['total_siswa','Total Siswa','1,234','+32 siswa baru tahun ini',20,1],
            ['total_dokumen','Total Dokumen','2,847','+128 dokumen bulan ini',30,1],
            ['dokumen_diterapkan','Dokumen Diterapkan','2,459','+1.2% dari total dokumen',40,1],
        ]);
    }

    /** {@inheritdoc} */
    public function safeDown()
    {
        $this->dropTable('{{%dashboard_config}}');
    }
}
