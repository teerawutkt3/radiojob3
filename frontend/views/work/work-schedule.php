<?php 

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'จัดการตารางเวลา';
$this->params['breadcrumbs'][] = $this->title;


?>
<style>
.panel-body1 {
background: 		#04859D	; /* #006363 */
color:#FFFFFF;
box-shadow: 5px 5px 5px 5px rgba(50,50,50,.4);

} 
.td1{
background:#CC3333;

font-family:Tahoma, Geneva, sans-serif;

font-size:14px;  

padding: 5px 5px 5px 5px;

color: #fff;

font-weight: bold;

-moz-border-radius: 30px;

-webkit-border-radius: 30px;

-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);

-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);

text-shadow: 0 -1px 1px rgba(0,0,0,0.25);

border-bottom: 1px solid rgba(0,0,0,0.25);

cursor: pointer;

border-left:none;

border-top:none;

margin:10px 0 10px 0;
box-shadow: 5px 5px 5px 1px rgba(50,50,50,.4);
}



</style>
<div class="work-schedule">
 <div class="panel panel-default">
              <div class="panel-body panel-body1 "><h3 class="text-center" ><span class="	glyphicon glyphicon-calendar"></span> <?= Html::encode($this->title) ?></h3></div>
    </div>

		<div class="row">
				<div class="col-md-4">
    				
				</div>
				<div class="col-md-8">
				<div class=" pull-right">
						<?=Html::a(' ตั้งค่า <span class="glyphicon glyphicon-cog"></span>','#',[
                		    'class'=>'btn btn-danger ',
                		    'title'=>'ตั้งค่าตารางเวลา',
                		    'data-toggle'=>'modal', 
                		    'data-target'=>'#myModal'
                		])?>
                </div>
				</div>
				
		</div><br>
		
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
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">จัดการตารางเวลาทำงาน</h4>
      </div>
      <div class="modal-body">
        	  <?php $form = ActiveForm::begin(); ?>
        	  <div class="row">
        	  <div class="col-md-6">
        	  <div class="panel panel-default">
        	  <div class="panel-heading">วันอาทิตย์</div>
 			 <div class="panel-body">
 			 <div class="row">
 			 <div class="col-md-6"><?= $form->field($schedule, 'sun_time_begin')->dropDownList([
        	      24 => 'เริ่มทำงาน',
        	      0=> '00:00',
        	      1=> '01:00 ',
        	      2=> '02:00 ',
        	      3 => '03:00 ',
        	      4=> '04:00 ',
        	      5 => '05:00 ',
        	      6=> '06:00 ',
        	      7 => '07:00 ',
        	      8=> '08:00 ',
        	      9 => '09:00 ',
        	      10=> '10:00 ',
        	      11 => '11:00 ',
        	      12=> '12:00 ',
        	      13 => '13:00 ',
        	      14=> '14:00 ',
        	      15 => '15:00 ',
        	      16=> '16:00 ',
        	      17 => '17:00 ',
        	      18=> '18:00 ',
        	      19 => '19:00 ',
        	      20=> '20:00 ',
        	      21 => '21:00 ',
        	      22=> '22:00 ',
        	      23=> '23:00 ',
        	      
        	  ]); ?></div>
 			 <div class="col-md-6"> <?= $form->field($schedule, 'sun_time_end')->dropDownList([
        	      	24 => 'เลิกทำงาน',
        	      0=> '00:00',
        	      1=> '01:00 ',
        	      2=> '02:00 ',
        	      3 => '03:00 ',
        	      4=> '04:00 ',
        	      5 => '05:00 ',
        	      6=> '06:00 ',
        	      7 => '07:00 ',
        	      8=> '08:00 ',
        	      9 => '09:00 ',
        	      10=> '10:00 ',
        	      11 => '11:00 ',
        	      12=> '12:00 ',
        	      13 => '13:00 ',
        	      14=> '14:00 ',
        	      15 => '15:00 ',
        	      16=> '16:00 ',
        	      17 => '17:00 ',
        	      18=> '18:00 ',
        	      19 => '19:00 ',
        	      20=> '20:00 ',
        	      21 => '21:00 ',
        	      22=> '22:00 ',
        	      23=> '23:00 ',
        	  ]); ?></div>
 			 </div>
        	 </div> <!-- end panel body -->
            </div><!-- end panel -->
            </div><!-- end col-md-6 -->
        	  	<div class="col-md-6">
        	  <div class="panel panel-default">
        	  <div class="panel-heading">วันจันทร์</div>
 			 <div class="panel-body">
 			 <div class="row">
 			 <div class="col-md-6"><?= $form->field($schedule, 'mon_time_begin')->dropDownList([
        	      24 => 'เริ่มทำงาน',
        	      0=> '00:00',
        	      1=> '01:00 ',
        	      2=> '02:00 ',
        	      3 => '03:00 ',
        	      4=> '04:00 ',
        	      5 => '05:00 ',
        	      6=> '06:00 ',
        	      7 => '07:00 ',
        	      8=> '08:00 ',
        	      9 => '09:00 ',
        	      10=> '10:00 ',
        	      11 => '11:00 ',
        	      12=> '12:00 ',
        	      13 => '13:00 ',
        	      14=> '14:00 ',
        	      15 => '15:00 ',
        	      16=> '16:00 ',
        	      17 => '17:00 ',
        	      18=> '18:00 ',
        	      19 => '19:00 ',
        	      20=> '20:00 ',
        	      21 => '21:00 ',
        	      22=> '22:00 ',
        	      23=> '23:00 ',
        	      
        	  ]); ?></div>
 			 <div class="col-md-6"> <?= $form->field($schedule, 'mon_time_end')->dropDownList([
        	      24=> 'เลิกทำงาน',
        	      0=> '00:00',
        	      1=> '01:00 ',
        	      2=> '02:00 ',
        	      3 => '03:00 ',
        	      4=> '04:00 ',
        	      5 => '05:00 ',
        	      6=> '06:00 ',
        	      7 => '07:00 ',
        	      8=> '08:00 ',
        	      9 => '09:00 ',
        	      10=> '10:00 ',
        	      11 => '11:00 ',
        	      12=> '12:00 ',
        	      13 => '13:00 ',
        	      14=> '14:00 ',
        	      15 => '15:00 ',
        	      16=> '16:00 ',
        	      17 => '17:00 ',
        	      18=> '18:00 ',
        	      19 => '19:00 ',
        	      20=> '20:00 ',
        	      21 => '21:00 ',
        	      22=> '22:00 ',
        	      23=> '23:00 ',
        	  ]); ?></div>
 			 </div>
        	 </div> <!-- end panel body -->
            </div><!-- end panel -->
            </div><!-- end col-md-6 -->
            <!-- tues -->
            <div class="col-md-6">
        	  <div class="panel panel-default">
        	  <div class="panel-heading">วันอังคาร</div>
 			 <div class="panel-body">
 			 <div class="row">
 			 <div class="col-md-6"><?= $form->field($schedule, 'tues_time_begin')->dropDownList([
        	      24 => 'เริ่มทำงาน',
        	      0=> '00:00',
        	      1=> '01:00 ',
        	      2=> '02:00 ',
        	      3 => '03:00 ',
        	      4=> '04:00 ',
        	      5 => '05:00 ',
        	      6=> '06:00 ',
        	      7 => '07:00 ',
        	      8=> '08:00 ',
        	      9 => '09:00 ',
        	      10=> '10:00 ',
        	      11 => '11:00 ',
        	      12=> '12:00 ',
        	      13 => '13:00 ',
        	      14=> '14:00 ',
        	      15 => '15:00 ',
        	      16=> '16:00 ',
        	      17 => '17:00 ',
        	      18=> '18:00 ',
        	      19 => '19:00 ',
        	      20=> '20:00 ',
        	      21 => '21:00 ',
        	      22=> '22:00 ',
        	      23=> '23:00 ',
        	      
        	  ]); ?></div>
 			 <div class="col-md-6"> <?= $form->field($schedule, 'tues_time_end')->dropDownList([
        	      24 => 'เลิกทำงาน',
        	      0=> '00:00',
        	      1=> '01:00 ',
        	      2=> '02:00 ',
        	      3 => '03:00 ',
        	      4=> '04:00 ',
        	      5 => '05:00 ',
        	      6=> '06:00 ',
        	      7 => '07:00 ',
        	      8=> '08:00 ',
        	      9 => '09:00 ',
        	      10=> '10:00 ',
        	      11 => '11:00 ',
        	      12=> '12:00 ',
        	      13 => '13:00 ',
        	      14=> '14:00 ',
        	      15 => '15:00 ',
        	      16=> '16:00 ',
        	      17 => '17:00 ',
        	      18=> '18:00 ',
        	      19 => '19:00 ',
        	      20=> '20:00 ',
        	      21 => '21:00 ',
        	      22=> '22:00 ',
        	      23=> '23:00 ',
        	  ]); ?></div>
 			 </div>
        	 </div> <!-- end panel body -->
            </div><!-- end panel -->
            </div><!-- end col-md-6 -->
            <!-- wednesday -->
            <div class="col-md-6">
        	  <div class="panel panel-default">
        	  <div class="panel-heading">วันพุธ</div>
 			 <div class="panel-body">
 			 <div class="row">
 			 <div class="col-md-6"><?= $form->field($schedule, 'wed_time_begin')->dropDownList([
        	     24 => 'เริ่มทำงาน',
        	      0=> '00:00',
        	      1=> '01:00 ',
        	      2=> '02:00 ',
        	      3 => '03:00 ',
        	      4=> '04:00 ',
        	      5 => '05:00 ',
        	      6=> '06:00 ',
        	      7 => '07:00 ',
        	      8=> '08:00 ',
        	      9 => '09:00 ',
        	      10=> '10:00 ',
        	      11 => '11:00 ',
        	      12=> '12:00 ',
        	      13 => '13:00 ',
        	      14=> '14:00 ',
        	      15 => '15:00 ',
        	      16=> '16:00 ',
        	      17 => '17:00 ',
        	      18=> '18:00 ',
        	      19 => '19:00 ',
        	      20=> '20:00 ',
        	      21 => '21:00 ',
        	      22=> '22:00 ',
        	      23=> '23:00 ',
        	      
        	  ]); ?></div>
 			 <div class="col-md-6"> <?= $form->field($schedule, 'wed_time_end')->dropDownList([
        	      	24 => 'เลิกทำงาน',
        	      0=> '00:00',
        	      1=> '01:00 ',
        	      2=> '02:00 ',
        	      3 => '03:00 ',
        	      4=> '04:00 ',
        	      5 => '05:00 ',
        	      6=> '06:00 ',
        	      7 => '07:00 ',
        	      8=> '08:00 ',
        	      9 => '09:00 ',
        	      10=> '10:00 ',
        	      11 => '11:00 ',
        	      12=> '12:00 ',
        	      13 => '13:00 ',
        	      14=> '14:00 ',
        	      15 => '15:00 ',
        	      16=> '16:00 ',
        	      17 => '17:00 ',
        	      18=> '18:00 ',
        	      19 => '19:00 ',
        	      20=> '20:00 ',
        	      21 => '21:00 ',
        	      22=> '22:00 ',
        	      23=> '23:00 ',
        	  ]); ?></div>
 			 </div>
        	 </div> <!-- end panel body -->
            </div><!-- end panel -->
            </div><!-- end col-md-6 -->
            <div class="col-md-6">
        	  <div class="panel panel-default">
        	  <div class="panel-heading">วันพฤหัสบดี	</div>
 			 <div class="panel-body">
 			 <div class="row">
 			 <div class="col-md-6"><?= $form->field($schedule, 'thurs_time_begin')->dropDownList([
        	      24 => 'เริ่มทำงาน',
        	      0=> '00:00',
        	      1=> '01:00 ',
        	      2=> '02:00 ',
        	      3 => '03:00 ',
        	      4=> '04:00 ',
        	      5 => '05:00 ',
        	      6=> '06:00 ',
        	      7 => '07:00 ',
        	      8=> '08:00 ',
        	      9 => '09:00 ',
        	      10=> '10:00 ',
        	      11 => '11:00 ',
        	      12=> '12:00 ',
        	      13 => '13:00 ',
        	      14=> '14:00 ',
        	      15 => '15:00 ',
        	      16=> '16:00 ',
        	      17 => '17:00 ',
        	      18=> '18:00 ',
        	      19 => '19:00 ',
        	      20=> '20:00 ',
        	      21 => '21:00 ',
        	      22=> '22:00 ',
        	      23=> '23:00 ',
        	      
        	  ]); ?></div>
 			 <div class="col-md-6"> <?= $form->field($schedule, 'thurs_time_end')->dropDownList([
        	      	24=> 'เลิกทำงาน',
        	      0=> '00:00',
        	      1=> '01:00 ',
        	      2=> '02:00 ',
        	      3 => '03:00 ',
        	      4=> '04:00 ',
        	      5 => '05:00 ',
        	      6=> '06:00 ',
        	      7 => '07:00 ',
        	      8=> '08:00 ',
        	      9 => '09:00 ',
        	      10=> '10:00 ',
        	      11 => '11:00 ',
        	      12=> '12:00 ',
        	      13 => '13:00 ',
        	      14=> '14:00 ',
        	      15 => '15:00 ',
        	      16=> '16:00 ',
        	      17 => '17:00 ',
        	      18=> '18:00 ',
        	      19 => '19:00 ',
        	      20=> '20:00 ',
        	      21 => '21:00 ',
        	      22=> '22:00 ',
        	      23=> '23:00 ',
        	  ]); ?></div>
 			 </div>
        	 </div> <!-- end panel body -->
            </div><!-- end panel -->
            </div><!-- end col-md-6 -->
            <!-- fir -->
            <div class="col-md-6">
        	  <div class="panel panel-default">
        	  <div class="panel-heading">วันศุกร์</div>
 			 <div class="panel-body">
 			 <div class="row">
 			 <div class="col-md-6"><?= $form->field($schedule, 'fri_time_begin')->dropDownList([
        	      24=> 'เริ่มทำงาน',
        	      0=> '00:00',
        	      1=> '01:00 ',
        	      2=> '02:00 ',
        	      3 => '03:00 ',
        	      4=> '04:00 ',
        	      5 => '05:00 ',
        	      6=> '06:00 ',
        	      7 => '07:00 ',
        	      8=> '08:00 ',
        	      9 => '09:00 ',
        	      10=> '10:00 ',
        	      11 => '11:00 ',
        	      12=> '12:00 ',
        	      13 => '13:00 ',
        	      14=> '14:00 ',
        	      15 => '15:00 ',
        	      16=> '16:00 ',
        	      17 => '17:00 ',
        	      18=> '18:00 ',
        	      19 => '19:00 ',
        	      20=> '20:00 ',
        	      21 => '21:00 ',
        	      22=> '22:00 ',
        	      23=> '23:00 ',
        	      
        	  ]); ?></div>
 			 <div class="col-md-6"> <?= $form->field($schedule, 'fri_time_end')->dropDownList([
        	      	24 => 'เลิกทำงาน',
        	      0=> '00:00',
        	      1=> '01:00 ',
        	      2=> '02:00 ',
        	      3 => '03:00 ',
        	      4=> '04:00 ',
        	      5 => '05:00 ',
        	      6=> '06:00 ',
        	      7 => '07:00 ',
        	      8=> '08:00 ',
        	      9 => '09:00 ',
        	      10=> '10:00 ',
        	      11 => '11:00 ',
        	      12=> '12:00 ',
        	      13 => '13:00 ',
        	      14=> '14:00 ',
        	      15 => '15:00 ',
        	      16=> '16:00 ',
        	      17 => '17:00 ',
        	      18=> '18:00 ',
        	      19 => '19:00 ',
        	      20=> '20:00 ',
        	      21 => '21:00 ',
        	      22=> '22:00 ',
        	      23=> '23:00 ',
        	  ]); ?></div>
 			 </div>
        	 </div> <!-- end panel body -->
            </div><!-- end panel -->
            </div><!-- end col-md-6 -->
            <div class="col-md-6">
        	  <div class="panel panel-default">
        	  <div class="panel-heading">วันเสาร์</div>
 			 <div class="panel-body">
 			 <div class="row">
 			 <div class="col-md-6"><?= $form->field($schedule, 'sat_time_begin')->dropDownList([
        	     24 => 'เริ่มทำงาน',
        	      0=> '00:00',
        	      1=> '01:00 ',
        	      2=> '02:00 ',
        	      3 => '03:00 ',
        	      4=> '04:00 ',
        	      5 => '05:00 ',
        	      6=> '06:00 ',
        	      7 => '07:00 ',
        	      8=> '08:00 ',
        	      9 => '09:00 ',
        	      10=> '10:00 ',
        	      11 => '11:00 ',
        	      12=> '12:00 ',
        	      13 => '13:00 ',
        	      14=> '14:00 ',
        	      15 => '15:00 ',
        	      16=> '16:00 ',
        	      17 => '17:00 ',
        	      18=> '18:00 ',
        	      19 => '19:00 ',
        	      20=> '20:00 ',
        	      21 => '21:00 ',
        	      22=> '22:00 ',
        	      23=> '23:00 ',
        	      
        	  ]); ?></div>
 			 <div class="col-md-6"> <?= $form->field($schedule, 'sat_time_end')->dropDownList([
        	      	24 => 'เลิกทำงาน',
        	      0=> '00:00',
        	      1=> '01:00 ',
        	      2=> '02:00 ',
        	      3 => '03:00 ',
        	      4=> '04:00 ',
        	      5 => '05:00 ',
        	      6=> '06:00 ',
        	      7 => '07:00 ',
        	      8=> '08:00 ',
        	      9 => '09:00 ',
        	      10=> '10:00 ',
        	      11 => '11:00 ',
        	      12=> '12:00 ',
        	      13 => '13:00 ',
        	      14=> '14:00 ',
        	      15 => '15:00 ',
        	      16=> '16:00 ',
        	      17 => '17:00 ',
        	      18=> '18:00 ',
        	      19 => '19:00 ',
        	      20=> '20:00 ',
        	      21 => '21:00 ',
        	      22=> '22:00 ',
        	      23=> '23:00 ',
        	  ]); ?></div>
 			 </div>
        	 </div> <!-- end panel body -->
            </div><!-- end panel -->
            </div><!-- end col-md-6 -->
        	  </div> <!-- endrow -->
      </div>
      <div class="modal-footer">
      <?=Html::submitButton('ตกลง',['class'=>'btn btn-primary'])?>
        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
         <?php ActiveForm::end(); ?>
      </div>
    </div>

  </div>
</div>