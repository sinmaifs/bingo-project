$(document).ready(function() {
	$("#p_this_a").val($("#list_all tbody tr").eq($("#list_all tbody tr").length - 1).children("td").eq(0).html());
	
	start_any();
});

function start_any(){
	
	var p_this_a = Number($("#p_this_a").val());
	var p_this_b = Number($("#p_this_b").val());
	
	any_go(p_this_a,p_this_b);
	
	p_this_b++;
	if(p_this_b == 7){
		p_this_b = 0;
		p_this_a++;
	}
	
	$("#p_this_a").val(p_this_a);
	$("#p_this_b").val(p_this_b);
	
	
	if(Number($("#list_all tbody tr").eq(1).children("td").eq(0)) < p_this_a){
		
	}else{
		setTimeout(start_any, 1);
	}
}

function any_go(p,e){
	var list_tb = $("#list_all tbody tr");
	var this_tr_l = 0;
	var go_to_s = 0;
	var top30_arr = [];
	
	//解析往上30tr
	for(i=0;i<list_tb.length;i++){
		if(list_tb.eq(i).children("td").eq(0).html() == p){
			this_tr_l = i;
			break;
		}
	}
	
	if((this_tr_l - 30) > 0){
		go_to_s = (this_tr_l - 30);
	}
	
	for(i=this_tr_l;i>go_to_s;i--){
		top30_arr.push(i);
	}
	
	var need_check = $("#list_all tbody tr").eq(this_tr_l).children("td").eq(e+23).children(".hide_val").html().split(",");
	var ttarr = [];
	top30_arr.forEach(function(n){
		var w = 0;
		need_check.forEach(function(s){
			for(k=1;k<21;k++){
				list_tb.eq(n).children("td").eq(k).addClass('k');
				if(list_tb.eq(n).children("td").eq(k).html() == Number(s)){
					list_tb.eq(n).children("td").eq(k).addClass('u');
					w++;
				}
			}
		});
		ttarr.push(w);
	});
	
	for(k=1;k<9;k++){
		$("#list_all tbody tr").eq(this_tr_l).children("td").eq(e+23).children("span").eq(k-1).html(ttarr.filter(function(v) { return v == k; }).length)
	}
}

$('table tbody td.tdany').mouseenter(function(){
	$(this).children(".hide_val").show();
	var p = $(this).parent("tr").children("td").eq(0).html();
	var e = Number($(this).children("#e6").val());
	any_go(p,e);
});
$('table tbody td.tdany').mouseleave(function(){
	$(this).children(".hide_val").hide();
	$("#list_all tbody tr td").removeClass("k");
	$("#list_all tbody tr td").removeClass("u");
});