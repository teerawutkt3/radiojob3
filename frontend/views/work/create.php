<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Work */

$this->title = 'ประกาศงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.panel-body1 {
background: 		#04859D	; /* #006363 */
color:#FFFFFF;
box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
} 

</style>
<div class="work-create">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-default">
         <div class="panel-body panel-body1">
		</div>
    </div> 
    <?= $this->render('_form', [
        'model' => $model,
        'address'=>$address
    ]) ?>

</div>
