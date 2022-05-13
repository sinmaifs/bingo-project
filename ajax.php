<?
	include_once("go.php");
	
	if($_GET['c'] == 'up'){
		if ($stmt = mysqli_prepare($link, "SELECT `period` FROM `today` ORDER BY `period` DESC limit 1")){
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$new_period);
			while($stmt->fetch()){
				echo $new_period;
			}
			mysqli_stmt_close($stmt);
		}
	}
	if($_GET['c'] == 'getdata'){
		$p = @$_GET['p'];
		if($p){
			if ($stmt = mysqli_prepare($link, "SELECT `ptime`, `op`, `bigsmal` FROM `today` WHERE `period` = '$p' ")){
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt,$ptime,$op,$bigsmal);
				while($stmt->fetch()){
					if($bigsmal == 2){ $bigsmal = '大'; }elseif($bigsmal == 1){ $bigsmal = '小'; }else{ $bigsmal = '0'; }
					echo json_encode(array('n'=>1,'p'=>$p,'t'=>$ptime,'o'=>explode(',',$op),'b'=>$bigsmal));
				}
				mysqli_stmt_close($stmt);
			}
			if(!@$ptime){
				echo json_encode(array('n'=>'N'));
			}
		}
	}
	
	if($_GET['c'] == 'rank_66'){
		
		$load_data = array();
		if ($stmt = mysqli_prepare($link, "SELECT `op` FROM `today` ORDER BY `period` DESC")){
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$op);
			while($stmt->fetch()){
				array_push($load_data,array('o'=>$op));
			}
			mysqli_stmt_close($stmt);
		}
		
		$p = @$_GET['p'];
		if($p){
			echo json_encode(get_count($load_data,$p));
		}
	}
	
	
	if($_GET['c'] == 'sim_save'){
		$d = @$_GET['d'];
		$p = explode(',',$d)[6];
		
		$i = str_replace(','.$p,'',$d);
		
		if ($stmt = mysqli_prepare($link, "INSERT INTO `simulate`(`period`, `ino`) VALUES ('$p','$i');")){
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
	}
	
	
	if($_GET['c'] == 'del_any_one'){
		
		$n = $_GET["trid"];
		
		if ($stmt = mysqli_prepare($link, "SELECT `id` FROM `simulate` ORDER BY `id` DESC limit $n")){
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$del_id);
			while($stmt->fetch()){
				
			}
			mysqli_stmt_close($stmt);
		}
		
		
		if ($stmt = mysqli_prepare($link, "DELETE FROM `simulate` WHERE `id` = '$del_id' ")){
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		
		echo 1;
	}
?>