<?
	include_once("go.php");
	include_once("bs_new.php");

	$load_data = array();
	if ($stmt = mysqli_prepare($link, "SELECT `period`, `ptime`, `op`, `bigsmal` FROM `today` ORDER BY `period` ASC")){
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$period,$ptime,$op,$bigsmal);
		while($stmt->fetch()){
			array_push($load_data,array('p'=>$period,'t'=>$ptime,'o'=>$op,'b'=>$bigsmal));
		}
		mysqli_stmt_close($stmt);
	}

	$Tool = new BS;

	$Tool->in_data = $load_data;

	$Tool -> Action();

	print_r($Tool->jump_open());
	//print_r($Tool->get_Longest_no_open());
	//print_r($Tool->get_continuous_(2));
?>