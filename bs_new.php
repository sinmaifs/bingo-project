<?
/******
	1 => 小 => sml
	2 => 大 => big

*/
class BS{

     var $in_data = [];
     var $BS_arr = [];
     var $BS_txt = '';

     var $total_part;

     function Action(){
     	$this->set_Total_part();
     	$this->get_BS();
     }
     function get_BS(){
     	$BSarr = [];
     	$BStxt = '';

     	foreach($this->in_data as $val){
     		array_push($BSarr,$val['b']);
     		$BStxt .= $val['b'];
     	}

     	$this->BS_arr = $BSarr;
     	$this->BS_txt = $BStxt;
     }
     function set_Total_part(){
     	$this->total_part = count($this->in_data);
     }

     /******
      * 取得 (Total Bs) , 大 , 小 局數 substr_count
      * */
     function get_part_in_BS(){

     	$sml = substr_count($this->BS_txt,'1');
     	$big = substr_count($this->BS_txt,'2');

     	return array('tot'=>($sml + $big),'sml'=>$sml,'big'=>$big);
     }

     /******
      * 最久沒開
      * */
     function get_Longest_no_open(){

     	$z_txt = '0';
     	$now = 1;
     	$best = 0;

     	foreach($this->BS_arr as $val){
     		if(substr_count($this->BS_txt,$z_txt) > 0){
     			$best = $now;
     		}
     		$now++;
     		$z_txt .= '0';
     	}
     	return $best;
     }

     /******
      * 取得 連續 $how 局(個) 的 小小 , 大大
      * */
     function get_continuous_($how){

          $sml = 0; //小小
          $big = 0; //大大
          $mix = 0; //大小 or 小大

          for($i=(count($this->BS_arr)-1);$i>=($how - 1);$i--){

               $t_arr = array();

               foreach(range(0,($how - 1)) as $s){
                    array_push($t_arr,$this->BS_arr[$i - $s]);
               }

               $t_ch = 1;
               $t_before = 0;
               $t_repeat = false;

               foreach($t_arr as $val){
                    if($val > 0){
                         if($t_before == $val){
                              $t_repeat = true;
                         }else{
                              $t_repeat = false;
                         }
                         $t_before = $val;
                    }else{
                         $t_ch = 0;
                         break;
                    }
               }

               if($t_ch){
                    if($t_repeat){
                         if($t_before == 1){ $sml++; }
                         if($t_before == 2){ $big++; }
                    }else{
                         $mix++;
                    }
               }
          }

          return array("how"=>$how,"big"=>$big,"sml"=>$sml,"mix"=>$mix);
     }

     /******
      * 跳開分析
      * */
     function jump_open(){

     	$vovvv = 0;
     	$vovv = 0;
     	$voooov = 0;
     	$vooov = 0;
     	$voov = 0;
     	$vov = 0;
     	$vvov = 0;

          for($i=(count($this->BS_arr)-1);$i>=5;$i--){

          	$t_0 = $this->BS_arr[$i];
          	$t_1 = $this->BS_arr[$i-1];
          	$t_2 = $this->BS_arr[$i-2];
          	$t_3 = $this->BS_arr[$i-3];
          	$t_4 = $this->BS_arr[$i-4];
          	$t_5 = $this->BS_arr[$i-5];

          	//F1
          	if($t_0 > 0){
          		//F2
          		if($t_1 == 0){
          			//F3
	          		if($t_2 == 0){
	          			//voooov
	          			if(($t_3 == 0) && ($t_4 == 0) && ($t_5 > 0)){ $voooov++; }
	          			//vooov
	          			if(($t_3 == 0) && ($t_4 > 0)){ $vooov++; }
	          			//voov
	          			if($t_3 > 0){ $voov++; }
	          		}else{
	          			//vovvv
	          			if(($t_3 > 0) && ($t_4 > 0)){ $vovvv++; }
	          			//vovv
	          			if($t_3 > 0){ $vovv++; }
	          			//vov
	          			$vov++;
	          		}
				}else{
          			//F3
					//vvov
					if(($t_2 == 0) && ($t_3 > 0)){
						$vvov++;
					}
				}
          	}
          }

          return array(
          	'vov'=>$vov,
          	'vovv'=>$vovv,
          	'vovvv'=>$vovvv,
          	'voov'=>$voov,
          	'vooov'=>$vooov,
          	'voooov'=>$voooov,
          	'vvov'=>$vvov
          );
     }
}
?>