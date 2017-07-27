"use strict"; // pour avoir un code propre qui ne laisse passer aucune erreur

$(document).ready(function(){

	// Afficher / Masquer le mot de passe
	$('.input-group-addon').click(function(){
		toggleViewPwd( $(this).data('toggleView') );
		$(this).find('i')
      	.toggleClass('glyphicon-eye-open')
  		.toggleClass('glyphicon-eye-close');
	});
	// Envoi du formulaire

});

function toggleViewPwd(fieldId) {
	var field = $('#'+fieldId);
	if (field.attr('type') == "password") {
		field.attr('type','text');
	} else {
		field.attr('type','password');
	}
}
