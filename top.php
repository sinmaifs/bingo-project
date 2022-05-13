<?
	include_once("go.php");
	
	$load_data = array();
	if ($stmt = mysqli_prepare($link, "SELECT `period`, `ptime`, `op`, `bigsmal` FROM `today` ORDER BY `period` DESC")){
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$period,$ptime,$op,$bigsmal);
		while($stmt->fetch()){
			array_push($load_data,array('p'=>$period,'t'=>$ptime,'o'=>$op,'b'=>$bigsmal));
		}
		mysqli_stmt_close($stmt);
	}
	
	
	$sim_data = array();
	if ($stmt = mysqli_prepare($link, "SELECT `period`, `ino` FROM `simulate` ORDER BY `id` DESC")){
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$period,$ino);
		while($stmt->fetch()){
			array_push($sim_data,array('p'=>$period,'i'=>$ino));
		}
		mysqli_stmt_close($stmt);
	}
?>