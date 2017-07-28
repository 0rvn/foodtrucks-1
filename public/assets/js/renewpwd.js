"use strict";
// alert( typeof "Hello" );
// alert( typeof "42" );
// alert( typeof 42 );
// alert( typeof true );
// alert( typeof false );
// alert( typeof null );
// alert( typeof toggleViewPwd );
// alert( typeof test );
// var test = undefined;
// alert( typeof test2 == "undefined" );
// console.log( window );


$(document).ready(function(){

  // Afficher / Masquer le mot de passe
  $('.input-group-addon').click(function(){
    toggleViewPwd( $(this) );
  });

  // Envoi du formulaire
  $('#btn-send').click(function(){
    sendRenewPwdRequest();
  });

});

function toggleViewPwd(element) {
    var field = $('#'+element.data('toggleView'));

    if (field.attr('type') == "password") {
      field.attr('type','text');
    } else {
      field.attr('type','password');
    }

    element.find('i')
      .toggleClass('glyphicon-eye-open')
      .toggleClass('glyphicon-eye-close');
}

function sendRenewPwdRequest() {

  // Suppression des messages d'erreur
  $('.text-danger').remove();

  var send = true;

  // Recupération des données du formulaire
  // Méthode 1
  var pwd_old = $('#pwd_old').val();
  var pwd_new = $('#pwd_new').val();
  var pwd_repeat = $('#pwd_repeat').val();

  // var values = {
  //   "pwd_old" : pwd_old,
  //   "pwd_new" : pwd_new,
  //   "pwd_repeat" : pwd_repeat
  // };
  //
  // console.log(values);
  // console.log(pwd_old, pwd_new, pwd_repeat);

  // Méthode 2
  var values = $('form').serializeArray();
  console.log( values );

  // Contrôle du formulaire
  // - Contrôle du mot de passe actuel
  // --
  // -> le mot de passe ne doit pas être vide
  if (pwd_old.length <= 0) {
    send = false;
    $('#pwd_old').before('<div class="text-danger">Le champ ne doit pas être vide</div>');
  }

  // - Contrôle du nouveau mot de passe
  // --
  // -> doit contenir au moins 8 caractères
  if (pwd_new.length < 8) {
    send = false;
    $('#pwd_new').before('<div class="text-danger">Le mot de passe doit avoir au moins 8 caractères.</div>');
  }
  // -> doit contenir au plus 16 caractères
  else if (pwd_new.length > 16) {
    send = false;
    $('#pwd_new').before('<div class="text-danger">Le mot de passe doit avoir 16 caractères maximum.</div>');
  }
  // -> doit avoir au moins un caractère de type numérique
  else if ( !/\d/.test(pwd_new) ) {
    send = false;
    $('#pwd_new').before('<div class="text-danger">Le mot de passe doit avoir au moins un caractère numérique.</div>');
  }
  // -> doit avoir au moins un caractère en majuscule
  else if ( !/[A-Z]/.test(pwd_new) ) {
    send = false;
    $('#pwd_new').before('<div class="text-danger">Le mot de passe doit contenir une majuscule.</div>');
  }
  // -> doit avoir au moins un caractère spécial (#@!=+-_)
  else if ( !/(#|@|0|!|=|\+|-|_)/.test(pwd_new)) {
    send = false;
    $('#pwd_new').before('<div class="text-danger">Le mot de passe doit contenir un caractère spécial (#@!=+-_).</div>');
  }

  // - Contrôle de la répétition du nouveau mot de passe
  // --
  // -> Les mots de passe doivent être identique
  if (pwd_new != pwd_repeat) {
    send = false;
    $('#pwd_repeat').before('<div class="text-danger">Les mots de passe ne correspondent pas.</div>');
  }

  if (send) {
    $.post(
      'ajax.php',
      $('form').serializeArray(),
      function(response) {
        //console.log(response); 
        //on fait un console.log ici en phase de dév' pour savoir ce qui est attendu (en l'occurence, un objet ici, 
        //donc dans le fichier ajax.php, on devra encoder en json qui est un objet).
        alert(response.message);
      }
    );
  }
}