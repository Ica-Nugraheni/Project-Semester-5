<?php

namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\UserAkun;
use app\models\ArsipDokumenGuru;
use app\models\ArsipDokumenSiswa;
use app\models\Guru;
use app\models\Siswa;
use app\models\JenisDokumen;
use Yii;

/**
 * PengawasController provides read‑only access for users with the ROLE_PENGAWAS.
 * It mirrors the admin dashboard but disallows any create, update, or delete actions.
 */
class PengawasController extends Controller
{
    public $layout = 'admin';

    /**
     * Access control rules: only authenticated users with ROLE_PENGAWAS can access.
     * All actions are limited to GET requests.
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $user = Yii::$app->user->identity;
                            return $user && $user->role === UserAkun::ROLE_PENGAWAS;
                        },
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    // Redirect to appropriate dashboard based on role
                    $user = Yii::$app->user->identity;
                    if ($user) {
                        if (in_array($user->role, [UserAkun::ROLE_ADMIN, UserAkun::ROLE_PETUGAS])) {
                            return Yii::$app->response->redirect(['admin/index']);
                        }
                    }
                    return Yii::$app->response->redirect(['site/login']);
                },
            ],
            // Ensure only GET methods are allowed for all actions
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    '*' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Dashboard for Pengawas – read‑only view.
     */
    public function actionIndex()
    {
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
            ->all();
        
        $dokumenSiswaTerbaru = ArsipDokumenSiswa::find()
            ->with(['siswa', 'jenis', 'user'])
            ->orderBy(['tanggal_upload' => SORT_DESC])
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
        $dokumenTerbaru = $allDokumen;
        
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
        
        return $this->render('index', [
            'totalDokumen' => $totalDokumen,
            'dokumenBulanIni' => $dokumenBulanIni,
            'totalUserAktif' => $totalUserAktif,
            'totalGuru' => $totalGuru,
            'totalSiswa' => $totalSiswa,
            'dokumenTerbaru' => $dokumenTerbaru,
            'kategoriStats' => $kategoriStats,
        ]);
    }

    /**
     * AJAX endpoint for real-time metrics
     */
    public function actionMetrics()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $totalDokumen = ArsipDokumenGuru::find()->count() + ArsipDokumenSiswa::find()->count();
        $bulanIni = date('Y-m');
        $dokumenBulanIni = ArsipDokumenGuru::find()
            ->where(['LIKE', 'tanggal_upload', $bulanIni])
            ->count() + 
            ArsipDokumenSiswa::find()
            ->where(['LIKE', 'tanggal_upload', $bulanIni])
            ->count();
        $totalDokumenGuru = ArsipDokumenGuru::find()->count();
        $totalDokumenSiswa = ArsipDokumenSiswa::find()->count();
        $totalGuru = Guru::find()->count();
        $totalSiswa = Siswa::find()->count();
        $totalUserAktif = UserAkun::find()
            ->where(['!=', 'role', UserAkun::ROLE_PENGAWAS])
            ->count();

        // Statistik per kategori
        $kategoriStats = [];
        $jenisDokumen = JenisDokumen::find()->all();
        foreach ($jenisDokumen as $jenis) {
            $countGuru = ArsipDokumenGuru::find()->where(['id_jenis' => $jenis->id_jenis])->count();
            $countSiswa = ArsipDokumenSiswa::find()->where(['id_jenis' => $jenis->id_jenis])->count();
            $total = $countGuru + $countSiswa;
            if ($total > 0) {
                $kategoriStats[] = [
                    'nama_jenis' => $jenis->nama_jenis,
                    'total' => $total,
                    'persentase' => $totalDokumen > 0 ? round(($total / $totalDokumen) * 100, 1) : 0
                ];
            }
        }
        usort($kategoriStats, function($a, $b) {
            return $b['total'] - $a['total'];
        });

        return [
            'totalDokumen' => $totalDokumen,
            'dokumenBulanIni' => $dokumenBulanIni,
            'totalDokumenGuru' => $totalDokumenGuru,
            'totalDokumenSiswa' => $totalDokumenSiswa,
            'totalGuru' => $totalGuru,
            'totalSiswa' => $totalSiswa,
            'totalUserAktif' => $totalUserAktif,
            'kategoriStats' => array_slice($kategoriStats, 0, 5), // top 5
        ];
    }

    /**
     * Laporan untuk Pengawas
     */
    public function actionLaporan()
    {
        // Data untuk laporan
        $totalDokumen = ArsipDokumenGuru::find()->count() + ArsipDokumenSiswa::find()->count();
        $totalGuru = Guru::find()->count();
        $totalSiswa = Siswa::find()->count();
        $totalUser = UserAkun::find()->count();

        // Dokumen per bulan (6 bulan terakhir)
        $laporanBulan = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = date('Y-m', strtotime("-$i months"));
            $namaBulan = date('F Y', strtotime("-$i months"));
            $count = ArsipDokumenGuru::find()->where(['LIKE', 'tanggal_upload', $bulan])->count() +
                     ArsipDokumenSiswa::find()->where(['LIKE', 'tanggal_upload', $bulan])->count();
            $laporanBulan[] = [
                'bulan' => $namaBulan,
                'total' => $count
            ];
        }

        // Dokumen per kategori
        $kategoriStats = [];
        $jenisDokumen = JenisDokumen::find()->all();
        foreach ($jenisDokumen as $jenis) {
            $countGuru = ArsipDokumenGuru::find()->where(['id_jenis' => $jenis->id_jenis])->count();
            $countSiswa = ArsipDokumenSiswa::find()->where(['id_jenis' => $jenis->id_jenis])->count();
            $total = $countGuru + $countSiswa;
            if ($total > 0) {
                $kategoriStats[] = [
                    'kategori' => $jenis->nama_jenis,
                    'total' => $total
                ];
            }
        }

        return $this->render('laporan', [
            'totalDokumen' => $totalDokumen,
            'totalGuru' => $totalGuru,
            'totalSiswa' => $totalSiswa,
            'totalUser' => $totalUser,
            'laporanBulan' => $laporanBulan,
            'kategoriStats' => $kategoriStats,
        ]);
    }
}
