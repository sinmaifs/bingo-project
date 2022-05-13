<?
	include_once("top.php");
	include_once("bs.php");
?>
<!DOCTYPE html>
<html lang="zh-hant">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="format-detection" content="telephone=no" />
<title>BingoBingo Analytics</title>
<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="icon" href="img/ajax.png">
<link href="css/style.css" rel="stylesheet" />
</head>
<body>
<input type="hidden" id="final_p" value="<? echo $load_data[0]['p']; ?>" />
<input type="hidden" id="final_t" value="<? echo $load_data[0]['t']; ?>" />
<input type="hidden" id="save_33" />
<div class="toptime">
	<div>BingoBingo Analytics</div>
	<div><? echo date("Y/m/d"); ?> <span id="tt"></span></div>
	<div><span id="kk"></span><span class="s2">/203</span></div>
	<div id="aj"><img src="img/ajax.png" />自動更新</div>
</div>
<div class="toptime2">
	<div id="close_rab" class="close_rab cr_sim">X</div>
</div>
<div id="rank_any_before" class="rab">
	<div id="sim">
<input id="rab_p" type="text" value="<? echo substr($load_data[0]['p'],-3,3); ?>" /><input type="text" value="" /><input type="text" value="" /><input type="text" value="" /><input type="text" value="" /><input type="text" value="" /><input type="text" value="" /><button id="ss" onclick="save_sim()">Submit</button><input id="hidden_rab_p" type="hidden" value="<? echo $load_data[0]['p']; ?>" />
	</div>
	<table>
	<tr>
		<td>Start_Round</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>n_result</td>
	</tr>
<?
	for($i=0;$i<count($sim_data);$i++){
		echo '<tr>';
		echo '<td><span>'.$sim_data[$i]['p'].'</span></td>';
		$tmp = explode(',',$sim_data[$i]['i']);
		for($k=0;$k<7;$k++){
			echo '<td>'.@$tmp[$k].'</td>';
		}
		echo '</tr>';
	}
?>
	</table>
</div>
<div id="rank_66" class="rank_left">
	<div class="left">
		<p>NA<span>NA</span></p>
		<p>NA<span>NA</span></p>
		<p>NA<span>NA</span></p>
		<p>NA<span>NA</span></p>
		<p>NA<span>NA</span></p>
		<p>NA<span>NA</span></p>
	</div>
	<div class="right">
		<p>NA<span>NA</span></p>
		<p>NA<span>NA</span></p>
		<p>NA<span>NA</span></p>
		<p>NA<span>NA</span></p>
		<p>NA<span>NA</span></p>
		<p>NA<span>NA</span></p>
	</div>
	<div id="bt_rank" class="ch_p"></div>
	<div class="ch_ajax"><img src="img/ajax.gif" width=30 /></div>
</div>

<table id="list_all" class="now">
<?
	echo '<tr><td></td>';
	for($i=1;$i<=80;$i++){
		echo '<td>'.zerogo($i).'</td>';
	}
	echo '<td></td><td>SA</td></tr>';
	
	for($i=0;$i<count($load_data);$i++){
		
		$same = 0;
		
		echo '<tr>';
		echo '<td>'.substr($load_data[$i]['p'],-3,3).' '.$load_data[$i]['t'].'<div class="hide_p">'.$load_data[$i]['p'].'</div></td>';
		
		
		$nowdata = explode(',',$load_data[$i]['o']);
		
		for($k=1;$k<=80;$k++){
			$has = 0;
			foreach($nowdata as $val){
				if($val == $k){
					$has = 1;
				}
			}
			if($has){
				$cc2 = 0;
				foreach(@explode(',',$load_data[$i+1]['o']) as $check1){
					if($k == $check1){
						$cc2 = 1;
					}
				}
				
				if($cc2){
					$same++;
					echo '<td class="repeat">'.zerogo($k).'</td>';
				}else{
					echo '<td>'.zerogo($k).'</td>';
				}
				
				
			}else{
				echo '<td></td>';
			}
		}
		
		$bs = $load_data[$i]['b'];
		if($bs == 2){
			echo '<td class="bb">大</td>';
		}else if($bs == 1){
			echo '<td class="ss">小</td>';
		}else{
			echo '<td>';
			$has = 0;
			foreach($last_bs_p_arr as $p){
				if($load_data[$i]['p'] == $p){
					$has = 1;
				}
			}
			if($has){ echo ($last_bs_p_arr_count--); }
			
			echo '</td>';
		}
		
		echo '<td>'.$same.'</td>';
		
		echo '</tr>';
	}
?>
</table>

<br>
<table class="small_check">
<tr>
<?
	foreach(array('大小','Today','L5','L10','L15','L20','L25','L30','L35','L40','L45','L50','L75','L100','L125','L150') as $val){
		echo '<td>'.$val.'</td>';
	}
?>
</tr>
<?
	$list = array("Total","大","小","最久空局數","連２","連３","連４","連５","ＶＯＶＶＶ","ＶＯＶＶ","ＶＯＯＯＯＶ","ＶＯＯＯＶ","ＶＯＯＶ","ＶＯＶ","ＶＶＯＶ","大大","小小","大大大","小小小","大大大大","小小小小","大Ｏ大","小Ｏ小","大ＯＯ大","小ＯＯ小","大ＯＯＯ大","小ＯＯＯ小");
	
	for($s=0;$s<count($list);$s++){
		echo '<tr><td>'.$list[$s].'</td>';
		for($k=0;$k<15;$k++){
			$b_tp = @$bsarr_show[$k][$s];
			
			if($b_tp > 20){
				echo '<td class="f5">'.$b_tp.'</td>';
			}else if($b_tp > 15){
				echo '<td class="f4">'.$b_tp.'</td>';
			}else if($b_tp > 10){
				echo '<td class="f3">'.$b_tp.'</td>';
			}else if($b_tp > 5){
				echo '<td class="f2">'.$b_tp.'</td>';
			}else if($b_tp > 0){
				echo '<td class="f">'.$b_tp.'</td>';
			}else if($b_tp >= 0){
				echo '<td>'.$b_tp.'</td>';
			}
			
		}
		echo '</tr>';
	}
?>
</table>
<script src="js/u.js"></script>
</body>
</html>