<?php
namespace app\controllers;

use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;
use app\models\DashboardConfig;
use app\models\PageSetting;
use app\models\UserAkun;
use app\models\ArsipDokumenGuru;
use app\models\ArsipDokumenSiswa;
use app\models\Guru;
use app\models\Siswa;
use app\models\JenisDokumen;

class AdminController extends Controller
{
    public $layout = 'admin';

    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        if ($user && $user->role === UserAkun::ROLE_PENGAWAS) {
            // Dashboard khusus pengawas dengan data lengkap
            // Get statistics
            $totalDokumenGuru = ArsipDokumenGuru::find()->count();
            $totalDokumenSiswa = ArsipDokumenSiswa::find()->count();
            $totalDokumen = $totalDokumenGuru + $totalDokumenSiswa;
            
            // Dokumen bulan ini
            $bulanIni = date('Y-m');
            $dokumenBulanIni = ArsipDokumenGuru::find()
                ->where(['LIKE', 'tanggal_upload', $bulanIni])
                ->count() + 
                ArsipDokumenSiswa::find()
                ->where(['LIKE', 'tanggal_upload', $bulanIni])
                ->count();
            
            // Total user aktif (non-pengawas)
            $totalUserAktif = UserAkun::find()
                ->where(['!=', 'role', UserAkun::ROLE_PENGAWAS])
                ->count();
            
            // Total guru
            $totalGuru = Guru::find()->count();
            
            // Total siswa
            $totalSiswa = Siswa::find()->count();
            
            // Dokumen terbaru (gabungan)
            $dokumenGuruTerbaru = ArsipDokumenGuru::find()
                ->with(['guru', 'jenis', 'user'])
                ->orderBy(['tanggal_upload' => SORT_DESC])
                ->limit(10)
                ->all();
            
            $dokumenSiswaTerbaru = ArsipDokumenSiswa::find()
                ->with(['siswa', 'jenis', 'user'])
                ->orderBy(['tanggal_upload' => SORT_DESC])
                ->limit(10)
                ->all();
            
            // Gabungkan dan urutkan
            $allDokumen = [];
            foreach ($dokumenGuruTerbaru as $doc) {
                $allDokumen[] = [
                    'type' => 'guru',
                    'data' => $doc,
                    'tanggal' => $doc->tanggal_upload
                ];
            }
            foreach ($dokumenSiswaTerbaru as $doc) {
                $allDokumen[] = [
                    'type' => 'siswa',
                    'data' => $doc,
                    'tanggal' => $doc->tanggal_upload
                ];
            }
            usort($allDokumen, function($a, $b) {
                return strtotime($b['tanggal']) - strtotime($a['tanggal']);
            });
            $dokumenTerbaru = array_slice($allDokumen, 0, 10);
            
            // Statistik per kategori
            $kategoriStats = [];
            $jenisDokumen = JenisDokumen::find()->all();
            foreach ($jenisDokumen as $jenis) {
                $countGuru = ArsipDokumenGuru::find()->where(['id_jenis' => $jenis->id_jenis])->count();
                $countSiswa = ArsipDokumenSiswa::find()->where(['id_jenis' => $jenis->id_jenis])->count();
                $total = $countGuru + $countSiswa;
                if ($total > 0) {
                    $kategoriStats[] = [
                        'jenis' => $jenis,
                        'total' => $total,
                        'persentase' => $totalDokumen > 0 ? round(($total / $totalDokumen) * 100, 1) : 0
                    ];
                }
            }
            usort($kategoriStats, function($a, $b) {
                return $b['total'] - $a['total'];
            });
            
            return $this->render('/pengawas/index', [
                'totalDokumen' => $totalDokumen,
                'dokumenBulanIni' => $dokumenBulanIni,
                'totalUserAktif' => $totalUserAktif,
                'totalGuru' => $totalGuru,
                'totalSiswa' => $totalSiswa,
                'dokumenTerbaru' => $dokumenTerbaru,
                'kategoriStats' => $kategoriStats,
            ]);
        }
        // Admin dan Petugas menggunakan dashboard admin dengan data dinamis
        $totalDokumen = ArsipDokumenGuru::find()->count() + ArsipDokumenSiswa::find()->count();
        $dokumenTerbaru = ArsipDokumenGuru::find()
            ->with(['guru', 'jenis', 'user'])
            ->orderBy(['tanggal_upload' => SORT_DESC])
            ->limit(5)
            ->all();
        // Gabung dengan siswa jika perlu, tapi untuk admin gunakan guru saja atau gabung
        $dokumenSiswaTerbaru = ArsipDokumenSiswa::find()
            ->with(['siswa', 'jenis', 'user'])
            ->orderBy(['tanggal_upload' => SORT_DESC])
            ->limit(5)
            ->all();
        $allDokumen = [];
        foreach ($dokumenTerbaru as $doc) {
            $allDokumen[] = [
                'id' => $doc->id_arsip_guru,
                'type' => 'guru',
                'filename' => basename($doc->file_path),
                'judul' => $doc->judul_dokumen,
                'jenis' => $doc->jenis ? $doc->jenis->nama_jenis : '-',
                'tanggal' => date('Y-m-d', strtotime($doc->tanggal_upload)),
                'owner' => $doc->guru ? $doc->guru->nama_guru : ($doc->user ? $doc->user->nama_lengkap : '-')
            ];
        }
        foreach ($dokumenSiswaTerbaru as $doc) {
            $allDokumen[] = [
                'id' => $doc->id_arsip_siswa,
                'type' => 'siswa',
                'filename' => basename($doc->file_path),
                'judul' => $doc->judul_dokumen,
                'jenis' => $doc->jenis ? $doc->jenis->nama_jenis : '-',
                'tanggal' => date('Y-m-d', strtotime($doc->tanggal_upload)),
                'owner' => $doc->siswa ? $doc->siswa->nama_siswa : ($doc->user ? $doc->user->nama_lengkap : '-')
            ];
        }
        usort($allDokumen, function($a, $b) {
            return strtotime($b['tanggal']) - strtotime($a['tanggal']);
        });
        $dokumenTerbaruAdmin = array_slice($allDokumen, 0, 5);

        return $this->render('dashboard', [
            'dokumenTerbaru' => $dokumenTerbaruAdmin,
        ]);
    }

    /**
     * AJAX endpoint for real-time admin metrics
     */
    public function actionAdminMetrics()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $totalDokumen = ArsipDokumenGuru::find()->count() + ArsipDokumenSiswa::find()->count();
        $dokumenTerbaru = ArsipDokumenGuru::find()
            ->with(['guru', 'jenis', 'user'])
            ->orderBy(['tanggal_upload' => SORT_DESC])
            ->limit(5)
            ->all();
        $dokumenSiswaTerbaru = ArsipDokumenSiswa::find()
            ->with(['siswa', 'jenis', 'user'])
            ->orderBy(['tanggal_upload' => SORT_DESC])
            ->limit(5)
            ->all();
        $allDokumen = [];
        foreach ($dokumenTerbaru as $doc) {
            $allDokumen[] = [
                'judul' => $doc->judul_dokumen,
                'jenis' => $doc->jenis ? $doc->jenis->nama_jenis : '-',
                'tanggal' => date('Y-m-d', strtotime($doc->tanggal_upload)),
                'owner' => $doc->guru ? $doc->guru->nama_guru : ($doc->user ? $doc->user->nama_lengkap : '-')
            ];
        }
        foreach ($dokumenSiswaTerbaru as $doc) {
            $allDokumen[] = [
                'judul' => $doc->judul_dokumen,
                'jenis' => $doc->jenis ? $doc->jenis->nama_jenis : '-',
                'tanggal' => date('Y-m-d', strtotime($doc->tanggal_upload)),
                'owner' => $doc->siswa ? $doc->siswa->nama_siswa : ($doc->user ? $doc->user->nama_lengkap : '-')
            ];
        }
        usort($allDokumen, function($a, $b) {
            return strtotime($b['tanggal']) - strtotime($a['tanggal']);
        });
        $dokumenTerbaruAdmin = array_slice($allDokumen, 0, 5);

        return $dokumenTerbaruAdmin;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'], // Semua user yang login bisa akses index
                    ],
                    [
                        'allow' => true,
                        'actions' => ['edit-dashboard', 'page-settings'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $user = Yii::$app->user->identity;
                            // Hanya admin dan petugas yang bisa edit dashboard dan settings
                            return $user && in_array($user->role, [UserAkun::ROLE_ADMIN, UserAkun::ROLE_PETUGAS]);
                        }
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    // Jika belum login, redirect ke login
                    return Yii::$app->response->redirect(['site/login']);
                },
            ],
        ];
    }

    /**
     * Edit dashboard content (GET shows form, POST saves)
     */
    public function actionEditDashboard()
    {
        try {
            $models = DashboardConfig::find()->orderBy(['sort'=>SORT_ASC])->all();
        } catch (\Throwable $e) {
            Yii::$app->session->setFlash('error', 'Dashboard configuration table not found. Please run the migrations first.');
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post('DashboardConfig', []);
            // posted as DashboardConfig[id][attribute]
            foreach ($models as $m) {
                $id = $m->id;
                if (isset($post[$id])) {
                    $data = $post[$id];
                    $m->label = isset($data['label']) ? $data['label'] : $m->label;
                    $m->value = isset($data['value']) ? $data['value'] : $m->value;
                    $m->note = isset($data['note']) ? $data['note'] : $m->note;
                    $m->visible = isset($data['visible']) ? (int)$data['visible'] : $m->visible;
                    $m->sort = isset($data['sort']) ? (int)$data['sort'] : $m->sort;
                    $m->save(false);
                }
            }

            Yii::$app->session->setFlash('success', 'Dashboard updated');
            return $this->redirect(['index']);
        }

        return $this->render('dashboard_edit', ['models' => $models]);
    }

    /**
     * Page Settings - Edit tampilan frontend dan backend
     */
    public function actionPageSettings()
    {
        try {
            $backendSettings = PageSetting::find()
                ->where(['setting_type' => PageSetting::TYPE_BACKEND])
                ->orderBy(['setting_group' => SORT_ASC, 'id' => SORT_ASC])
                ->all();
            
            $frontendSettings = PageSetting::find()
                ->where(['setting_type' => PageSetting::TYPE_FRONTEND])
                ->orderBy(['setting_group' => SORT_ASC, 'id' => SORT_ASC])
                ->all();
        } catch (\Throwable $e) {
            Yii::$app->session->setFlash('error', 'Page settings table not found. Please run the migrations first.');
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post('PageSetting', []);
            $allSettings = array_merge($backendSettings, $frontendSettings);
            
            foreach ($allSettings as $setting) {
                $id = $setting->id;
                if (isset($post[$id])) {
                    $data = $post[$id];
                    $setting->value = isset($data['value']) ? $data['value'] : $setting->value;
                    $setting->save(false);
                }
            }

            Yii::$app->session->setFlash('success', 'Pengaturan halaman berhasil disimpan.');
            return $this->redirect(['page-settings']);
        }

        return $this->render('page_settings', [
            'backendSettings' => $backendSettings,
            'frontendSettings' => $frontendSettings,
        ]);
    }
}
