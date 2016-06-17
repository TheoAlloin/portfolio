jQuery(window).ready(function(){
	
	$('.delete').click(function(){
		id = $( this ).attr( 'id' );
		console.log(id);
		jQuery.post(
		    ajaxurl,
		    {
		        'action': 'deleteSkill',
		        'id': id,
		    },
		    function(response){
		            console.log(response);
		    }
		);

	});

	$('#skills td').blur(function(){
		console.log('blur');

		/*
		editableObj = valeur de l'objet modifier
		coloum = quel champ est changé (title, description..)
		id = id de la ligne changé
		*/
		value = $( this ).html();
		id = $( this ).attr('id');
		colomn = $( this ).attr('class');
		
		console.log(value);
		console.log(id);
		console.log(colomn);
		//ca marche

		jQuery.post(
		    ajaxurl,
		    {
		        'action': 'updateSkill',
		        'id': id,
		        'value': value,
		        'colomn': colomn,
		    },
		    function(response){
		            console.log(response);
		    }
		);
		
	});
	
	$('#timeline td').blur(function(){
		console.log('blur');

		/*
		editableObj = valeur de l'objet modifier
		coloum = quel champ est changé (title, description..)
		id = id de la ligne changé
		*/
		value = $( this ).html();
		id = $( this ).attr('id');
		colomn = $( this ).attr('class');
		
		console.log(value);
		console.log(id);
		console.log(colomn);
		//ca marche

		jQuery.post(
		    ajaxurl,
		    {
		        'action': 'updateTimeline',
		        'id': id,
		        'value': value,
		        'colomn': colomn,
		    },
		    function(response){
		            console.log(response);
		    }
		);
		
	});
	
	/*$('.delete').click(function(){
		id = $( this ).attr( 'id' );
		console.log(id);
		jQuery.post(
		    ajaxurl,
		    {
		        'action': 'deleteSkill',
		        'id': id,
		    },
		    function(response){
		            console.log(response);
		    }
		);

	});*/


});