<?php
use yii\db\Migration;

/**
 * Handles the creation of table `{{%page_settings}}`.
 */
class m251126_120000_create_page_settings_table extends Migration
{
    /** {@inheritdoc} */
    public function safeUp()
    {
        $this->createTable('{{%page_settings}}', [
            'id' => $this->primaryKey(),
            'setting_key' => $this->string(100)->notNull()->unique(),
            'setting_type' => $this->string(50)->notNull()->defaultValue('backend'), // frontend/backend
            'setting_group' => $this->string(50)->notNull()->defaultValue('general'), // general/theme/header/footer/brand/color
            'label' => $this->string(255)->notNull(),
            'value' => $this->text()->null(),
            'description' => $this->text()->null(),
            'updated_at' => $this->dateTime()->null(),
        ]);

        // Insert default settings for backend
        $this->batchInsert('{{%page_settings}}', 
            ['setting_key', 'setting_type', 'setting_group', 'label', 'value', 'description'], 
            [
                // Backend Brand Settings
                ['backend_brand_title', 'backend', 'brand', 'Nama Aplikasi (Backend)', 'E-Arsip Dokumen Sekolah', 'Nama aplikasi yang ditampilkan di sidebar backend'],
                ['backend_brand_subtitle', 'backend', 'brand', 'Subtitle (Backend)', 'Tata Usaha - Tata Usaha', 'Subtitle aplikasi di sidebar backend'],
                ['backend_brand_logo', 'backend', 'brand', 'Logo/Initial (Backend)', 'E', 'Huruf atau logo yang ditampilkan di sidebar'],
                
                // Backend Theme/Color Settings
                ['backend_primary_color', 'backend', 'color', 'Warna Primary (Backend)', '#66BB7A', 'Warna utama untuk tema backend'],
                ['backend_secondary_color', 'backend', 'color', 'Warna Secondary (Backend)', '#5aa769', 'Warna sekunder untuk tema backend'],
                ['backend_header_bg', 'backend', 'color', 'Background Header (Backend)', '#4d9559', 'Warna background header backend'],
                
                // Frontend General Settings
                ['frontend_site_title', 'frontend', 'general', 'Judul Website (Frontend)', 'E-Arsip Dokumen Sekolah', 'Judul website yang ditampilkan di frontend'],
                ['frontend_site_description', 'frontend', 'general', 'Deskripsi Website (Frontend)', 'Sistem pengelolaan arsip dokumen sekolah', 'Deskripsi website untuk SEO'],
                
                // Frontend Header Settings
                ['frontend_header_title', 'frontend', 'header', 'Judul Header (Frontend)', 'E-Arsip Dokumen Sekolah', 'Judul yang ditampilkan di header frontend'],
                ['frontend_header_subtitle', 'frontend', 'header', 'Subtitle Header (Frontend)', 'Sistem Pengelolaan Arsip Dokumen', 'Subtitle di header frontend'],
                
                // Frontend Footer Settings
                ['frontend_footer_text', 'frontend', 'footer', 'Teks Footer (Frontend)', '© 2024 E-Arsip Dokumen Sekolah. All rights reserved.', 'Teks yang ditampilkan di footer'],
                
                // Frontend Theme/Color Settings
                ['frontend_primary_color', 'frontend', 'color', 'Warna Primary (Frontend)', '#66BB7A', 'Warna utama untuk tema frontend'],
                ['frontend_secondary_color', 'frontend', 'color', 'Warna Secondary (Frontend)', '#5aa769', 'Warna sekunder untuk tema frontend'],
            ]
        );
    }

    /** {@inheritdoc} */
    public function safeDown()
    {
        $this->dropTable('{{%page_settings}}');
    }
}

