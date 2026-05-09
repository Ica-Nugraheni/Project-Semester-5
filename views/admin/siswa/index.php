<?php

use app\models\Siswa;
use app\models\UserAkun;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\SiswaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Data Siswa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-index">

    <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h1 class="h3 m-0"><?= Html::encode($this->title) ?></h1>
                <div class="person-sub">Kelola data siswa</div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary" onclick="window.print()">Cetak Laporan</button>
                <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role !== UserAkun::ROLE_PENGAWAS): ?>
                <?= Html::a('Tambah Siswa', ['create'], ['class' => 'btn btn-toska']) ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="table-wrap">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
                <div style="display:flex;gap:8px;align-items:center;width:100%">
                    <input id="siswa-search-input" class="top-search" placeholder="Cari siswa (nama, NIS, kelas)..." style="flex:1" />
                    <button id="siswa-search-btn" class="btn btn-outline">Cari</button>
                </div>
            </div>

            <?= GridView::widget([
                'tableOptions' => ['class' => 'table table-hover'],
                'dataProvider' => $dataProvider,
                'filterModel' => null,
                'columns' => [
                    [
                        'attribute' => 'nama_siswa',
                        'format' => 'raw',
                        'headerOptions' => ['class' => 'col-header-muted'],
                        'value' => function($m){
                            $name = Html::encode($m->nama_siswa);
                            $initials = '';
                            foreach(explode(' ', $m->nama_siswa) as $part){ if(trim($part)!='') $initials .= strtoupper($part[0]); }
                            $sub = isset($m->kelas) ? Html::encode($m->kelas) : '';
                            return '<div class="person-cell">'
                                . '<div class="person-avatar">'.Html::encode(substr($initials,0,2)).'</div>'
                                . '<div class="person-meta"><div class="person-name">'.$name.'</div><div class="person-sub">'.$sub.'</div></div>'
                                . '</div>';
                        },
                    ],

                    [
                        'attribute' => 'nis',
                        'label' => 'NIS',
                    ],

                    [
                        'attribute' => 'kelas',
                        'label' => 'Kelas',
                    ],

                    [
                        'attribute' => 'no_telp',
                        'label' => 'No. Telepon',
                    ],

                    [
                        'label' => 'Status',
                        'format' => 'raw',
                        'value' => function($m){ return '<span class="status-text terapkan">Aktif</span>'; }
                    ],

                    [
                        'class' => ActionColumn::className(),
                        'template' => (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === UserAkun::ROLE_PENGAWAS) ? '{view}' : '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function($url,$model){
                                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                                return Html::a($svg, $url, ['class'=>'btn-icon','title'=>'Lihat','aria-label'=>'Lihat']);
                            },
                            'update' => function($url,$model){
                                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
                                return Html::a($svg, $url, ['class'=>'btn-icon primary','style'=>'margin-right:6px','title'=>'Edit','aria-label'=>'Edit']);
                            },
                            'delete' => function($url,$model){
                                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/></svg>';
                                return Html::a($svg, $url, ['class'=>'btn-icon gray','data-method'=>'post','data-confirm'=>'Are you sure?','title'=>'Hapus','aria-label'=>'Hapus']);
                            },
                        ],
                        'urlCreator' => function ($action, Siswa $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id_siswa' => $model->id_siswa]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>

    <?php $this->registerJs(<<<'JS'
    (function(){
        const input = document.getElementById('siswa-search-input');
        const btn = document.getElementById('siswa-search-btn');
        const table = document.querySelector('.siswa-index .table-wrap table');
        if(!input || !btn || !table) return;
        const rows = Array.from(table.tBodies[0].rows);
        function filterRows(){
            const q = (input.value||'').toLowerCase().trim();
            if(q===''){ rows.forEach(r=>r.style.display=''); return; }
            rows.forEach(r=>{
                const nameCell = r.cells[0];
                const nisCell = r.cells[1];
                const text = ((nameCell&&nameCell.innerText)||'') + ' ' + ((nisCell&&nisCell.innerText)||'');
                r.style.display = text.toLowerCase().includes(q) ? '' : 'none';
            });
        }
        btn.addEventListener('click', e=>{ e.preventDefault(); filterRows(); });
        input.addEventListener('keydown', e=>{ if(e.key==='Enter'){ e.preventDefault(); filterRows(); } });
    })();
    JS
    ); ?>
