<?php

use app\models\UserAkun;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserAkunSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Menajemen User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-akun-index">

    <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h1 class="h3 m-0"><?= Html::encode($this->title) ?></h1>
                <div class="person-sub">Kelola user dan peran</div>
            </div>
            <div>
                <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role !== UserAkun::ROLE_PENGAWAS): ?>
                <?= Html::a('Tambah User', ['create'], ['class' => 'btn btn-toska']) ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="table-wrap">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
                <div style="display:flex;gap:8px;align-items:center;width:100%">
                    <input id="user-search-input" class="top-search" placeholder="Cari kategori" style="flex:1" />
                </div>
            </div>

            <?= GridView::widget([
                'tableOptions' => ['class' => 'table table-hover'],
                'dataProvider' => $dataProvider,
                'filterModel' => null,
                'columns' => [
                    ['class' => 'yii\\grid\\SerialColumn'],

                    [
                        'label' => 'User',
                        'format' => 'raw',
                        'headerOptions' => ['class' => 'col-header-muted'],
                        'value' => function($m){
                            $name = isset($m->nama_lengkap)?Html::encode($m->nama_lengkap):Html::encode($m->username);
                            $created = isset($m->created_at)?Html::encode($m->created_at):(isset($m->created)?Html::encode($m->created):'');
                            $initials = '';
                            foreach(explode(' ', $name) as $p){ if(trim($p)!='') $initials .= strtoupper($p[0]); }
                            $meta = '<div class="person-sub">'.($created?('Dibuat: '.$created):'').'</div>';
                            return '<div class="person-cell">'.
                                '<div class="person-avatar">'.Html::encode(substr($initials,0,2)).'</div>'.
                                '<div class="person-meta"><div class="person-name">'.$name.'</div>'.$meta.'</div>'.
                                '</div>';
                        }
                    ],

                    [
                        'attribute' => 'username',
                        'label' => 'Username'
                    ],

                    [
                        'attribute' => 'email',
                        'label' => 'Email',
                        'format' => 'email'
                    ],

                    [
                        'label' => 'Role',
                        'format' => 'raw',
                        'value' => function($m){
                            $r = isset($m->role)?Html::encode($m->role):'User';
                            $cls = strtolower($r)=='admin' ? 'badge red' : 'badge blue';
                            return '<span class="'.$cls.'">'.$r.'</span>';
                        }
                    ],

                    [
                        'label' => 'Last Login',
                        'value' => function($m){ return isset($m->last_login)?Html::encode($m->last_login):''; }
                    ],

                    [
                        'label' => 'Status',
                        'format' => 'raw',
                        'value' => function($m){ return '<span class="status-text terapkan">Aktif</span>'; }
                    ],

                    [
                        'class' => ActionColumn::className(),
                        'template' => (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === UserAkun::ROLE_PENGAWAS) ? '' : '{update} {view} {delete}',
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
                        'urlCreator' => function ($action, UserAkun $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id_user' => $model->id_user]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>

<?php $this->registerJs(<<<'JS'
(function(){
  const input = document.getElementById('user-search-input');
  const table = document.querySelector('.user-akun-index .table-wrap table');
  if(!input || !table) return;
  const rows = Array.from(table.tBodies[0].rows);
  function filter(){
    const q = (input.value||'').toLowerCase().trim();
    if(q===''){ rows.forEach(r=>r.style.display=''); return; }
    rows.forEach(r=>{
      const text = Array.from(r.cells).slice(0,5).map(c=>c.innerText||'').join(' ').toLowerCase();
      r.style.display = text.includes(q) ? '' : 'none';
    });
  }
  input.addEventListener('keydown', e=>{ if(e.key==='Enter'){ e.preventDefault(); filter(); } });
})();
JS
); ?>

</div>
