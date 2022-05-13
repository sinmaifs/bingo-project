<?
	include_once("config.php");

	$link = mysqli_connect($host,$dbuser,$dbpass, $dbname);
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
	mysqli_set_charset($link, "utf8");
	header("Content-Type:text/html; charset=utf-8");
	date_default_timezone_set('Asia/Taipei');
	


	function zerogo($n){
		return str_pad($n,2,"0",STR_PAD_LEFT);
	}
	
	function get_count($d,$s){
		
		$find = 0;
		if($s == "all"){
			$find = count($d);
		}else{
			$find = $s;
		}
		
		$p = '';
		for($i=0;$i<$find;$i++){
			$p .= $d[$i]["o"].",";
		}
		$count_arr_all = array();
		foreach(explode(',',$p) as $val){
			array_push($count_arr_all,(int)$val);
		}
		
		$caa = array_count_values($count_arr_all);
		
		$best_arr = array();
		
		for($i=1;$i<=80;$i++){
			$best = 0;
			$best_key = 0;
			foreach($caa as $key=>$val){
				if($val > $best){
					$best = $val;
					$best_key = $key;
				}
			}
			array_push($best_arr,"$best_key#$best");
			unset($caa[$best_key]);
		}
		
		$ret = array();
		
		for($i=0;$i<6;$i++){
			array_push($ret,$best_arr[$i]);
		}
		for($i=79;$i>=74;$i--){
			array_push($ret,$best_arr[$i]);
		}
		
		return $ret;
	}

	function go_curl($url){
		$ch = curl_init();
		curl_setopt($ch , CURLOPT_URL , $url);
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36");
		$r = curl_exec($ch);
		curl_close($ch);

		return $r;
	}
?>