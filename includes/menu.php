
<ul id="menu">
    
    <li class="noItem"><a href="#">Accueil</a><!-- Begin Home Item -->
    
   
    </li><!-- End Home Item -->

   <li><a href="#" class="drop">Dahira</a><!-- Begin Dahira Item -->
    
        <div class="dropdown_4columns"><!-- Begin Dahira container -->
            
            <div class="col_1">
            
                <h3><a class="ajax" href="pages/dahira/historique.php">Historique</a></h3>
                 
            </div>
    
            <div class="col_1">
            
                <h3><a class="ajax" href="pages/dahira/organigramme.php">Organigramme</a></h3>
                 
            </div>
    
            <div class="col_1">
            
                <h3><a class="ajax" href="pages/dahira/projet.php">Projet</a></h3>
                 
            </div>
    
            <div class="col_1">
            
                <h3><a class="ajax" href="pages/dahira/contact/contactform.php">Contact</a></h3>  
                 
            </div>
            
        </div><!-- End 4 columns container -->
    
    </li><!-- End 4 columns Item -->
    <li><a href="#" class="drop">Islam</a><!-- Begin 4 columns Item -->
    
        <div class="dropdown_4columns"><!-- Begin 4 columns container -->
        
           <div class="col_1">
            
                <h3><a href="#">Mouridisme</a></h3>
                 
            </div>
    
            <div class="col_1">
            
                <h3><a href="#">Coran</a></h3>
                 
            </div>
        </div><!-- End 4 columns container -->
    
    </li><!-- End 4 columns Item -->

 <li><a href="#" class="drop">Médiathèque</a><!-- Begin Médiathèque Item -->
    
        <div class="dropdown_4columns"><!-- Begin  Médiathèque container -->
        
            <div class="col_1">
            
                <h3><a href="#">Vidéos</a></h3>
                 
            </div>
    
            <div class="col_1">
            
                <h3><a href="#">Audios</a></h3>
                 
            </div>
    
            <div class="col_1">
            
                <h3><a href="#">Photos</a></h3>
                 
            </div>
            
        </div><!-- End 4 Médiathèque container -->
    
    </li><!-- End Médiathèque Item -->


 <li class="noItem"><a href="#" >TV</a><!-- Begin TV Item -->
    
    </li><!-- End TV Item -->


	<li class="menu_right"><a href="#" class="drop">Connecter</a> <!-- Begin connecter Item -->
    
		<div class="dropdown_1column login align_right"> <!-- Begin S'inscrire container -->
        
                <div class="col_1">
                    <form id="loginForm" class="form">
                        <fieldset id="body">
                            <fieldset>
                                <label for="email">Email Address</label>
                                <input type="text" name="email" id="email" />
                            </fieldset>
                            <fieldset>
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" />
                            </fieldset>
                            <input type="submit" id="login" value="Sign in" />
                            <label for="checkbox"><input type="checkbox" id="checkbox" />Remember me</label>
                        </fieldset>
                        <span><a href="#">Forgot your password?</a></span>
                    </form>
                </div>
                
		</div><!-- End Connecter container -->
        
	</li><!-- End Connecter Item -->

    <li class="menu_right"><a href="#" class="drop">S'inscrire</a><!-- Begin S'inscrire Item -->
    
        <div class="dropdown_1column inscription align_right"><!-- Begin S'inscrire container -->
            <div class="col_1">
    
                <?php include './includes/inscriptionForm.php' ?>
    
            </div>
            
        </div><!-- End S'inscrire container -->
        
    </li><!-- End S'inscrire Item -->
</ul>