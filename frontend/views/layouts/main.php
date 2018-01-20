<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\Joinwork;

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
        'brandLabel' => ' RadioJob ', //<img src="/img/logo.png" style="width:4%" class="pull-left">
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'การจัดการ',   'items' => [
            
            [ 'label' => '    <span class="glyphicon glyphicon-inbox"><span class="sidebar-menu-item-text"> inbox</span>
                            </span>',
                'encode' => false,
                'url' => ['/letter/index']],
            [ 'label' => '    <span class="	glyphicon glyphicon-check"><span class="sidebar-menu-item-text"> งานทั้งหมด  </span>
                            </span>',
                'encode' => false,
                'url' => ['/joinwork/data-work-radiologist']],
        ],'visible'=>Yii::$app->user->can('radiologist')],
        ['label' => 'การจัดการ',   'items' => [
            
            [ 'label' => '    <span class="glyphicon glyphicon-floppy-saved"><span class="sidebar-menu-item-text"> ประกาศงาน +</span>
                            </span>',
            'encode' => false,
            'url' => ['/work/index']],
            [ 'label' => '    <span class="glyphicon glyphicon-inbox"><span class="sidebar-menu-item-text"> สมัคร ('.Joinwork::find()->where(['join_status'=>Joinwork::STATUS_WAIT,'created_work'=>Yii::$app->user->id])->count().')</span>
                            </span>',
                'encode' => false,
                'url' => ['/joinwork/inbox-of-radiologist']],
            [ 'label' => '    <span class="	glyphicon glyphicon-list-alt"><span class="sidebar-menu-item-text"> รับสมัครแล้ว</span>
                            </span>',
                'encode' => false,
                'url' => ['/joinwork/accept-of-radiologist']],
            [ 'label' => '    <span class="	glyphicon glyphicon-folder-open"><span class="sidebar-menu-item-text"> รายชื่อผู้เคยร่วมงาน</span>
                            </span>',
                'encode' => false,
                'url' => ['/joinwork/success-of-radiologist']],	
          
            
        ],'visible'=>Yii::$app->user->can('public_relations')],
        ['label' => 'ค้นหานักรังสีเทคนิค',   'items' => [
            [ 'label' => '    <span class="	glyphicon glyphicon-envelope"><span class="sidebar-menu-item-text"> การตอบกลับ</span>
                            </span>',
                'encode' => false,
                'url' => ['/letter/index']],	
            [ 'label' => '    <span class="glyphicon glyphicon-search"><span class="sidebar-menu-item-text"> ค้นหานักรังสีเทคนิค</span>
                            </span>',
                'encode' => false,
                'url' => ['/work/work-search-radiologist']],
           
        ],'visible'=>Yii::$app->user->can('public_relations')],
       
        ['label' => 'ค้นหางาน',
            'items' => [
                [ 'label' => '    <span class="glyphicon glyphicon-time"><span class="sidebar-menu-item-text"> ค้นหาตามเวลาประกาศ </span>
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
       // ['label' => 'นักรังสี','url' => ['/work/index'],'visible' => Yii::$app->user->can('admin')?true:false,],
        //['label' => 'นักรังสี','url' => ['/#']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'สมัครสมาชิก', 'url' => ['/site/signup']];
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
                [ 'label' => '    <span class="glyphicon glyphicon-share">
                                <i class="icon-dashboard icon-2x"></i><span class="sidebar-menu-item-text"> ออกจากระบบ </span>
                            </span>',
                    'encode' => false,
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                 ],
                //  ['label' => 'โปรไฟล์','url' => ['/user/'.$user]],
                //  ['label' => ' My work','url' => ['/work/mywork']],
              /*   '<li class="divider"></li>',
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton('<span class="glyphicon glyphicon-share"></span> ออกจากระบบ',['class'=> 'btn btn-link btn-block logout'])
                
                . Html::endForm()
                . '</li>' */
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
