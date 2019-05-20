$(document).ready(function(){

  $('#photo').on('change',function(e){
    $('#fichier').html( e.target.files[0].name );
  });

  $('.confirm').on('click',function(){
    return(confirm('Etes vous certain(e) de vouloir supprimer ce produit ?'));
  });

//tester l'existence d'éléments sur la page

if($('#maModale').length==1){$('#maModale').modal('show');}


}); // Fin du document ready
