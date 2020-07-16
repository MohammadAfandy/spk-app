<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

app\assets\AppAsset::register($this);

app\assets\AdminLteAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>
    <div class="loading">
        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
    </div>

    <?php $this->endBody() ?>
    <?php
    $this->registerJs(
        '
        function showLoading() {
            $(".loading").show();
            $(".box-body").addClass("hidden-background");
        }

        function endLoading() {
            $(".loading").hide();
            $(".box-body").removeClass("hidden-background");
        }

        $(document).on("submit", "form", function() {
            $(this).find(":submit").attr("disabled", true).html("<span class=\'fa fa-spin fa-spinner\'></span> Loading ...");
        });

        $(".dataTable").dataTable({
            "pageLength": 20,
            "bLengthChange": false,
            // "scrollX": true
        });

        // $(".dataTable thead tr").clone(true).appendTo(".dataTable thead");
        // $(".dataTable thead tr:eq(1) th").each(function (i) {
        //     var title = $(this).text();
        //     $(this).html("<input type="text" placeholder="Search "+title+"" />");

        //     $("input", this ).on("keyup change", function () {
        //         if (data_table.column(i).search() !== this.value) {
        //             data_table.column(i).search(this.value).draw();
        //         }
        //     });
        // });

        ',
        \yii\web\View::POS_READY,
        'main-js'
    );
    ?>
</body>
</html>
<?php $this->endPage() ?>

