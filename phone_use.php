<?	include_once("top.php");?><!DOCTYPE html><html lang="zh-hant"><head><meta charset="UTF-8" /><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="viewport" content="width=device-width, initial-scale=1" /><meta name="format-detection" content="telephone=no" /><title>BingoBingo Analytics</title><script src="//code.jquery.com/jquery-3.6.0.min.js"></script><link rel="icon" href="ajax.png"><link href="css/style.css?v=<? rand(111111,666666) ?>" rel="stylesheet" /></head><body class="ph"><div class="toptime ph_f"><div>410</div><div>411</div><div class="cp">412</div><div>413</div><div>414</div></div><div id="c_n" class="toptime cc2"></div><div class="phone_btn_80"><?	for($i=1;$i<81;$i++){		echo '<div>'.$i.'</div>';	}?></div><div style="height:80px;"></div><script>$(".phone_btn_80 div").click(function() {if($(this).hasClass("fc")){	$(this).removeClass("fc");}else{	$(this).addClass("fc");}c_all();});$(".ph_f div").click(function() {if($(this).hasClass("cp")){	$(".ph_f div").removeClass("cp");}else{	$(".ph_f div").removeClass("cp");	$(this).addClass("cp");}});function c_all(){	var t = '';	for(i=0;i<$(".fc").length;i++){		t += $(".fc").eq(i).html() + '/';	}	$("#c_n").html(t);}</script></body></html>