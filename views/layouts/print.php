<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12pt; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { background-color: #f2f2f2; font-weight: bold; }
        .table th, .table td { border: 1px solid #000; padding: 8px; }
        h1 { text-align: center; font-size: 16pt; margin-bottom: 5px; }
        h3 { text-align: center; font-size: 12pt; margin-top: 0; color: #666; }
        .page-break { page-break-before: always; }
        @media print {
            .no-print { display: none !important; }
            .print-only { display: block; }
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>