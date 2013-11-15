var backgroundResizeFun=function(){
	$('#map_container').css({
		width:$(window).width()+'px',
		height:($(window).height() - 45)+'px'
	});
}

$(document).ready(function(){
	//console.log('hello');
	initialize('map');
	$('#map_search').click(function(){
		search($('#search').val());
	});
	$('#map_my_location').click(function(){
		geo();
	});
	
	backgroundResizeFun();
	$(window).resize(function(){
		backgroundResizeFun();
	});
});
