$(document).ready(function() {
setTimeout(GoCheck, 1000);
rank66();
upd();
any();
sim_this_res();
});

$("#close_rab").click(function() {
	if($("#rank_any_before").is(':visible')){
		$("#close_rab").html("S");
		$(this).removeClass("cr_sim2");
		$(this).addClass("cr_sim");
	}else{
		$("#close_rab").html("X");
		$(this).removeClass("cr_sim");
		$(this).addClass("cr_sim2");
	}
	$("#rank_any_before").toggle(200);
});

function GoCheck(){
	
	var d = new Date();
	var h = addZero(d.getHours());
	var m = addZero(d.getMinutes());
	var s = addZero(d.getSeconds());
	
	$("#tt").text(h+":"+m+":"+s);
	$("#kk").text($("#list_all tr").length - 1);
	
	var azgo = false;
	
	var hh_n = Number($("#final_t").val().split(':')[0]);
	var mm_n = Number($("#final_t").val().split(':')[1]) + 5;
	
	if(mm_n >= 60){
		mm_n = 0;
		hh_n++;
	}
	
	if((hh_n > 23) || ((hh_n >= 0) && (hh_n < 7))){
		
	}else{
		if(d.getHours() > hh_n){
			if((d.getSeconds() % 20) == 0){
				azgo = true;
			}
		}else{
			if(d.getHours() == hh_n){
				if(d.getMinutes() > mm_n){
					if((d.getSeconds() % 20) == 0){
						azgo = true;
					}
				}
			}
		}
	}
	
	if(azgo){
		$.ajax({
			type: "GET",
			url: "update.php",
			dataType: "text",
			success:function (msg){ console.log(msg); }
		});
	}else{
		$.ajax({
			type: "GET",
			url: "ajax.php?c=up",
			dataType: "text",
			success:function (msg){
				var t = $("#list_all tbody tr");
				if((Number(t.eq(1).children("td").eq(0).children(".hide_p").html()) - Number(t.eq(2).children("td").eq(0).children(".hide_p").html())) > 1){
					window.location.reload();
				}else{
					if(msg){
						if(msg != $("#final_p").val()){
							$("#final_p").val(msg);
							setTimeout(upup, 500);
						}
					}
				}
			}
		});
	}
	setTimeout(GoCheck, 1000);
}
//更新號碼出現排序
function rank66(chs){
	
	if(!chs){ chs = 'all'; }
	
	$("#rank_66 div.left > *").html("0<span>0</span>");
	$("#rank_66 div.right > *").html("0<span>0</span>");
	
	var kk = Number($("#list_all tr").length - 1);
	var bt_rank = "<button onclick='rank66()'>ALL</button>";
	if(kk > 6){
		var hh = parseInt(kk / 6);
		for(i=1;i<=6;i++){
			bt_rank += "<button onclick='rank66(" + (hh * i) + ")'>" + (hh * i) + "</button>";
		}
	}
	$("#bt_rank").html(bt_rank);
	
	$.ajax({
		type: "GET",
		url: "ajax.php?c=rank_66&p="+chs,
		dataType: "json",
		beforeSend: function(){
			ajax_sh(1);
			$(".ch_p").hide();
			$(".ch_ajax").show();
		},
		complete: function(){
			ajax_sh(2);
			$(".ch_p").show();
			$(".ch_ajax").hide();
		},
		success:function (msg){
			var e = 0,w = 0;
			msg.forEach(function(n){
				var t = n.split('#');
				if(e < 6){
					$("#rank_66 .left p").eq(e).html(addZero(t[0]) + "<span>" + addZero(t[1]) + "</span>");
				}else{
					$("#rank_66 .right p").eq(w).html(addZero(t[0]) + "<span>" + addZero(t[1]) + "</span>");
					w++;
				}
				e++;
			});
		}
	});
}
//1 更新中 2 自動更新
function ajax_sh(s){
	if(s == 1){
		$("#aj").html('<img src="img/ajax.gif" />更新中');
	}else if(s == 2){
		setTimeout(function(){
			$("#aj").html('<img src="img/ajax.png" />自動更新');
		}, 500);
	}
}
//更新最新局數據
function upup(){
	$.ajax({
		type: "GET",
		url: "ajax.php?c=getdata&p="+$("#final_p").val(),
		dataType: "json",
		beforeSend: function(){ ajax_sh(1); },
		complete: function(){ ajax_sh(2); },
		success:function (msg){
			if(msg.n != 'N'){

				var save_old_o = [];
				var list_bs = Number($("#list_all tbody tr").eq(1).children("td").eq(81).html());
				
				for(i=1;i<=80;i++){
					if(Number($("#list_all tbody tr").eq(1).children("td").eq(i).html()) == i){
						save_old_o.push(i);
					}
				}
				
				$("#rab_p").val(msg.p.substr(-3));
				
				var total_sa = 0;
				var addtr = "<tr><td>"+msg.p.substr(-3)+" "+msg.t+"<div class='hide_p'>"+msg.p+"</div></td>";
				
				for(i=1;i<=80;i++){
					var a = false;
					
					msg.o.forEach(function(n){
						if(i==Number(n)){
							a = true;
						}
					});
					
					if(a){
						var r = '';
						if($.inArray(i,save_old_o) >= 0){
							total_sa++;
							r = 'repeat';
						}
						addtr += "<td class='"+r+"'>"+addZero(i)+"</td>";
					}else{
						addtr += "<td> </td>";
					}
				}
				if(msg.b == 0){
					if(list_bs > 0){
						addtr += "<td>" + (list_bs + 1) + "</td>";
					}else{
						addtr += "<td>1</td>";
					}
				}else{
					var c = '';
					if(msg.b == '大'){ c = 'bb'; }else if(msg.b == '小'){ c = 'ss'; }
					addtr += "<td class='"+c+"'>"+msg.b+"</td>";
				}
				addtr += "<td>"+total_sa+"</td>";
				addtr += "</tr>";
				
				$("#list_all tbody > tr:nth-child(1)").after(addtr);
				
				$("#final_t").val(msg.t);
				upd();
				any();
				rank66();
				sim_this_res();
			}
		}
	});
}
//渲染未開局數
function any(){
	$(".s3").html('');
	$(".s3").removeClass();
	
	var tt = $("#list_all tbody tr");
	for(j=1;j<=80;j++){
		var t = 0;
		for(i=1;i<tt.length;i++){
			var this_tr = Number(tt.eq(0).children("td").eq(j).html());
			if(Number(tt.eq(i).children("td").eq(j).html()) == this_tr){
				if(i != 1){
					tt.eq(i-1).children("td").eq(j).html(t);
				}
				break;
			}
			t++;
			tt.eq(i).children("td").eq(j).addClass("s3");
		}
	}
}
//新增模擬筆數
function save_sim(){
	
	var p = $("#final_p").val();
	var s = '',t = '',g = 0;
	
	for(i=1;i<7;i++){
		var n = Number($("#sim input").eq(i).val());
		if(n){
			if((n > 0) && (n <= 80)){
				var l = $("#sim input").eq(i).val();
				s += l+",";
				t += "<td>"+l+"</td>";
				g++;
			}else{
				return false;
			}
		}else{
			s += ",";
			t += "<td></td>";
		}
	}
	
	if(!g){ return false; }else{ $("#ss").html("Wait"); }
	
	$("#rank_any_before table tbody > tr:nth-child(1)").after("<tr><td><span>"+p+"</span> 0</td>"+t+"<td></td></tr>");
	
	$.ajax({
		type: "GET",
		url: "ajax.php?c=sim_save&d="+s+p,
		dataType: "text",
		success:function (msg){
			setTimeout(function(){
				$("#ss").html("Submit");
				for(i=1;i<=6;i++){
					$("#sim input").eq(i).val('');
				}
			}, 300);
		}
	});
	sim_this_res();
}
//核對最新號碼
function sim_this_res(){
	var r = $("#rank_any_before tr");
	var np = $("#list_all tr").eq(1).children('td');
	for(i=1;i<r.length;i++){
		var h = 0;
		var n = 0;
		var l = r.eq(i).children('td');
		for(j=1;j<7;j++){
			var tn = Number(l.eq(j).html());
			if(tn > 0){
				for(k=1;k<81;k++){
					if((tn == Number(np.eq(k).html())) && (!np.eq(k).hasClass("s3"))){
						h++;
					}
				}
				n++;
			}
		}
		var this_p = l.eq(0).children('span').html();
		l.eq(0).html("<button onclick='del_any_one("+i+")'>X</button><span>" + this_p + "</span> " + ( Number(this_p) - Number($("#final_p").val()) ));
		l.eq(7).html(h + '/' + n);
	}
}
function addZero(i){
if (i < 10){i = "0" + i}
return i;
}
function upd(){
$('td').mouseenter(function(){$(this).children("div.hide_p").show();});
$('td').mouseleave(function(){$(this).children("div.hide_p").hide();});
}

function del_any_one(n){
	
	$.ajax({
		type: "GET",
		url: "ajax.php?c=del_any_one&trid="+n,
		dataType: "text",
		success:function (msg){
			
		}
	});
	
	$("#rank_any_before table tr").eq(n).remove();
	sim_this_res();
}
