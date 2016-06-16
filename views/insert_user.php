<?php
	include ("header.php");
	include ("front_header.php");
?>      
            <div class="row">
               <div class="col-lg-12 formulaire">
                   <div class="row">
                       <div class="col-lg-12">
                          <p class="ajout">Ajouter un utilisateur</p>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-lg-12 vivi">
                          
                       </div>
                   </div>
                   <form role="form">
                   <div class="form-group row">
                       <label for="name" class="col-sm-2 form-control-label">Nom complet</label>
                       <div class="col-lg-6">
                           <input type="name" class="form-control" id="name">
                       </div>
                   </div>
                   <div class="form-group row">
                       <label for="mail" class="col-sm-2 form-control-label">Email Adress</label>
                       <div class="col-lg-6">
                           <input type="mail" class="form-control" id="mail">
                       </div>
                   </div>
                   <div class="form-group row">
                       <label for="telephone" class="col-sm-2 form-control-label">Téléphone</label>
                       <div class="col-lg-6">
                           <input type="telephone" class="form-control" id="telephone">
                       </div>
                   </div>
                   <div class="form-group row">
                       <label for="mail" class="col-sm-2 form-control-label">Login</label>
                       <div class="col-lg-6">
                           <input type="mail" class="form-control" id="mail">
                       </div>
                   </div>
                   <div class="form-group row">
                       <label for="password" class="col-sm-2 form-control-label">Password</label>
                       <div class="col-lg-6">
                           <input type="password" class="form-control" id="password">
                       </div>
                   </div>
                   <div class="form-group row">
                       <label for="password" class="col-sm-2 form-control-label">Confirm</label>
                       <div class="col-lg-6">
                           <input type="password" class="form-control" id="password">
                       </div>
                   </div>
                    <div class="form-group row">
                       <label for="fonction" class="col-sm-2 form-control-label">Fonction</label>
                       <div class="col-lg-6">
                           <input type="fonction" class="form-control" id="fonction">
                       </div>
                   </div>
                   </form>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12 bouton">
                     <div class="row">
                          <div class="col-lg-offset-4 col-lg-3">
                                 <button type="button" class="btn btn-primary btn-sm">Envoyer</button>
                                 <button type="button" class="btn btn-secondary btn-sm">Cancel</button>
                          </div>
                     </div>
               </div>
            </div>
            <?php
				include ("front_footer.php");
				include ("footer.php");
		  	?>