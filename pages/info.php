<?php 
$title ="Information sur la commande";

?>
 <?php    
     if(empty($_SESSION['panier'])){
      
        echo ' <div id="reservation" class="reservations-main pad-top-100 pad-bottom-100" style="margin-top:8%;">
        <div class="container">
            <div class="row">
                <div class="form-reservations-box">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s" style="border:6px solid #e75b1e ;border-radius:12px;">
                            <h2 class="block-title text-center">Panier vide</h2>
                        </div>
        <div class="col-md-12" style="text-align:center;align-items:center;">
        <img src="../assets/images/bag.png" height="150" width="150" style="margin-top:20px;opacity:0.5;">
        <p class="block-title" style="font-weight:700; font-size:14px;color:red;"> Parcourez notre menu et ajouter des elements à votre commande</p>
        </div> 
        </div>
        </div>
        </div>
        </div>';
        
    }else{
        $total= 0 ;
        foreach($_SESSION['panier'] as $key=>$product) { 
          $total += $product['item_qte']* $product['item_price'];    
        }
          ?>
    <div id="reservation" class="reservations-main pad-top-100 pad-bottom-100" style="margin-top:8%;">
        <div class="container">
            <div class="row">
                <div class="form-reservations-box">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s" style="border:6px solid #e75b1e ;border-radius:12px;">
                            <h2 class="block-title text-center">Information sur la commande</h2>
                        </div>
                      
                        <div style="text-align:center;margin-top:42px;">
                            <span class="step">Contact</span>
                            <span class="step">Livraison</span>
                            <span class="step">Paiement</span>
                            <span class="step">Confirmation</span>
                        </div>

                      <form id="regForm" method="post" class="reservations-box" name="contactform" action="<?=$router->generate('merci');?>" >
                        <div class="tab row">
                            <h2 class="block-title" style="font-size:27px; border:3px solid #e75b1e;text-align:center;border-radius:12px;padding:4px;margin-bottom:41px;">Information personnelle</h2>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-box">
                                    <label for="last-name" style="color:#e75b1e;font-weight:900;">Nom</label>
                                        <input type="text" name="name" id="form_name" placeholder="Nom du client" required="required" data-error="Firstname is required." style="border:2px dotted #e75b1e">
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-box">
                                    <label for="last-name" style="color:#e75b1e;font-weight:900;">Prenom</label>
                                        <input type="text" name="prenom" id="email" placeholder="Prenom du client" required="required" data-error="E-mail id is required." style="border:2px dotted #e75b1e">
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-box">
                                    <label for="last-name" style="color:#e75b1e;font-weight:900;">Numero de telephone</label>
                                        <input type="text" name="phone" id="phone" placeholder="numero du cient" style="border:2px dotted #e75b1e">
                                    </div>
                                </div>      
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-box">
                                    <label for="last-name" style="color:#e75b1e;font-weight:900;">Adresse</label>
                                        <input type="text" name="addresse" id="phone" placeholder="Adresse du client" style="border:2px dotted #e75b1e">
                                    </div>
                                </div>
                          </div>

                            <div class="tab row">
                               <h2 class="block-title" style="font-size:27px; border:3px solid #e75b1e;text-align:center;border-radius:12px;padding:4px;margin-bottom:41px;">
                               <img src="assets/images/livre.png" width="100">Option de livraison <img src="assets/images/livre.png" width="100" style="opacity:0.8"> <img src="assets/images/livre.png" width="100" style="opacity:0.4"></h2>
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-box">
                                    <label for="last-name" style="color:#e75b1e;font-weight:900;">Où souhaitez-vous être livré</label>
                                        <input type="text" name="livraison" id="phone" placeholder="Adresse de livraison" style="border:2px dotted #e75b1e">
                                    </div>
                                </div> 
                                    <div class="form-box col-md-6">
                                    <label for="last-name" class="block-title" style="font-size:15px;">Date de livraison</label>
                                        <input type="text" name="date" id="date-picker" style="border:2px dotted #e75b1e" placeholder="Date" required="required" data-error="Date is required." />
                                    </div>
                                    <div class="form-box col-md-6">
                                    <label for="last-name" class="block-title" style="font-size:15px;">Temps de livraison</label>
                                        <input type="text" disabled value="Vous serez livrez 20 mininutes après" style="border:2px dotted #e75b1e"  required="required" data-error="Time is required." />
                                    </div>
                              
                            </div>

                              <div class="tab">
                              <h2 class="block-title" style="font-size:27px; border:3px solid #e75b1e;text-align:center;border-radius:12px;padding:4px;margin-bottom:41px;">Paiement</h2>
                              <h5 style="font-size:14px;font-weight:800;color:#f9b026;">Vous pouvez à partir des numéros moblie money suivants: </h5>
                              <div class="table-responsive">
                              
            <table class="table">
              
              <tbody>
                <tr>
                  <th scope="row" class="border-0">
                    <div class="p-2">
                       <div class="ml-3 d-inline-block align-middle">
                        <h2 class="mb-0" style="font-size:15px;font-weight:900">Total</h2>
                      </div>
                    </div>
                  </th>
                  <td class="border-0 align-middle"><strong></strong></td>
                  <td class="border-0 align-middle"><strong style="font-size:17px;font-weight:900"><?= number_format($total+ 200,0,',',' ')  ;?> CFA</strong></td>
                 
                </tr>
                
                <tr>
                    
                  <th scope="row" class="border-0">
                    <div class="p-2">
                       <div class="ml-3 d-inline-block align-middle">
                        <h2 class="mb-0" style="font-size:15px;font-weight:900">Espèces </h2>
                      </div>
                    </div>
                  </th>
                  <td class="border-0 align-middle"><strong></strong></td>
                  <td class="border-0 align-middle"><strong style="font-size:17px;font-weight:900"><?= number_format($total+ 200,0,',',' ')  ;?>CFA</strong></td>
                 
                </tr>
              </tbody>
            </table>
          </div>
                                
                              </div>
                              <div class="tab">
                              <h2 class="block-title" style="font-size:27px; border:3px solid #e75b1e;text-align:center;border-radius:12px;padding:4px;margin-bottom:41px;">Ma commande(<?= count($_SESSION['panier'])?>)</h2>
                             
                              <div class="table-responsive">
                                <table class="table">
                                  <thead style="background:#e75b1e;">
                                    <tr style="color:#fff;">
                                      <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Produits</div>
                                      </th>
                                      <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Prix</div>
                                      </th>
                                      <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Sous-Total</div>
                                      </th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php $total2 = 0 ;
                                  foreach($_SESSION['panier'] as $key=>$panier) :?>
                                    <tr>
                                      <th scope="row" class="border-0">
                                      <div class="col-md-6">
                                                                        <ul style="text-align:left;">  
                                                                        
                                                                        <?php  if(!empty($panier['item_detail'])){
                                                                            echo '<li style="font-size:10px;">Composé de:</li>';
                                                                           
                                                                            foreach($panier['item_detail'] as $key=>$value){ 
                                                                                
                                                                        ?>      
                                                                            <li style="list-style:circle;font-size:10px;text-decoration:underline;"><?= $value?></li>   
                                                                        <?php }
                                                                                }?>
                                                                        </ul>
                                                                        </div>
                                        <div class="p-2">
                                        <img src="../Dashboard/upload/food/<?= $panier['item_img'] ;?>" alt="" width="90" class="img-fluid rounded shadow-sm">
                                          <div class="ml-3 d-inline-block align-middle">
                                            <h5 class="mb-0" style="font-weight:900;"><?= $panier['item_name'] ;?></h5>
                                          </div>
                                        </div>
                                      </th>
                                      <td class="align-middle"><strong><?=  $panier['item_qte'] ;?> x <?= number_format($panier['item_price'],0,',',' ') ;?> CFA</strong></td>
                                      <td class="align-middle"><strong><?= number_format($panier['item_price']* $panier['item_qte'],0,',',' ') ;?> CFA</strong></td>
                                    
                                    </tr>

                                    <?php $total2 += $panier['item_qte']* $panier['item_price']; ?>
                                    <?php endforeach ;?>
                                    <tr style="background:#e75b1e;color:#fff;">
                                        
                                      <th scope="row" class="border-0">
                                        <div class="p-2">
                                          <div class="ml-3 d-inline-block align-middle">
                                            <h2 class="mb-0" style="font-size:15px;font-weight:900;color:#fff;">Total + frais de livraison: </h2>
                                          </div>
                                        </div>
                                      </th>
                                      <td class="border-0 align-middle"><strong></strong></td>
                                      <td class="border-0 align-middle"><strong style="font-size:17px;font-weight:900"><?= number_format($total2 + 200,0,',',' ')  ;?>CFA</strong></td>
                                    
                                    </tr>
                                    
                                  </tbody>
                                </table>
                              </div>
                              </div>

                              <div style="overflow:auto;">
                              <div class="reserve-book-btn text-center" >
                                  <button type="button" style="float:left;border-radius:8px;"  class="hvr-underline-from-center" id="prevBtn" onclick="nextPrev(-1)">Précédent</button>
                                  <button type="button" style="float:right;border-radius:8px;" class="hvr-underline-from-center" id="nextBtn" onclick="nextPrev(1)">Suivant</button>
                                </div>
                              </div>
                            <!-- end col -->
                      </form>
                        <!-- end form -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end reservations-box -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
        <?php } ?>

    <a href="#" class="scrollup" style="display: none;">Scroll</a>
    
<script>
              var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
          // This function will display the specified tab of the form ...
          var x = document.getElementsByClassName("tab");
          x[n].style.display = "block";
          // ... and fix the Previous/Next buttons:
          if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
          } else {
            document.getElementById("prevBtn").style.display = "inline";
          }
          if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Confirmer";
          } else {
            document.getElementById("nextBtn").innerHTML = "Suivant";
          }
          // ... and run a function that displays the correct step indicator:
          fixStepIndicator(n)
        }

        function nextPrev(n) {
          // This function will figure out which tab to display
          var x = document.getElementsByClassName("tab");
          // Exit the function if any field in the current tab is invalid:
          if (n == 1 && !validateForm()) return false;
          // Hide the current tab:
          x[currentTab].style.display = "none";
          // Increase or decrease the current tab by 1:
          currentTab = currentTab + n;
          // if you have reached the end of the form... :
          if (currentTab >= x.length) {
            //...the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
          }
          // Otherwise, display the correct tab:
          showTab(currentTab);
        }

        function validateForm() {
          // This function deals with validation of the form fields
          var x, y, i, valid = true;
          x = document.getElementsByClassName("tab");
          y = x[currentTab].getElementsByTagName("input");
          // A loop that checks every input field in the current tab:
          for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
          // If the valid status is true, mark the step as finished and valid:
          if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
          }
          return valid; // return the valid status
        }

        function fixStepIndicator(n) {
          // This function removes the "active" class of all steps...
          var i, x = document.getElementsByClassName("step");
          for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
          }
          //... and adds the "active" class to the current step:
          x[n].className += " active";
        }
    
</script>
