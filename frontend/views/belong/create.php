<?php

use yii\helpers\Html;
use kartik\alert\Alert;


/* @var $this yii\web\View */
/* @var $model common\models\Belong */

$this->title = 'เพิ่ม หน่วยงาน / สังกัด';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>

.panel-body1 {
background: 	#04859D	;
color:#FFFFFF;
box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
} 
</style>
<div class="belong-create">
   <h1><?= Html::encode($this->title) ?></h1>

	<div class="row">
		<div class="col-md-3">
		
<?php 
    if ($alert_repeat ==1 ){
        echo Alert::widget([
            'options' => [
                'class' => 'alert-danger',
            ],
            'body' => 'มีข้อมูลแล้ว',
        ]);
    }

?>
		
		    <?= $this->render('_form', [
                'model' => $model,'placeholder'=>'รัฐบาล - เอกชน...'
            ]) ?>
		</div>
		<div class="col-md-3">
		<div class="panel-group">
					<?php $number=1; ?>
              		<?php foreach ($findModel as $belong) :?>
                      <div class="panel panel-default">
                        <div class="panel-body">
                            <p><?=$number?>. <?=$belong->name_belong?></p>
                  			<?php $number++?>
                        </div>
                      </div>
               		<?php endforeach;?>
        </div>
		</div>
	</div>
</div>
