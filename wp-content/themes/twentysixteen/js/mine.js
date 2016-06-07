( function( $ ) {

	setInterval(function(){
         $(".banniere").animate({marginLeft:-350},800,function(){
            $(this).css({marginLeft:0}).find("li:last").after($(this).find("li:first"));
         })
      }, 3500);

} )( jQuery );

AdapterDivAResolution();

function AdapterDivAResolution() {
	var y_res = screen.height;
	var banniere = 200;
	var content_one = 450;
	var new_content = y_res - banniere/*2*/;

	//if(y_res > 450){
		document.getElementById('content-one').style.height = new_content +'px';
	//}
}