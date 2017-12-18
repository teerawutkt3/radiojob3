<?php

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
    <style>
.panel-body1 {
background: 	#04859D	;
color:#FFFFFF;
box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
} 

</style>
<div class="user-view">

    


    <div class="panel panel-default">
         <div class="panel-body panel-body1">
          		<i class="glyphicon glyphicon-user"></i> <?=$model->fname." ".$model->lname?>
          		<?php //echo Html::a('', ['update', 'id' => $model->id], ['title'=>'แก้ไข','class' => 'btn btn-warning pull-right 	glyphicon glyphicon-pencil']) ?>     	 
		</div>
    </div> 
    <!-- end panel -->
    
    <!-- body profile -->
   
    <div class="row">
    
        <div class="panel panel-default">
             <div class="panel-body  ">
             	<div class="col-md-3"> 
             	  
                 	<div class="panel panel-default">
                		 <div class="panel-body ">  
                		 	<img src="http://placehold.it/380x400" alt="" class="img-rounded img-responsive" />
                		 	<h4 class="text-center">  <?=$model->fname." ".$model->lname?></h4>
                		 	<p> <span class="glyphicon glyphicon-envelope"></span> <?=$model->email?> 	</p>
                		 	<p> <span class="glyphicon glyphicon-map-marker"> </span> ที่อยู่ 
                                <?php 
                                        if (!$model->address_id){
                                            echo " ";
                                        }else{
                                            echo  $model->address->nameAddress;
                                        
                                        }
                                ?></p>
                		  </div>
                	</div>
             </div>
             	<div class="col-md-9">
          			<div class="panel panel-default">
           			  <div class="panel-body  ">
           			  <?php $content ="ไม่ได้ระบุ"              ?>
                 	<?php echo TabsX::widget([
                 	    'items'=>[
                 	        [
                 	            'label'=>'<i class="glyphicon glyphicon-home"></i> การศึกษา',
                 	            'content'=>"<b><span class='glyphicon glyphicon-education'></span> วุฒิการศึกษา  </b><br> - ".(!$user_extention?"ยังไม่ได้ระบุ":$user_extention->education )//$user_extention->education
                 	            ."<br><br>"."<b><span class='glyphicon glyphicon-tags'></span> สถานศึกษา  </b><br> - ".(!$user_extention?"ยังไม่ได้ระบุ" : $user_extention->educational_institution)
                 	            ."<br><br>"."<b><span class='glyphicon glyphicon-book'></span> สาขาวิชา  </b><br> - ".(!$user_extention?"ยังไม่ได้ระบุ" : $user_extention->branch)
                 	            ,
                 	            'active'=>true
                 	        ],
                 	        [
                 	            'label'=>'<i class="glyphicon glyphicon-list-alt"></i> การทำงาน',
                 	            'content'=>"<b><span class='glyphicon glyphicon-book'></span> ประสบการณ์การทำงาน  </b><br>".(!$user_extention?"ยังไม่ได้ระบุ"."<hr>" : Yii::$app->formatter->asNtext($user_extention->experience)."<hr>")
                 	            ."<b><span class='glyphicon glyphicon-import'></span> ทักษะด้านการทำงาน  </b><br>".(!$user_extention?"ยังไม่ได้ระบุ"."<hr>" :Yii::$app->formatter->asNtext($user_extention->work_skill)."<hr>")
                 	            ."<b><span class='glyphicon glyphicon-text-background'></span> ทักษะภาษา  </b><br>".(!$user_extention?"ยังไม่ได้ระบุ"."<hr>" :Yii::$app->formatter->asNtext($user_extention->language)) 
                 	          //  'active'=>true
                 	        ],
                 	        [
                 	            'label'=>'<i class="glyphicon glyphicon-indent-left"></i> ใช้งาน',
                 	            'content'=>
                 	            "<br><p> <b><span class='glyphicon glyphicon-calendar'></span> สมัครเข้าใช้งาน  </b><br>วันที่ ".Yii::$app->formatter->asDatetime($model->created_at)."</p>". 
                 	            "<br><p> <b><span class='glyphicon glyphicon-pencil'></span> แก้ไขโปรไฟล์  </b><br>วันที่ ".Yii::$app->formatter->asDatetime($model->updated_at)."</p>"
                 	            ,
                 	         //   'linkOptions'=>['view'=>Url::to(['/user_extention/index'])]
                 	        ],
                 	        /* dropdown */
                 	        [
                 	            'label'=>'<i class="glyphicon glyphicon-list-alt"></i> ประวัติการร่วมงาน',
                 	            'items'=>[
                 	                [
                 	                    'label'=>'Option 1',
                 	                    'encode'=>false,
                 	                    'content'=>$content,
                 	                ],
                 	                [
                 	                    'label'=>'Option 2',
                 	                    'encode'=>false,
                 	                    'content'=>$content,
                 	                ],
                 	            ],
                 	        ],
                 	        /* dropdown */
//                  	        [
//                  	            'label'=>'<i class="glyphicon glyphicon-king"></i> Disabled',
//                  	            'headerOptions' => ['class'=>'disabled']
//                  	        ],
                 	    ],
                 	    'position'=>TabsX::POS_ABOVE,
                       // 'align'=>TabsX::ALIGN_LEFT,
                        'bordered'=>true,
                        'encodeLabels'=>false
                    ]);?>
                    </div>
                    </div>
             	</div>		
             </div>
         </div>
    </div>
    <!-- end body profile -->


</div>
