<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'RadioJob',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'การจัดการ', 'url' => ['/site/index']],
        
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'เข้าสู่ระบบ', 'url' => ['/site/login']];
    } else {
        $user = Yii::$app->user->id;
        $menuItems[] = ['label' => Yii::$app->user->identity->fname.' '.Yii::$app->user->identity->lname,
            'items' => [
                [ 'label' => '    <span class="glyphicon glyphicon-user">
                                <i class="icon-dashboard icon-2x"></i><span class="sidebar-menu-item-text"> โปรไฟล์ </span>
                            </span>',
                    'encode' => false,
                    'url' => ['user/view?id='.$user]],
                //  ['label' => 'โปรไฟล์','url' => ['/user/'.$user]],
                //  ['label' => ' My work','url' => ['/work/mywork']],
                '<li class="divider"></li>',
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton('<span class="glyphicon glyphicon-share"></span> ออกจากระบบ',['class'=> 'btn btn-default btn-block logout'])
                
                . Html::endForm()
                . '</li>'
            ]];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<!-- <footer class="footer"> -->
<!--     <div class="container"> -->
       <!--  <p class="pull-left"> --><!-- &copy; My Company  --><?php  /* date('Y') */ ?><!-- </p> -->

        <!-- <p class="pull-right"> --><?php //echo  Yii::powered() ?><!-- </p> -->
<!--     </div> -->
<!-- </footer> -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
