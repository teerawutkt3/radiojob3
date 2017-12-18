<?php

use yii\helpers\Html;
use kartik\alert\Alert;


/* @var $this yii\web\View */
/* @var $model common\models\Contacts */

$this->title = 'ติดต่อเรา';
?>
<div class="contacts-create">

    <h1> <img class="center" alt="" src="/img/logo.png" style="width:10%;  ">  <?= Html::encode($this->title) ?></h1>
	<div class="col-md-5">
        	<?php 
                if ($alert_success ==1 ){
                    echo Alert::widget([
                        'options' => [
                            'class' => 'alert-info',
                        ],
                        'body' => 'ส่งเรียบร้อยแล้ว',
                    ]);
                }
            
            ?>
    	    <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
	</div>


</div>
