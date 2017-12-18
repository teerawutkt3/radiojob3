<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\assets\AppAsset2;

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
    <style type="text/css">
        body {
       background-image: url(/img/home66.jpg); 
       height: 100%; 
      height: 100%; 
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    }
    </style>
</head>

<body class="bg">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' =>  'RadioJob', //<img src="/img/logo.png" style="width:4%"  class="pull-left">
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'หน้าหลัก', 'url' => ['/site/index']],
        ['label' => 'ค้นหางาน',
            'items' => [
                [ 'label' => '    <span class="glyphicon glyphicon-time"><span class="sidebar-menu-item-text"> ค้นหาตามเวลาประกาศ  </span>
                            </span>',
                    'encode' => false,
                    'url' => ['/work/work-search-normal']],
                [ 'label' => '    <span class="glyphicon glyphicon-usd"><span class="sidebar-menu-item-text"> ค้นหาแบบเรียงลำดับรายได้</span>
                            </span>',
                    'encode' => false,
                    'url' => ['/work/work-search-sort']],
                [ 'label' => '    <span class="	glyphicon glyphicon-gift"><span class="sidebar-menu-item-text"> ค้นหาแบบเรียงลำดับสวัสดิการ</span>
                            </span>',
                    'encode' => false,
                    'url' => ['/work/work-search-benefits']], 
                [ 'label' => '    <span class="	glyphicon glyphicon-globe"><span class="sidebar-menu-item-text"> ค้นหาจาก Google Map</span>
                            </span>',
                    'encode' => false,
                    'url' => ['/work/work-search-map']],
                
            ]
        ],
    //    ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'เกี่ยวกับ', 'url' => ['/site/about']],
        ['label' => 'ติดต่อ', 'url' => ['/contact/create']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'สมัครสมาชิก', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'เข้าสู่ระบบ', 'url' => ['/site/login']];
    } else {
        $user = Yii::$app->user->id;
        $menuItems[] = ['label' => Yii::$app->user->identity->username,
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

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?php //echo  Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
