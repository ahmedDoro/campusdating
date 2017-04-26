$(document).ready(function(){
	friends();
	photos();
	r_friends();
	friend_request();
	
	function friends(){
		$.ajax({
			url : "action.php",
			method: "POST",
			data : {friends:1},
			success : function(data){
				$("#get_friends").html(data);
			}
		})
	}
	
	function friend_request(){
		$.ajax({
			url : "action.php",
			method: "POST",
			data : {friend_request:1},
			success : function(data){
				$("#get_friend_request").html(data);
			}
		})
	}
	function r_friends(){
		$.ajax({
			url : "action.php",
			method: "POST",
			data : {r_friends:1},
			success : function(data){
				$("#get_r_friends").html(data);
			}
		})
	}
	
	function photos(){
		$.ajax({
			url : "action.php",
			method: "POST",
			data : {photos:1},
			success : function(data){
				$("#get_photo").html(data);
			}
		})
	}
	
	$("#search_btn").click(function(){
		var keyword1 = $("#gender").val();
		var keyword2 = $("#sex").val();
		var keyword  = $("#ethnicity").val();
	
		if(keyword != ""){
			$.ajax({ 
			url    : "action.php",
			method : "POST",
			data   :  {search:1, keyword:keyword, keyword1:keyword1, keyword2:keyword2},
			success : function(data){
				$("#get_result").html(data);
			}
		
		})
		}
	})
		
	
})