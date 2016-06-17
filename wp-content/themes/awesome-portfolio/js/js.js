$(document).ready(function(){
 	/****************** SLIDER ************************/
      setInterval(function(){
         $(".slideshow ul").animate({marginLeft:-350},800,function(){
            $(this).css({marginLeft:0}).find("li:last").after($(this).find("li:first"));
         })
      }, 4500);
      
      /************************* Change text **************************/
      var contenu = ["à la recherche d'un emploi", "certifié", "spécialisé back-end", "diplômé"];
      var max = contenu.length;
      var i = 0;
      setInterval(function(){
      		$("#self-def").text( contenu[i] );    
      		if(i == max){
      			i = -1;
      		}
      		i++;	
      }, 4000);
      
});