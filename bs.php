<?
	//大小分析
	$bsarr_show = array();
	
	//------------------------ 最後開大小
	$start_zero = 0;
	$last_bs_p = 0;
	$last_bs_p_arr = array();
	for($i=count($load_data)-1;$i>=0;$i--){
		if($load_data[$i]['b'] != 0){
			$last_bs_p = @$load_data[$i-1]['p'];
		}
	}
	for($i=count($load_data)-1;$i>=0;$i--){
		if($load_data[$i]['p'] == $last_bs_p){
			$start_zero = 1;
		}
		if($start_zero){
			array_push($last_bs_p_arr,$load_data[$i]['p']);
		}
	}
	
	$last_bs_p_arr_count = count($last_bs_p_arr);
	
	//------------------------
	$bsarr_a = array();
	
	for($i=0;$i<count($load_data);$i++){
		array_push($bsarr_a,$load_data[$i]['b']);
	}
	
	$bs_a_o = array_count_values($bsarr_a);
	
	$bsarr_show[0][0] = @$bs_a_o[2] + @$bs_a_o[1];
	$bsarr_show[0][1] = @$bs_a_o[2];
	$bsarr_show[0][2] = @$bs_a_o[1];
	
	//最久沒開
	$notopen = 0;
	$tmp_open = 0;
	
	$continuous2 = 0;
	$continuous3 = 0;
	$continuous4 = 0;
	$continuous5 = 0;
	
	$vovvv = 0;
	$vovv = 0;
	$voooov = 0;
	$vooov = 0;
	$voov = 0;
	$vov = 0;
	$vvov = 0;
	
	$c202  = 0;
	$c101  = 0;
	$c2002 = 0;
	$c1001 = 0;
	$c20002 = 0;
	$c10001 = 0;
	
	$continuous2222 = 0;
	$continuous1111 = 0;
	$continuous222 = 0;
	$continuous111 = 0;
	$continuous22 = 0;
	$continuous11 = 0;
	
	for($i=0;$i<count($bsarr_a);$i++){
				
		$m_0 = $bsarr_a[$i];
		$m_1 = @$bsarr_a[$i-1];
		$m_2 = @$bsarr_a[$i-2];
		$m_3 = @$bsarr_a[$i-3];
		$m_4 = @$bsarr_a[$i-4];
		$m_5 = @$bsarr_a[$i-5];
		
		//最久空局數
		if($m_0 != 0){
			if($notopen < $tmp_open){
				$notopen = $tmp_open;
			}
			$tmp_open = 0;
		}else{
			$tmp_open++;
		}
		
		//連2345
		if($m_0){
			if($m_1){
				$continuous2++;
				if($m_2){
					$continuous3++;
					if($m_3){
						$continuous4++;
						if($m_4){
							$continuous5++;
						}
					}
				}
			}
		}
		
		//vovvv
		if(($m_0 != 0) && ($m_1 == 0) && ($m_2 != 0) && ($m_3 != 0) && ($m_4 != 0)){ $vovvv++; }
		//vovv
		if(($m_0 != 0) && ($m_1 == 0) && ($m_2 != 0) && ($m_3 != 0)){ $vovv++; }
		//voooov
		if(($m_0 != 0) && ($m_1 == 0) && ($m_2 == 0) && ($m_3 == 0) && ($m_4 == 0) && ($m_5 != 0)){ $voooov++; }
		//vooov
		if(($m_0 != 0) && ($m_1 == 0) && ($m_2 == 0) && ($m_3 == 0) && ($m_4 != 0)){ $vooov++; }
		//voov
		if(($m_0 != 0) && ($m_1 == 0) && ($m_2 == 0) && ($m_3 != 0)){ $voov++; }
		//vov
		if(($m_0 != 0) && ($m_1 == 0) && ($m_2 != 0)){ $vov++; }
		//vvov
		if(($m_0 != 0) && ($m_1 != 0) && ($m_2 == 0) && ($m_3 != 0)){ $vvov++; }

		//202
		if(($m_0 == 2) && ($m_1 == 0) && ($m_2 == 2)){ $c202++; }
		//101
		if(($m_0 == 1) && ($m_1 == 0) && ($m_2 == 1)){ $c101++; }
		//2002
		if(($m_0 == 2) && ($m_1 == 0) && ($m_2 == 0) && ($m_3 == 2)){ $c2002++; }
		//1001
		if(($m_0 == 1) && ($m_1 == 0) && ($m_2 == 0) && ($m_3 == 1)){ $c1001++; }
		//20002
		if(($m_0 == 2) && ($m_1 == 0) && ($m_2 == 0) && ($m_3 == 0) && ($m_4 == 2)){ $c20002++; }
		//10001
		if(($m_0 == 1) && ($m_1 == 0) && ($m_2 == 0) && ($m_3 == 0) && ($m_4 == 1)){ $c10001++; }
		
		
		
		if(($m_0 == 2) && ($m_1 == 2)){
			$continuous22++;
			if($m_2 == 2){
				$continuous222++;
				if($m_3 == 2){
					$continuous2222++;
				}
			}
		}
		if(($m_0 == 1) && ($m_1 == 1)){
			$continuous11++;
			if($m_2 == 1){
				$continuous111++;
				if($m_3 == 1){
					$continuous1111++;
				}
			}
		}
	}
	
	$bsarr_show[0][3] = $notopen;
	$bsarr_show[0][4] = $continuous2;
	$bsarr_show[0][5] = $continuous3;
	$bsarr_show[0][6] = $continuous4;
	$bsarr_show[0][7] = $continuous5;
	
	$bsarr_show[0][8] =  $vovvv;
	$bsarr_show[0][9] =  $vovv;
	$bsarr_show[0][10] = $voooov;
	$bsarr_show[0][11] = $vooov;
	$bsarr_show[0][12] = $voov;
	$bsarr_show[0][13] = $vov;
	$bsarr_show[0][14] = $vvov;
	
	$bsarr_show[0][15] = $continuous22;
	$bsarr_show[0][16] = $continuous11;
	$bsarr_show[0][17] = $continuous222;
	$bsarr_show[0][18] = $continuous111;
	$bsarr_show[0][19] = $continuous2222;
	$bsarr_show[0][20] = $continuous1111;
	
	$bsarr_show[0][21] = $c202;
	$bsarr_show[0][22] = $c101;
	$bsarr_show[0][23] = $c2002;
	$bsarr_show[0][24] = $c1001;
	$bsarr_show[0][25] = $c20002;
	$bsarr_show[0][26] = $c10001;
	
	
	
	//------------------------
	$bsarr_b_L = array();
	
	$sum = 1;
	$tmparr = array();
	for($i=0;$i<151;$i++){
		array_push($tmparr,@$load_data[$i]['b']);
		
		if($sum == 5 ){ array_push($bsarr_b_L,$tmparr); }
		if($sum == 10){ array_push($bsarr_b_L,$tmparr); }
		if($sum == 15){ array_push($bsarr_b_L,$tmparr); }
		if($sum == 20){ array_push($bsarr_b_L,$tmparr); }
		if($sum == 25){ array_push($bsarr_b_L,$tmparr); }
		if($sum == 30){ array_push($bsarr_b_L,$tmparr); }
		if($sum == 35){ array_push($bsarr_b_L,$tmparr); }
		if($sum == 40){ array_push($bsarr_b_L,$tmparr); }
		if($sum == 45){ array_push($bsarr_b_L,$tmparr); }
		if($sum == 50){ array_push($bsarr_b_L,$tmparr); }
		if($sum == 75){ array_push($bsarr_b_L,$tmparr); }
		if($sum == 100){ array_push($bsarr_b_L,$tmparr); }
		if($sum == 125){ array_push($bsarr_b_L,$tmparr); }
		if($sum == 150){ array_push($bsarr_b_L,$tmparr); }
		
		$sum++;
	}
	
	for($c=0;$c<14;$c++){
		
		$total_1 = 0;
		$total_2 = 0;
		
		@$tmp_array_cv = array_count_values($bsarr_b_L[$c]);
		
		$total_1 = @$tmp_array_cv[1];
		$total_2 = @$tmp_array_cv[2];
		
		$bsarr_show[$c+1][0] = ($total_1 + $total_2);
		$bsarr_show[$c+1][1] = $total_2;
		$bsarr_show[$c+1][2] = $total_1;
		
		$continuous2 = 0;
		$continuous3 = 0;
		$continuous4 = 0;
		$continuous5 = 0;
		
		$vovvv = 0;
		$vovv = 0;
		$voooov = 0;
		$vooov = 0;
		$voov = 0;
		$vov = 0;
		$vvov = 0;
	
		$c202  = 0;
		$c101  = 0;
		$c2002 = 0;
		$c1001 = 0;
		$c20002 = 0;
		$c10001 = 0;
	
		$continuous2222 = 0;
		$continuous1111 = 0;
		$continuous222 = 0;
		$continuous111 = 0;
		$continuous22 = 0;
		$continuous11 = 0;
	
		for($f=0;$f<count(@$bsarr_b_L[$c]);$f++){
			
			$f_0 = @$bsarr_a[$f];
			$f_1 = @$bsarr_a[$f-1];
			$f_2 = @$bsarr_a[$f-2];
			$f_3 = @$bsarr_a[$f-3];
			$f_4 = @$bsarr_a[$f-4];
			$f_5 = @$bsarr_a[$f-5];
			
			//連2345
			if($f_0){
				if($f_1){
					$continuous2++;
					if($f_2){
						$continuous3++;
						if($f_3){
							$continuous4++;
							if($f_4){
								$continuous5++;
							}
						}
					}
				}
			}
			//vovvv
			if(($f_0 != 0) && ($f_1 == 0) && ($f_2 != 0) && ($f_3 != 0) && ($f_4 != 0)){ $vovvv++; }
			//vovv
			if(($f_0 != 0) && ($f_1 == 0) && ($f_2 != 0) && ($f_3 != 0)){ $vovv++; }
			//voooov
			if(($f_0 != 0) && ($f_1 == 0) && ($f_2 == 0) && ($f_3 == 0) && ($f_4 == 0) && ($f_5 != 0)){ $voooov++; }
			//vooov
			if(($f_0 != 0) && ($f_1 == 0) && ($f_2 == 0) && ($f_3 == 0) && ($f_4 != 0)){ $vooov++; }
			//voov
			if(($f_0 != 0) && ($f_1 == 0) && ($f_2 == 0) && ($f_3 != 0)){ $voov++; }
			//vov
			if(($f_0 != 0) && ($f_1 == 0) && ($f_2 != 0)){ $vov++; }
			//vvov
			if(($f_0 != 0) && ($f_1 != 0) && ($f_2 == 0) && ($f_3 != 0)){ $vvov++; }
		
			//202
			if(($f_0 == 2) && ($f_1 == 0) && ($f_2 == 2)){ $c202++; }
			//101
			if(($f_0 == 1) && ($f_1 == 0) && ($f_2 == 1)){ $c101++; }
			//2002
			if(($f_0 == 2) && ($f_1 == 0) && ($f_2 == 0) && ($f_3 == 2)){ $c2002++; }
			//1001
			if(($f_0 == 1) && ($f_1 == 0) && ($f_2 == 0) && ($f_3 == 1)){ $c1001++; }
			//20002
			if(($f_0 == 2) && ($f_1 == 0) && ($f_2 == 0) && ($f_3 == 0) && ($f_4 == 2)){ $c20002++; }
			//10001
			if(($f_0 == 1) && ($f_1 == 0) && ($f_2 == 0) && ($f_3 == 0) && ($f_4 == 1)){ $c10001++; }
		
			if(($f_0 == 2) && ($f_1 == 2)){
				$continuous22++;
				if($f_2 == 2){
					$continuous222++;
					if($f_3 == 2){
						$continuous2222++;
					}
				}
			}
			if(($f_0 == 1) && ($f_1 == 1)){
				$continuous11++;
				if($f_2 == 1){
					$continuous111++;
					if($f_3 == 1){
						$continuous1111++;
					}
				}
			}
		
			$bsarr_show[$c+1][4] = $continuous2;
			$bsarr_show[$c+1][5] = $continuous3;
			$bsarr_show[$c+1][6] = $continuous4;
			$bsarr_show[$c+1][7] = $continuous5;
			
			$bsarr_show[$c+1][8] =  $vovvv;
			$bsarr_show[$c+1][9] =  $vovv;
			$bsarr_show[$c+1][10] = $voooov;
			$bsarr_show[$c+1][11] = $vooov;
			$bsarr_show[$c+1][12] = $voov;
			$bsarr_show[$c+1][13] = $vov;
			$bsarr_show[$c+1][14] = $vvov;
			
			$bsarr_show[$c+1][15] = $continuous22;
			$bsarr_show[$c+1][16] = $continuous11;
			$bsarr_show[$c+1][17] = $continuous222;
			$bsarr_show[$c+1][18] = $continuous111;
			$bsarr_show[$c+1][19] = $continuous2222;
			$bsarr_show[$c+1][20] = $continuous1111;

			$bsarr_show[$c+1][21] = $c202;
			$bsarr_show[$c+1][22] = $c101;
			$bsarr_show[$c+1][23] = $c2002;
			$bsarr_show[$c+1][24] = $c1001;
			$bsarr_show[$c+1][25] = $c20002;
			$bsarr_show[$c+1][26] = $c10001;
	
		}
	}
	
	
	//------------------------
	
	
	
	
?>