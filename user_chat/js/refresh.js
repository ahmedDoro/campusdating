$.ajaxSetup ({
	cache: false	
});
$(setInterval(function(){
	$('.refresh').load('view.php'); 
	$('.refresh').attr({ scrollTop: $('.refresh').attr('scrollHeight') }) 	
}, 3000));