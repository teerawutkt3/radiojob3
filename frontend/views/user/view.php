<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = $this->title;
$this ->registerJs('
       function loadWork(id){
            $.ajax({
                    url : " '.Url::toRoute("/work/work-user-view?id=").' "+id,
                    method : "GET",
            }).done( function (txt) {
                 $("#data").html(txt);
            })
            return false;
        }
    
',View::POS_END);
?>
<style>
.panel-body1 {
background: 		#04859D	; /* #006363 */
color:#FFFFFF;
box-shadow: 5px 5px 5px 5px rgba(50,50,50,.4);
} 

</style>

<div class="user-view">


    <div class="panel panel-default">
         <div class="panel-body panel-body1">
          		<i class="glyphicon glyphicon-user"></i> <?=$model->fname." ".$model->lname?>
          			<?php if (Yii::$app->user->id != $model->id){
          			
          			}else{?>
          		    <div class="pull-right">
          		    <?=Html::a('','/work/calendar?id='.$model->id,['class'=>'btn btn-default 	glyphicon glyphicon-calendar',
          		        'title'=>'กำหนดกิจกรรมที่จะมาถึง'
          		    ])?>
          		     <?php //echo  Html::a('', '/joinwork/radiologist-join', ['title'=>'กำหนดกิจกรรมที่จะมาถึง','class' => 'btn btn-warning  glyphicon glyphicon-list-alt']) ?>
                     <?=Html::a('', ['/user/resume?id='.$model->id], [
                        'class'=>'btn btn-info  glyphicon glyphicon-print', 
                        'target'=>'_blank', 
                        'data-toggle'=>'tooltip', 
                        'title'=>'print resume'
                    ]);?>
                    <?= Html::a('', ['update', 'id' => $model->id], ['title'=>'แก้ไข','class' => 'btn btn-success     	glyphicon glyphicon-pencil']) ?>
                    </div><?php }?>
		</div>
    </div> 
    <!-- end panel -->
    
    <!-- body profile -->

    
   
    <div class="row">
    
      
             	<div class="col-md-3"> 
             	  
                 	<div class="panel panel-default">
                		 <div class="panel-body ">  
                		 <?php if (!$model->fb_id){?>
                		 <img data-src="holder.js/100px280/thumb" alt="100%x280" style="height: 200px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22356%22%20height%3D%22280%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20356%20280%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_15fe3485b62%20text%20%7B%20fill%3A%23AAAAAA%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A18pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_15fe3485b62%22%3E%3Crect%20width%3D%22356%22%20height%3D%22280%22%20fill%3D%22%23EEEEEE%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22131.2890625%22%20y%3D%22148.1%22%3E356x280%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                		     
                		<?php  } else{?>
                		 <?= Html::img('https://graph.facebook.com/'.$model->fb_id.'/picture?type=large',['class' => 'thumbnail img-rounded img-responsive','width'=>300])?>
                		 		
                		 <?php }?>
                		 		<h4 class="text-center">
                		 		<a href="https://www.facebook.com/<?=$model->fb_id?>" target="_blank" class="btn btn-primary">facebook</a></h4>
                		 	
                		 	<h4 class="text-center">  <?=$model->fname." ".$model->lname?></h4>
                		 	<p class="text-center"> <span class="glyphicon glyphicon-envelope"></span> <?=$model->email?> 	</p>
                		 	<p class="text-center"> <span class="glyphicon glyphicon-map-marker"> </span> ที่อยู่ 
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
           			  <?php $content ="ไม่ได้ระบุ" ; ?>    

                 	<?php echo TabsX::widget([
                 	    'items'=>[
                 	        [
                 	            'label'=>'<i class="glyphicon glyphicon-list-alt"></i> การทำงานที่ผ่านมา',
                 	            'content'=>"<b><span class='glyphicon glyphicon-book'></span> ประสบการณ์การทำงาน  </b><br>".(!$user_extention?"ยังไม่ได้ระบุ"."<hr>" : Yii::$app->formatter->asNtext($user_extention->experience)."<hr>")
                 	            ."<b><span class='glyphicon glyphicon-import'></span> ทักษะด้านการทำงาน  </b><br>".(!$user_extention?"ยังไม่ได้ระบุ"."<hr>" :Yii::$app->formatter->asNtext($user_extention->work_skill)."<hr>")
                 	            ."<b><span class='glyphicon glyphicon-text-background'></span> ทักษะภาษา  </b><br>".(!$user_extention?"ยังไม่ได้ระบุ"."<hr>" :Yii::$app->formatter->asNtext($user_extention->language))
                 	            ,  'active'=>true
                 	        ],
                 	        [
                 	            'label'=>'<i class="glyphicon glyphicon-home"></i> การศึกษา',
                 	            'content'=>"<b><span class='glyphicon glyphicon-education'></span> วุฒิการศึกษา  </b><br> - ".(!$user_extention?"ยังไม่ได้ระบุ":$user_extention->education )//$user_extention->education
                 	            ."<br><br>"."<b><span class='glyphicon glyphicon-tags'></span> สถานศึกษา  </b><br> - ".(!$user_extention?"ยังไม่ได้ระบุ" : $user_extention->educational_institution)
                 	            ."<br><br>"."<b><span class='glyphicon glyphicon-book'></span> สาขาวิชา  </b><br> - ".(!$user_extention?"ยังไม่ได้ระบุ" : $user_extention->branch)
                 	            ,
                 	        ],

                 	        /* dropdown */
                 	        
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

    </div><hr>
    <!-- end body profile -->
   	    <div class="row">
        <div class="panel panel-default">
             <div class="panel-body panel-body1"> 
             <span class="	glyphicon glyphicon-calendar"></span> ตารางเวาลาทำงาน
             <?php if (Yii::$app->user->id != $model->id){
          			
          			}else{?>
          		    <div class="pull-right">
						<?= Html::a('ตั้งค่า <span class="glyphicon glyphicon-cog"></span>','/work/work-schedule?id='.$model->id,['class'=>'btn btn-warning ','title' => 'จัดการตารางเวลาทำงาน'])?>
          		    
                    </div><?php }?>
          		     	 
             </div> 
         </div>		<?php if ($schedule ==  null){
		
		}else {?>
        

<div class="panel panel-default "  style="overflow:auto">
  <div class="panel-body">
		<table class="table table-bordered table-hover">
    	 <thead>
    	 <tr class="text-center">
        	 <td></td>
        	 <td>00:00</td>
        	 <td>01:00</td>
        	 <td>02:00</td>
        	 <td>03:00</td>
        	 <td>04:00</td>
        	 <td>05:00</td>
        	 <td>06:00</td>
        	 <td>07:00</td>
        	 <td>08:00</td>
        	 <td>09:00</td>
        	 <td>10:00</td>
        	 <td>11:00</td>	 
        	 <td>12:00</td>
        	 <td>13:00</td>
        	 <td>14:00</td>
        	 <td>15:00</td>
        	 <td>16:00</td>
        	 <td>17:00</td>	
        	 <td>18:00</td>
        	 <td>19:00</td>
        	 <td>20:00</td>
        	 <td>21:00</td>
        	 <td>22:00</td>
        	 <td>23:00</td>	 
        	 <td></td>	
    	 </tr>
          <tr>
            <th >อาทิตย์</th>
            		<?php
            		if ($schedule->sun_time_begin ==24 ||$schedule->sun_time_end==24) {
            		    for ($count=0;$count<=23;$count++){
            		        echo '<td></td>';
            		    }
            		}else{
            		if ($schedule->sun_time_begin !=null ||$schedule->sun_time_end!=null) {
            		if ($schedule->sun_time_begin < $schedule->sun_time_end){
            		      $time_work = $schedule->sun_time_end - $schedule->sun_time_begin;  //เวลาทำงาน
            		      if ($schedule->sun_time_begin>0){
            		          for ($count=0; $count< $schedule->sun_time_begin ; $count++){
            		              echo '<td ></td>';
            		          }
            		       //   for ($count=0; $count <= $time_work; $count++){ //แสดงตารางเวลาทีทำงาน
            		          echo '<td class="" colspan="'.++$time_work.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		        //  }
            		          if ($schedule->sun_time_end < 23){
            		             $table = 23 - $schedule->sun_time_end;
            		              for ($count=0;$count<$table;$count++){
            		                    echo  '<td ></td>';
            		              }
            		           
            		          }
            		      }else{
            		          for ($count=0; $count< $schedule->sun_time_begin ; $count++){
            		              echo '<td ></td>';
            		          }
            		       //   for ($count=0; $count <= $time_work; $count++){ //แสดงตารางเวลาทีทำงาน
            		              echo '<td class="" colspan="'.++$time_work.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		       //   }
            		          if ($schedule->sun_time_end < 23){
            		              $table = 23 - $schedule->sun_time_end;
            		              for ($count=0;$count<$table;$count++){
            		                  echo  '<td ></td>';
            		              }
            		              
            		          }
            		      }
            		   
            		}elseif ($schedule->sun_time_begin == $schedule->sun_time_end){
            		    echo  '<td class="text-danger">fail</td>';
            		}else{ //time_begin< time_end
            		   // for ($count=0;$count<=$schedule->sun_time_end;$count++){
            		        $count = $schedule->sun_time_end+1 - 0;
            		        echo '<td class=""   colspan="'.$count.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		   // }//endfor;
            		    $time_empty = ($schedule->sun_time_begin -$schedule->sun_time_end)-1;
            		    for ($count=0;$count<$time_empty ;$count++){
            		        echo '<td></td>';
            		    }//endfor;
            		  //  for ($count=$schedule->sun_time_begin;$count<=23;$count++){
            		        $count = 23 - $schedule->sun_time_begin + 1 ;
            		        echo '<td class="" colspan="'.$count.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		  //  }//endfor;
            		    
            		}
            		}else{
            		      for ($count=0;$count<=23;$count++){
            		          echo '<td></td>';
            		      }
            		}
            		}
            		?>
            <th >อาทิตย์</th>
          </tr>
           <tr>
            <th>จันทร์</th>
                   	<?php
                   	if ($schedule->mon_time_begin ==24 ||$schedule->mon_time_end==24) {
                   	    for ($count=0;$count<=23;$count++){
                   	        echo '<td></td>';
                   	    }
                   	}else{
                   	if ($schedule->mon_time_begin !=null ||$schedule->mon_time_end!=null) {
                   	if ($schedule->mon_time_begin < $schedule->mon_time_end){
                   	    $time_work = $schedule->mon_time_end - $schedule->mon_time_begin;  //เวลาทำงาน
                   	    if ($schedule->mon_time_begin>0){
                   	        for ($count=0; $count< $schedule->mon_time_begin ; $count++){
            		              echo '<td ></td>';
            		          }
            		        //  for ($count=0; $count <= $time_work; $count++){ //แสดงตารางเวลาทีทำงาน
            		        //      echo '<td class="danger"></td>';
            		              echo '<td class="" colspan="'.++$time_work.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		       //   }
            		          if ($schedule->mon_time_end < 23){
            		              $table = 23 - $schedule->mon_time_end;
            		              for ($count=0;$count<$table;$count++){
            		                    echo  '<td ></td>';
            		              }
            		           
            		          }
            		      }else{
            		          for ($count=0; $count< $schedule->mon_time_begin ; $count++){
            		              echo '<td ></td>';
            		          }
            		      //   for ($count=0; $count <= $time_work; $count++){ //แสดงตารางเวลาทีทำงาน
            		              echo '<td class="" colspan="'.++$time_work.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		        //  }
            		          if ($schedule->mon_time_end < 23){
            		              $table = 23 - $schedule->mon_time_end;
            		              for ($count=0;$count<$table;$count++){
            		                  echo  '<td ></td>';
            		              }
            		              
            		          }
            		      }
            		   
                   	}elseif ($schedule->mon_time_begin == $schedule->mon_time_end){
            		    echo  '<td class="text-danger">fail</td>';
            		}else{ //time_begin< time_end
            		    $count = $schedule->mon_time_end - 0 +1;
            		    //for ($count=0;$count<=$schedule->mon_time_end;$count++){
            		        echo '<td class="" colspan="'.$count.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		 //   }//endfor;
            		    $time_empty = ($schedule->mon_time_begin -$schedule->mon_time_end)-1;
            		    for ($count=0;$count<$time_empty ;$count++){
            		        echo '<td></td>';
            		    }//endfor;
            		    $count  = 23+1 - $schedule->mon_time_begin;
            		    //for ($count=$schedule->mon_time_begin;$count<=23;$count++){
            		        echo '<td class="" colspan="'.$count.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		   // }//endfor;
            		    
            		}}else{
            		    for ($count=0;$count<=23;$count++){
            		        echo '<td></td>';
            		    }
            		}
                   	}
            		?>
             <th>จันทร์</th>
            </tr>
            <th>อังคาร</th>
                		<?php
                		if ($schedule->tues_time_begin ==24 ||$schedule->tues_time_end==24) {
                		    for ($count=0;$count<=23;$count++){
                		        echo '<td></td>';
                		    }
                		}else{
                		if ($schedule->tues_time_begin !=null ||$schedule->tues_time_end!=null) {
                		if ($schedule->tues_time_begin < $schedule->tues_time_end){
                		    $time_work = $schedule->tues_time_end - $schedule->tues_time_begin;  //เวลาทำงาน
                		    if ($schedule->tues_time_begin>0){
                   	        for ($count=0; $count< $schedule->tues_time_begin ; $count++){
            		              echo '<td ></td>';
            		          }
            		      //    for ($count=0; $count <= $time_work; $count++){ //แสดงตารางเวลาทีทำงาน
            		              echo '<td class="" colspan="'.++$time_work.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		         /// }
            		          if ($schedule->tues_time_end < 23){
            		              $table = 23 - $schedule->tues_time_end;
            		              for ($count=0;$count<$table;$count++){
            		                    echo  '<td ></td>';
            		              }
            		           
            		          }
            		      }else{
            		          for ($count=0; $count< $schedule->tues_time_begin ; $count++){
            		              echo '<td ></td>';
            		          }
            		       //   for ($count=0; $count <= $time_work; $count++){ //แสดงตารางเวลาทีทำงาน
            		          echo '<td class="" colspan="'.++$time_work.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		      //    }
            		          if ($schedule->tues_time_end < 23){
            		              $table = 23 - $schedule->tues_time_end;
            		              for ($count=0;$count<$table;$count++){
            		                  echo  '<td ></td>';
            		              }
            		              
            		          }
            		      }
            		   
                   	}elseif ($schedule->tues_time_begin == $schedule->tues_time_end){
                   	    echo  '<td class="text-danger">fail</td>';
            		}else{ //time_begin< time_end
            		    $count = $schedule->tues_time_end +1;
            		 //   for ($count=0;$count<=$schedule->tues_time_end;$count++){
            		        echo '<td class="" colspan="'.$count.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		  //  }//endfor;
            		    $time_empty = ($schedule->tues_time_begin -$schedule->tues_time_end)-1;
            		    for ($count=0;$count<$time_empty ;$count++){
            		        echo '<td></td>';
            		    }//endfor;
            		    $count = 23+1 -$schedule->tues_time_begin;
            		   // for ($count=$schedule->tues_time_begin;$count<=23;$count++){
            		        echo '<td class="" colspan="'.$count.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		   // }//endfor;
            		    
            		}}else{
            		    for ($count=0;$count<=23;$count++){
            		        echo '<td></td>';
            		    }
            		}
                		}
            		?>
             <th>อังคาร</th>
            <tr>
            <th>พุธ</th>
            		<?php
            		if ($schedule->wed_time_begin ==24 ||$schedule->wed_time_end==24) {
            		    for ($count=0;$count<=23;$count++){
            		        echo '<td></td>';
            		    }
            		}else{
            		if ($schedule->wed_time_begin !=null ||$schedule->wed_time_end!=null) {
            		  
            		if ($schedule->wed_time_begin < $schedule->wed_time_end){
            		    $time_work = $schedule->wed_time_end - $schedule->wed_time_begin;  //เวลาทำงาน
                		    if ($schedule->wed_time_begin>0){
                		        for ($count=0; $count< $schedule->wed_time_begin ; $count++){
            		              echo '<td ></td>';
            		          }
            		       //   for ($count=0; $count <= $time_work; $count++){ //แสดงตารางเวลาทีทำงาน
            		          echo '<td class="" colspan="'.++$time_work.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		       //   }
            		          if ($schedule->wed_time_end < 23){
            		              $table = 23 - $schedule->wed_time_end;
            		              for ($count=0;$count<$table;$count++){
            		                    echo  '<td ></td>';
            		              }
            		           
            		          }
            		      }else{
            		          for ($count=0; $count< $schedule->wed_time_begin ; $count++){
            		              echo '<td ></td>';
            		          }
            		       //   for ($count=0; $count <= $time_work; $count++){ //แสดงตารางเวลาทีทำงาน
            		              echo '<td class="" colspan="'.++$time_work.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		      //    }
            		          if ($schedule->wed_time_end < 23){
            		              $table = 23 - $schedule->wed_time_end;
            		              for ($count=0;$count<$table;$count++){
            		                  echo  '<td ></td>';
            		              }
            		              
            		          }
            		      }
            		   
                		}elseif ($schedule->wed_time_begin == $schedule->wed_time_end){
                		    echo  '<td class="text-danger">fail</td>';
            		}else{ //time_begin< time_end
            		    $count = $schedule->wed_time_end +1;
            		   // for ($count=0;$count<=$schedule->wed_time_end;$count++){
            		        echo '<td class="" colspan="'.$count.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		    //}//endfor;
            		    $time_empty = ($schedule->wed_time_begin -$schedule->wed_time_end)-1;
            		    for ($count=0;$count<$time_empty ;$count++){
            		        echo '<td></td>';
            		    }//endfor;
            		    $count = 24 - $schedule->wed_time_begin;
            		   // for ($count=$schedule->wed_time_begin;$count<=23;$count++){
            		        echo '<td class="" colspan="'.$count.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		  //  }//endfor;
            		    
            		}
                
            		}else{
            		    for ($count=0;$count<=23;$count++){
            		        echo '<td></td>';
            		    }
            		}
            		}
            		?>
            <th>พุธ</th>
            </tr>
            <tr>
             <th>พฤหัสบดี</th>
             <?php
             if ($schedule->thurs_time_begin ==24 ||$schedule->thurs_time_end==24) {
                 for ($count=0;$count<=23;$count++){
                     echo '<td></td>';
                 }
             }else{
             if ($schedule->thurs_time_begin !=null ||$schedule->thurs_time_end!=null) {
                
             if ($schedule->thurs_time_begin < $schedule->thurs_time_end){
                 $time_work = $schedule->thurs_time_end - $schedule->thurs_time_begin;  //เวลาทำงาน
                 if ($schedule->thurs_time_begin>0){
                     for ($count=0; $count< $schedule->thurs_time_begin ; $count++){
            		              echo '<td ></td>';
            		          }
            		       //   for ($count=0; $count <= $time_work; $count++){ //แสดงตารางเวลาทีทำงาน
            		          echo '<td class="" colspan="'.++$time_work.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		       //   }
            		          if ($schedule->thurs_time_end < 23){
            		              $table = 23 - $schedule->thurs_time_end;
            		              for ($count=0;$count<$table;$count++){
            		                    echo  '<td ></td>';
            		              }
            		           
            		          }
            		      }else{
            		          for ($count=0; $count< $schedule->thurs_time_begin ; $count++){
            		              echo '<td ></td>';
            		          }
            		        //  for ($count=0; $count <= $time_work; $count++){ //แสดงตารางเวลาทีทำงาน
            		          echo '<td class="" colspan="'.++$time_work.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		         // }
            		          if ($schedule->thurs_time_end < 23){
            		              $table = 23 - $schedule->thurs_time_end;
            		              for ($count=0;$count<$table;$count++){
            		                  echo  '<td ></td>';
            		              }
            		              
            		          }
            		      }
            		   
            		}elseif ($schedule->thurs_time_begin == $schedule->thurs_time_end){
            		    echo  '<td class="text-danger">fail</td>';
            		}else{ //time_begin< time_end
            		  //  for ($count=0;$count<=$schedule->thurs_time_end;$count++){
            		    $count = $schedule->thurs_time_end+1;
            		    echo '<td class="" colspan="'.$count.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		  //  }//endfor;
            		    $time_empty = ($schedule->thurs_time_begin -$schedule->thurs_time_end)-1;
            		    for ($count=0;$count<$time_empty ;$count++){
            		        echo '<td></td>';
            		    }//endfor;
            		   // for ($count=$schedule->thurs_time_begin;$count<=23;$count++){
            		    $count = 24 - $schedule->thurs_time_begin;
            		        echo '<td class="" colspan="'.$count.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		   // }//endfor;
            		    
            		}	
          
                 }else{
            		    for ($count=0;$count<=23;$count++){
            		        echo '<td></td>';
            		    }
            		}
             }
            		?>
             <th>พฤหัสบดี</th>
            </tr>
            <tr>
            <th>ศุกร์</th>
              <?php
              if ($schedule->fri_time_begin ==24 ||$schedule->fri_time_end==24) {
                  for ($count=0;$count<=23;$count++){
                      echo '<td></td>';
                  }
              }else{
              if ($schedule->fri_time_begin !=null ||$schedule->fri_time_end!=null) {
                  
              if ($schedule->fri_time_begin < $schedule->fri_time_end){
                  $time_work = $schedule->fri_time_end - $schedule->fri_time_begin;  //เวลาทำงาน
                  if ($schedule->fri_time_begin>0){
                      for ($count=0; $count< $schedule->fri_time_begin ; $count++){
            		              echo '<td ></td>';
            		          }
            		         // for ($count=0; $count <= $time_work; $count++){ //แสดงตารางเวลาทีทำงาน
            		              echo '<td class="" colspan="'.++$time_work.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		         // }
            		          if ($schedule->fri_time_end < 23){
            		              $table = 23 - $schedule->fri_time_end;
            		              for ($count=0;$count<$table;$count++){
            		                    echo  '<td ></td>';
            		              }
            		           
            		          }
            		      }else{
            		          for ($count=0; $count< $schedule->fri_time_begin ; $count++){
            		              echo '<td ></td>';
            		          }
            		          //for ($count=0; $count <= $time_work; $count++){ //แสดงตารางเวลาทีทำงาน
            		              echo '<td class="" colspan="'.++$time_work.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		        //  }
            		          if ($schedule->fri_time_end < 23){
            		              $table = 23 - $schedule->fri_time_end;
            		              for ($count=0;$count<$table;$count++){
            		                  echo  '<td ></td>';
            		              }
            		              
            		          }
            		      }
            		   
             }elseif ($schedule->fri_time_begin == $schedule->fri_time_end){
                 echo  '<td class="text-danger">fail</td>';
            		}else{ //time_begin< time_end
            		 //   for ($count=0;$count<=$schedule->fri_time_end;$count++){
            		    $count = $schedule->fri_time_end +1;
            		        echo '<td class="" colspan="'.$count.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		  //  }//endfor;
            		    $time_empty = ($schedule->fri_time_begin -$schedule->fri_time_end)-1;
            		    for ($count=0;$count<$time_empty ;$count++){
            		        echo '<td></td>';
            		    }//endfor;
            		 //   for ($count=$schedule->fri_time_begin;$count<=23;$count++){
            		    $count = 24 - $schedule->fri_time_begin;
            		    echo '<td class="" colspan="'.$count.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		  //  }//endfor;
            		    
            		}
           
              }else{
            		    for ($count=0;$count<=23;$count++){
            		        echo '<td></td>';
            		    }
            		}
              }
            		?>
             <th>ศุกร์</th>
            </tr><tr>
            
             <th>เสาร์</th>
              <?php
              if ($schedule->sat_time_begin ==24 ||$schedule->sat_time_end==24) {
                  for ($count=0;$count<=23;$count++){
                      echo '<td></td>';
                  }
              }else{
              if ($schedule->sat_time_begin !=null ||$schedule->sat_time_end!=null) {
              if ($schedule->sat_time_begin < $schedule->sat_time_end){
                  $time_work = $schedule->sat_time_end - $schedule->sat_time_begin;  //เวลาทำงาน
                  if ($schedule->sat_time_begin>0){
                      for ($count=0; $count< $schedule->sat_time_begin ; $count++){
            		              echo '<td ></td>';
            		          }
            		         // for ($count=0; $count <= $time_work; $count++){ //แสดงตารางเวลาทีทำงาน
            		              echo '<td class="" colspan="'.++$time_work.'">
                                    <button class="btn btn-block btn-xs btn-warning">working</button>
                                    </td>';
            		       //   }
            		          if ($schedule->sat_time_end < 23){
            		              $table = 23 - $schedule->sat_time_end;
            		              for ($count=0;$count<$table;$count++){
            		                    echo  '<td ></td>';
            		              }
            		           
            		          }
            		      }else{
            		          for ($count=0; $count< $schedule->sat_time_begin ; $count++){
            		              echo '<td ></td>';
            		          }
            		        //  for ($count=0; $count <= $time_work; $count++){ //แสดงตารางเวลาทีทำงาน
            		          echo '<td class="" colspan="'.++$time_work.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		        //  }
            		          if ($schedule->sat_time_end < 23){
            		              $table = 23 - $schedule->sat_time_end;
            		              for ($count=0;$count<$table;$count++){
            		                  echo  '<td ></td>';
            		              }
            		              
            		          }
            		      }
            		   
              }elseif ($schedule->sat_time_begin == $schedule->sat_time_end){
            		
            		        echo  '<td class="text-danger">fail</td>';
            		   
            		}else{ //time_begin< time_end
            		    //for ($count=0;$count<=$schedule->sat_time_end;$count++){
            		    $count =  $schedule->sat_time_end +1;
            		        echo '<td class="" colspan="'.$count.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		   // }//endfor;
            		    $time_empty = ($schedule->sat_time_begin -$schedule->sat_time_end)-1;
            		    for ($count=0;$count<$time_empty ;$count++){
            		        echo '<td></td>';
            		    }//endfor;
            		   // for ($count=$schedule->sat_time_begin;$count<=23;$count++){
            		    $count = 24 - $schedule->sat_time_begin;
            		        echo '<td class="" colspan="'.$count.'"> <button class="btn btn-block btn-xs btn-warning">working</button></td>';
            		   // }//endfor;
            		    
            		}}else{
            		    for ($count=0;$count<=23;$count++){
            		        echo '<td></td>';
            		    }
            		}
              }
            		?>
             <th>เสาร์</th>
          </tr>
        </thead>
        <tbody>
     
    </tbody>
</table>
</div>
</div>     
<?php }?>
</div>
         
    </div> <!-- end row -->
   	<hr>
    <div class="row">
    <div class="panel panel-default"> <div class="panel-body panel-body1"><span class="	glyphicon glyphicon-th-list"></span> การร่วมงานทั้งหมด </div> </div>

    </div> <!-- end row -->
    
    <div class="row">
    	<div class="col-md-4">
    	<div class="panel panel-default">
    	<div class="panel-heading">การร่วมงานทั้งหมด : <?=$count_join_work?></div>
    	 <div class="panel-body ">
    		<div class="list-group" style="height:600px; overflow:auto">
    		<?php $count=0; foreach ($join_work as $data):?>
              <a href="#" onclick="return loadWork(<?= $data->work_id?>)" class="list-group-item"><?=++$count?>. <?=$data->work->name_office?>
              	<br>เริ่มทำงานเมื่อ : <?=Yii::$app->formatter->asDate($data->join_created_at,'d MMM yyyy')?>
              	<br>สิ้นสุดเมื่อ : <?=Yii::$app->formatter->asDate($data->join_updated_at,'d MMM yyyy')?>
            	<span class="badge glyphicon glyphicon-hand-right"> รายละเอียด</span> 
              </a>
            <?php endforeach;?>	
            
            </div>
            </div> </div>
    	</div>
    	<div class="col-md-8" id="data"></div>
    </div>




