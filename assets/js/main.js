(function($){

   load_cart();
   $('.addpanier').submit(function(event){
      var form_data  = $(this).serialize();
      var button_content = $(this).find('input[type=submit]'); 
      
      $.ajax({
         url: "pages/pan.php",
         type: "POST",
         dataType: "json",
         data: form_data ,
         success : function(data){
            if(data.error){
                 alert('error');
            }else{
               $('#count').empty().append(data.count);
               $('#count1').empty().append(data.count);
               load_cart();
               $('#sous-total').empty().append(data.sous_total);
               $('#total').empty().append(data.total);
               $('.close').trigger("click");
               
              swal({
                 title : data.message,
                 icon : "success",
                 button : "Ok"
               });
            }
         },
      });
      event.preventDefault();
   });
   $('.pan_info').click(function(e){
         var total = $('#total').attr("data-total");
         var vide = $('#vide').attr("data-vide");
         if(total<700){
            e.preventDefault();
            swal({
         
            title :  "Montant minimal 700 Fr !",
            text : "Continuer à ajouter des produits au panier.",
            icon : "error",
            button : "Annuler"
          });
         }else if(vide == "vide"){
            e.preventDefault();
            $('.close').trigger("click");
            swal({
            title : "Oops Panier vide !",
            text : "Svp ! ajouter au moins un produit au panier.",
            icon : "error",
            button : "Annuler"
          });
         }
   });

   $(document).on('click','.delpanier',function(e){
     e.preventDefault();
     var id = $(this).attr("data-id");
     $(this).parent().fadeOut();
     $.get($(this).attr('href'),{},function(data){
        if(data.error){
           
        }else{
           $('#count').empty().append(data.count);
           $('#count1').empty().append(data.count);
           load_cart();
           $('#sous-total').empty().append(data.sous_total);
           $('#total').empty().append(data.total);
           swal({ title : data.message,
                  icon  : "success",
                  button: "ok"
               });
           $('#ligne-'+id).fadeOut();      
           
        }
     },'json');
   });

function load_cart(){
$.ajax({
   url:"../pages/load_cart.php",
   type: "POST",
   dataType:"json",
   success : function(data){
      $('#cart_item').html(data.cart_item);
   }
});
}
})(jQuery);