<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

//var_dump($model);
$this->title = 'ผู้ติดต่อ';
$this->registerJs('
  function loadWork(id){
            $.ajax({
                    url : " '.Url::toRoute("/contact/contact-view?id=").' "+id,
                    method : "GET",
            }).done( function (txt) {
                 $("#data").html(txt);
            })
            return false;
        }
', View::POS_END);
?>
 <style>
       .panel-body2 {
           background: 	#FFFFFF	;
           box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
                        
        } 
 </style>
<div class="row">
		
		<div class="row">
			<div class="col-md-6">
			<h2>ผู้ติดต่อ</h2>
			<table class="table table-striped table-bordered table-hover">
			<thead >
			<tr class="info">
			<th class="text-center">ลำดับ</th>
			<th class="text-center">เรื่อง</th>
			<th class="text-center">ผู้ใช้งาน</th>
			<th class="text-center">ติดต่อเมื่อ</th>
			<th class="text-center"></th>
			
			</tr>
			</thead>
			<tbody>
			<?php $number=1;?>
				<?php foreach ($model as $model):?>
					<tr>
						<td class="text-center"><?=$number++?></td>
						<td><?=$model->subject?></td>
						<td><?=$model->user->fname." ".$model->user->lname?></td>
						<td><?=Yii::$app->formatter->asDatetime($model->contact_created_at)?></td>
						<td><?=Html::a('','',['title'=>'ดูรายละเอียด','class'=>'btn btn-warning glyphicon glyphicon-circle-arrow-right','onclick' => 'return loadWork('. $model->id.')'])?></td>
						
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
			</div> <!-- end col-md-8 -->
			<div class="col-md-5" >
        			<div class="row">
        			<h1 class="text-center">แสดงรายละเอียด</h1>
                        <div class="panel panel-default"  >
                          <div class="panel-body panel-body2 " >
                            	<div class="col-md-1"></div>
                            	<div class="col-md-10 " id="data">
                                    	
                          		</div>
                            	<div class="col-md-1"></div>
                    	</div>
                    	</div> <!-- end panel -->
                    </div>
			</div>
		</div> <!-- end row -->
		
</div>
