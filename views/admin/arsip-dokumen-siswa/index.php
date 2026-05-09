<?php

use app\models\ArsipDokumenSiswa;
use app\models\UserAkun;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ArsipDokumenSiswaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Arsip Dokumen Siswa';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="arsip-dokumen-siswa-index">

    <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h1 class="h3 m-0"><?= Html::encode($this->title) ?></h1>
                <div class="person-sub">Kelola arsip dokumen siswa</div>
            </div>
            <div>
                <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role !== UserAkun::ROLE_PENGAWAS): ?>
                <?= Html::a('Tambah Dokumen', ['create'], ['class' => 'btn btn-toska']) ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="table-wrap">
            <div style="display:flex;gap:12px;align-items:center;margin-bottom:12px">
                <input id="arsip-siswa-search" class="top-search" placeholder="Cari dokumen atau nomor..." style="flex:1" />
                <select id="arsip-siswa-kategori" class="top-search" style="width:210px;padding:8px 10px">
                    <option value="">Semua Kategori</option>
                </select>
            </div>

            <?= GridView::widget([
                'tableOptions' => ['class' => 'table table-hover'],
                'dataProvider' => $dataProvider,
                'filterModel' => null,
                'columns' => [
                    [
                        'label' => 'No. Dokumen',
                        'format' => 'raw',
                        'value' => function($m){
                            $code = isset($m->no_dokumen) ? Html::encode($m->no_dokumen) : 'IS-'.Html::encode($m->id_arsip_siswa);
                            return '<div style="font-weight:700;background:#fff;padding:6px 10px;border-radius:6px;border:1px solid #eef6f2;display:inline-block">'.$code.'</div>';
                        }
                    ],

                    [
                        'label' => 'Nama Siswa',
                        'format' => 'raw',
                        'headerOptions' => ['class' => 'col-header-muted'],
                        'value' => function($m){
                            if(isset($m->siswa) && isset($m->siswa->nama_siswa)) return Html::encode($m->siswa->nama_siswa);
                            return Html::encode($m->id_siswa);
                        }
                    ],

                    [
                        'label' => 'NIS',
                        'value' => function($m){ return isset($m->siswa->nis) ? $m->siswa->nis : ''; }
                    ],

                    [
                        'label' => 'Kelas',
                        'value' => function($m){ return isset($m->siswa->kelas) ? $m->siswa->kelas : ''; }
                    ],

                    [
                        'label' => 'Kategori',
                        'format' => 'raw',
                        'value' => function($m){
                            $k = isset($m->jenis) && isset($m->jenis->nama_jenis) ? Html::encode($m->jenis->nama_jenis) : (isset($m->id_jenis)?Html::encode($m->id_jenis):'');
                            return '<span class="badge green">'.$k.'</span>';
                        }
                    ],

                    [
                        'attribute' => 'judul_dokumen',
                        'label' => 'Nama Dokumen'
                    ],

                    [
                        'label' => 'File Dokumen',
                        'format' => 'raw',
                        'value' => function($m){
                            if(isset($m->file_path) && !empty($m->file_path)){
                                $fileName = basename($m->file_path);
                                $fileExt = strtolower(pathinfo($m->file_path, PATHINFO_EXTENSION));
                                
                                // Icon berdasarkan tipe file
                                $icon = '📄'; // default
                                if(in_array($fileExt, ['pdf'])) $icon = '📕';
                                elseif(in_array($fileExt, ['doc', 'docx'])) $icon = '📝';
                                elseif(in_array($fileExt, ['xls', 'xlsx'])) $icon = '📊';
                                elseif(in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif'])) $icon = '🖼️';
                                
                                $viewUrl = \yii\helpers\Url::to(['file/view-siswa', 'filename' => basename($m->file_path)]);
                                $downloadUrl = \yii\helpers\Url::to(['file/download-siswa', 'filename' => basename($m->file_path)]);
                                
                                return '<div class="file-actions">' .
                                       '<a href="' . $viewUrl . '" target="_blank" class="file-link" title="Klik untuk membuka file: ' . Html::encode($fileName) . '">' . 
                                       $icon . ' ' . Html::encode($fileName) . '</a>' .
                                       '<a href="' . $downloadUrl . '" class="download-btn" title="Download file">' .
                                       '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>' .
                                       '</a>' .
                                       '</div>';
                            }
                            return '<span class="text-muted">Tidak ada file</span>';
                        }
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
                                return Html::a($svg, $url, ['class'=>'btn-icon primary','title'=>'Edit','aria-label'=>'Edit']);
                            },
                            'delete' => function($url,$model){
                                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/></svg>';
                                return Html::a($svg, $url, ['class'=>'btn-icon gray','data-method'=>'post','data-confirm'=>'Are you sure?','title'=>'Hapus','aria-label'=>'Hapus']);
                            },
                        ],
                        'urlCreator' => function ($action, ArsipDokumenSiswa $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id_arsip_siswa' => $model->id_arsip_siswa]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>

<?php $this->registerJs(<<<'JS'
(function(){
  const input = document.getElementById('arsip-siswa-search');
  const select = document.getElementById('arsip-siswa-kategori');
  const table = document.querySelector('.arsip-dokumen-siswa-index .table-wrap table');
  if(!table) return;
  const rows = Array.from(table.tBodies[0].rows);
  const cats = new Set();
  rows.forEach(r=>{ const catCell = r.querySelector('td:nth-child(5)'); if(catCell) cats.add(catCell.innerText.trim()); });
  cats.forEach(c=>{ if(c!==''){ const opt=document.createElement('option'); opt.value=c; opt.text=c; select.appendChild(opt); }});
  function filter(){
    const q = (input && input.value||'').toLowerCase().trim();
    const cat = (select && select.value)||'';
    rows.forEach(r=>{
      const text = Array.from(r.cells).slice(0,6).map(c=>c.innerText||'').join(' ').toLowerCase();
      const matchQ = q==='' || text.includes(q);
      const catText = (r.cells[4] && r.cells[4].innerText.trim())||'';
      const matchCat = cat==='' || catText===cat;
      r.style.display = (matchQ && matchCat) ? '' : 'none';
    });
  }
  if(input){ input.addEventListener('keydown', e=>{ if(e.key==='Enter'){ e.preventDefault(); filter(); } }); }
  if(select){ select.addEventListener('change', filter); }
})();
JS
); ?>

<style>
.file-link {
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 8px;
    border-radius: 6px;
    transition: all 0.2s ease;
    border: 1px solid transparent;
}

.file-link:hover {
    background-color: #dbeafe;
    border-color: #bfdbfe;
    color: #1d4ed8;
    text-decoration: none;
}

.file-link:active {
    background-color: #bfdbfe;
}

.file-actions {
    display: flex;
    align-items: center;
    gap: 8px;
}

.download-btn {
    color: #16a34a;
    text-decoration: none;
    padding: 4px 6px;
    border-radius: 4px;
    transition: all 0.2s ease;
    border: 1px solid transparent;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.download-btn:hover {
    background-color: #dcfce7;
    border-color: #bbf7d0;
    color: #15803d;
    text-decoration: none;
}

.download-btn svg {
    width: 16px;
    height: 16px;
}

.text-muted {
    color: #9ca3af;
    font-style: italic;
}
</style>

</div>
