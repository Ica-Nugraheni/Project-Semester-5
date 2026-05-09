<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\PageSetting;

/** @var \yii\web\View $this */
/* @var $backendSettings app\models\PageSetting[] */
/* @var $frontendSettings app\models\PageSetting[] */

$this->title = 'Pengaturan Halaman';
$this->registerJs("
    function switchTab(type, element) {
        document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.tab-button').forEach(el => el.classList.remove('active'));
        document.getElementById(type + '-tab').style.display = 'block';
        element.classList.add('active');
    }
", \yii\web\View::POS_HEAD);
?>
<div class="page-settings">
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px">
            <div>
                <h4 class="m-0"><?= Html::encode($this->title) ?></h4>
                <p class="text-muted mb-0" style="margin-top:8px;font-size:0.9rem;">Edit tampilan frontend dan backend</p>
            </div>
            <?= Html::a('Back', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?php $form = ActiveForm::begin(['options' => ['class' => 'settings-form']]); ?>

        <!-- Tabs -->
        <ul class="nav nav-tabs mb-4" style="border-bottom: 2px solid #e9ecef;">
            <li class="nav-item">
                <a class="nav-link active tab-button" href="#" onclick="switchTab('backend', this); return false;" style="cursor:pointer;color:#66BB7A;border-bottom:2px solid #66BB7A;margin-bottom:-2px;">Backend Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link tab-button" href="#" onclick="switchTab('frontend', this); return false;" style="cursor:pointer;">Frontend Settings</a>
            </li>
        </ul>

        <!-- Backend Settings Tab -->
        <div id="backend-tab" class="tab-content">
            <?php 
            $backendGroups = [];
            foreach ($backendSettings as $setting) {
                $group = $setting->setting_group;
                if (!isset($backendGroups[$group])) {
                    $backendGroups[$group] = [];
                }
                $backendGroups[$group][] = $setting;
            }
            
            $groupLabels = [
                'brand' => 'Brand & Logo',
                'color' => 'Warna & Tema',
                'general' => 'Umum',
                'header' => 'Header',
                'footer' => 'Footer',
            ];
            ?>

            <?php foreach ($backendGroups as $groupKey => $groupSettings): ?>
                <div class="settings-group" style="margin-bottom:32px;padding:20px;background:#f8f9fa;border-radius:8px;">
                    <h5 style="margin-bottom:20px;color:#333;font-weight:600;border-bottom:2px solid #66BB7A;padding-bottom:8px;">
                        <?= Html::encode($groupLabels[$groupKey] ?? ucfirst($groupKey)) ?>
                    </h5>
                    
                    <div class="row">
                        <?php foreach ($groupSettings as $setting): ?>
                            <div class="col-md-6" style="margin-bottom:20px;">
                                <label style="display:block;margin-bottom:8px;font-weight:500;color:#555;">
                                    <?= Html::encode($setting->label) ?>
                                    <?php if ($setting->description): ?>
                                        <small class="text-muted d-block" style="font-weight:normal;font-size:0.85rem;margin-top:4px;">
                                            <?= Html::encode($setting->description) ?>
                                        </small>
                                    <?php endif; ?>
                                </label>
                                
                                <?php if (strpos($setting->setting_key, 'color') !== false || strpos($setting->setting_key, '_color') !== false): ?>
                                    <!-- Color Input -->
                                    <?= Html::activeTextInput($setting, "[{$setting->id}]value", [
                                        'class' => 'form-control',
                                        'placeholder' => '#66BB7A',
                                        'style' => 'height:44px;',
                                        'pattern' => '^#[0-9A-Fa-f]{6}$',
                                        'title' => 'Masukkan warna dalam format hex (contoh: #66BB7A)'
                                    ]) ?>
                                    <small class="text-muted">Format: #RRGGBB (contoh: #66BB7A)</small>
                                <?php elseif (strpos($setting->setting_key, 'description') !== false || strpos($setting->value, "\n") !== false): ?>
                                    <!-- Textarea for longer content -->
                                    <?= Html::activeTextarea($setting, "[{$setting->id}]value", [
                                        'class' => 'form-control',
                                        'rows' => 3,
                                        'style' => 'resize:vertical;'
                                    ]) ?>
                                <?php else: ?>
                                    <!-- Regular Text Input -->
                                    <?= Html::activeTextInput($setting, "[{$setting->id}]value", [
                                        'class' => 'form-control',
                                        'style' => 'height:44px;'
                                    ]) ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Frontend Settings Tab -->
        <div id="frontend-tab" class="tab-content" style="display:none;">
            <?php 
            $frontendGroups = [];
            foreach ($frontendSettings as $setting) {
                $group = $setting->setting_group;
                if (!isset($frontendGroups[$group])) {
                    $frontendGroups[$group] = [];
                }
                $frontendGroups[$group][] = $setting;
            }
            ?>

            <?php foreach ($frontendGroups as $groupKey => $groupSettings): ?>
                <div class="settings-group" style="margin-bottom:32px;padding:20px;background:#f8f9fa;border-radius:8px;">
                    <h5 style="margin-bottom:20px;color:#333;font-weight:600;border-bottom:2px solid #66BB7A;padding-bottom:8px;">
                        <?= Html::encode($groupLabels[$groupKey] ?? ucfirst($groupKey)) ?>
                    </h5>
                    
                    <div class="row">
                        <?php foreach ($groupSettings as $setting): ?>
                            <div class="col-md-6" style="margin-bottom:20px;">
                                <label style="display:block;margin-bottom:8px;font-weight:500;color:#555;">
                                    <?= Html::encode($setting->label) ?>
                                    <?php if ($setting->description): ?>
                                        <small class="text-muted d-block" style="font-weight:normal;font-size:0.85rem;margin-top:4px;">
                                            <?= Html::encode($setting->description) ?>
                                        </small>
                                    <?php endif; ?>
                                </label>
                                
                                <?php if (strpos($setting->setting_key, 'color') !== false || strpos($setting->setting_key, '_color') !== false): ?>
                                    <!-- Color Input -->
                                    <?= Html::activeTextInput($setting, "[{$setting->id}]value", [
                                        'class' => 'form-control',
                                        'placeholder' => '#66BB7A',
                                        'style' => 'height:44px;',
                                        'pattern' => '^#[0-9A-Fa-f]{6}$',
                                        'title' => 'Masukkan warna dalam format hex (contoh: #66BB7A)'
                                    ]) ?>
                                    <small class="text-muted">Format: #RRGGBB (contoh: #66BB7A)</small>
                                <?php elseif (strpos($setting->setting_key, 'description') !== false || strpos($setting->value, "\n") !== false): ?>
                                    <!-- Textarea for longer content -->
                                    <?= Html::activeTextarea($setting, "[{$setting->id}]value", [
                                        'class' => 'form-control',
                                        'rows' => 3,
                                        'style' => 'resize:vertical;'
                                    ]) ?>
                                <?php else: ?>
                                    <!-- Regular Text Input -->
                                    <?= Html::activeTextInput($setting, "[{$setting->id}]value", [
                                        'class' => 'form-control',
                                        'style' => 'height:44px;'
                                    ]) ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Submit Button -->
        <div style="margin-top:32px;padding-top:24px;border-top:1px solid #e9ecef;display:flex;gap:12px;justify-content:flex-end;">
            <?= Html::a('Batal', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
            <?= Html::submitButton('Simpan Pengaturan', ['class' => 'btn btn-primary', 'style' => 'background-color:#66BB7A;border-color:#66BB7A;']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<style>
.nav-tabs .nav-link {
    color: #6c757d;
    border: none;
    border-bottom: 2px solid transparent;
}
.nav-tabs .nav-link:hover {
    border-bottom-color: #66BB7A;
    color: #66BB7A;
}
.nav-tabs .nav-link.active {
    color: #66BB7A;
    border-bottom-color: #66BB7A;
    background: transparent;
}
</style>

