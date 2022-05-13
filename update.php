<?
	include_once("go.php");

	$load = go_curl("https://lotto.auzonet.com/bingobingo/list_".$Any_date.".html");
	
	$e1 = explode("er\"><b>單雙</b></td>\n</tr>",$load);
	$e2 = explode("\n</table>",$e1[1]);
	$e3 = str_replace(array("\r","\n",'bbbp','bbn','brrps','brn','brbp','bbrp','bblp','brrp','brlp','Bf21b','bingo_row','BPeriod','<td align="center">','</div>','<td class="">','<br>','<tr class="">','<b>'),'',$e2[0]);
	$e4 = str_replace('"s"','""',$e3);
	$e5 = str_replace('<div class="">',',',$e4);
	$e6 = str_replace(array('</td>,','</b>','</td>'),'#',$e5);
	$e7 = str_replace('</tr>','S',$e6);

	$s1 = array_filter(explode('S',$e7));
	
	if ($stmt = mysqli_prepare($link, "TRUNCATE `today`")){
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	
	foreach($s1 as $val){
		if($val){
			$t = explode('#',$val);
			
			$period = $t[0];
			$ptime = $t[1];
			$op = $t[2];
			if($t[4] == '大'){
				$bigsmal = 2;
			}else if($t[4] == '小'){
				$bigsmal = 1;
			}else{
				$bigsmal = 0;
			}
			
			if ($stmt = mysqli_prepare($link, "INSERT INTO `today`(`period`, `ptime`, `op`, `bigsmal`) VALUES ('$period','$ptime','$op','$bigsmal')")){
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}
		}
	}
	echo '[successfu]';
?>