<?php
use yii\helpers\Html;

use common\widgets\Alert;

use frontend\assets\AppAsset;
AppAsset::register($this);
//StartBootstrapAppAsset::register ( $this );
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags()?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head()?>
    <style type="text/css">


#wrapper {
	margin-top: 50px;
}
</style>
<?php $this->registerCssFile("@web/css/dang.css")?>
<?php $this->registerCssFile("@web/css/font-awesome.min.css")?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57866097-3', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
<?php $this->beginBody()?>
<div id="wrapper">
		<div class="container-fluid" style="padding-top: 10px">
        <?= Alert::widget()?>
        <?= $content?>
    </div>

	</div>


<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>

