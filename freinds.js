$(document).ready(function(){
	
	friends();
	
	function friends(){
		$.ajax({
			url : "freinds_action.php",
			method: "POST",
			data : {friends:1},
			success : function(data){
				$("#friends").html(data);
			}
		})
	}
	friend_request();
	function friend_request(){
		$.ajax({
			url : "freinds_action.php",
			method: "POST",
			data : {friend_request:1},
			success : function(data){
				$("#friend_request").html(data);
			}
		})
	}
	
	
	
})