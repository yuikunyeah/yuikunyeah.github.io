function menu() {
 const clicked = 0;	
 const rightEd = 0;
	$('#btn-gnavi').on('click', function(){
	if(clicked==0){
	clicked = 1;
	rightEd = 300;	
	}else{
	clicked = 0;
	rightEd = -300;	
	}
	
	$("#global-navi").stop().animate({
	right: rightEd
	}, 200);
	});
}
