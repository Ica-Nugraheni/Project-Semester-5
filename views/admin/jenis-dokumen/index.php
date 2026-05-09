<?php

use app\models\JenisDokumen;
use app\models\UserAkun;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\JenisDokumenSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Jenis Dokumen';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="jenis-dokumen-index">

    <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h1 class="h3 m-0"><?= Html::encode($this->title) ?></h1>
                <div class="person-sub">Kelola kategori dokumen</div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary" onclick="window.print()">Cetak Laporan</button>
                <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role !== UserAkun::ROLE_PENGAWAS): ?>
                <?= Html::a('Tambah Kategori', ['create'], ['class' => 'btn btn-toska']) ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="table-wrap">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
                <div style="display:flex;gap:8px;align-items:center;width:100%">
                    <input id="jenis-search-input" class="top-search" placeholder="Cari kategori (nama)..." style="flex:1" />
                    <button id="jenis-search-btn" class="btn btn-outline">Cari</button>
                </div>
            </div>

            <?= GridView::widget([
                'tableOptions' => ['class' => 'table table-hover'],
                'dataProvider' => $dataProvider,
                'filterModel' => null,
                'columns' => [
                    ['class' => 'yii\\grid\\SerialColumn'],

                    [
                        'attribute' => 'nama_jenis',
                        'format' => 'raw',
                        'headerOptions' => ['class' => 'col-header-muted'],
                        'value' => function($m){
                            return '<div class="person-name">'.Html::encode($m->nama_jenis).'</div>';
                        }
                    ],

                    [
                        'attribute' => 'deskripsi',
                        'label' => 'Deskripsi',
                        'format' => 'ntext',
                        'contentOptions' => ['style'=>'max-width:320px']
                    ],

                    [
                        'label' => 'Jumlah Dokumen',
                        'value' => function($m){ return isset($m->count)?$m->count:0; }
                    ],

                    [
                        'label' => 'Status',
                        'format' => 'raw',
                        'value' => function($m){ return '<span class="status-text terapkan">Aktif</span>'; }
                    ],

                    [
                        'class' => ActionColumn::className(),
                        'template' => (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === UserAkun::ROLE_PENGAWAS) ? '' : '{update} {delete}',
                        'buttons' => [
                            'update' => function($url,$model){
                                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                                return Html::a($svg, $url, ['class'=>'btn-icon primary','style'=>'margin-right:6px','title'=>'Edit','aria-label'=>'Edit']);
                            },
                            'delete' => function($url,$model){
                                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/></svg>';
                                return Html::a($svg, $url, ['class'=>'btn-icon gray','data-method'=>'post','data-confirm'=>'Are you sure?','title'=>'Hapus','aria-label'=>'Hapus']);
                            },
                        ],
                        'urlCreator' => function ($action, JenisDokumen $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id_jenis' => $model->id_jenis]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>

<?php $this->registerJs(<<<'JS'
(function(){
    const input = document.getElementById('jenis-search-input');
    const btn = document.getElementById('jenis-search-btn');
    const table = document.querySelector('.jenis-dokumen-index .table-wrap table');
    if(!input || !btn || !table) return;
    const rows = Array.from(table.tBodies[0].rows);
    function filterRows(){
        const q = (input.value||'').toLowerCase().trim();
        if(q===''){ rows.forEach(r=>r.style.display=''); return; }
        rows.forEach(r=>{
            const nameCell = r.cells[1];
            const descCell = r.cells[2];
            const text = ((nameCell&&nameCell.innerText)||'') + ' ' + ((descCell&&descCell.innerText)||'');
            r.style.display = text.toLowerCase().includes(q) ? '' : 'none';
        });
    }
    btn.addEventListener('click', e=>{ e.preventDefault(); filterRows(); });
    input.addEventListener('keydown', e=>{ if(e.key==='Enter'){ e.preventDefault(); filterRows(); } });
})();
JS
); ?>
