<?
if ($seccion=='') {
  // echo "seccion".$seccion;  
  if (!isset($_SESSION)) {
      session_destroy();
      unset($_POST);
  }

}

if ($seccion !='') {

  if( !isset($_SESSION[$sesion_name][email]) && !isset($_SESSION[$sesion_name][pass_usr]) ){
     echo "
               <script language='javascript' type='text/javascript'>
              setTimeout ( function(){ 
              location.href='index.php?seccion=inicio'}
              ,0);
          </script>
          ";
  }
}



?>


<!DOCTYPE html>




        <!-- CONTAINER -->
       <article class=" text-center">
        
            
            <h4 class="color">Acceder</h4>
            <form id="login" method="post" name="frmTipo" action="iniciarsesion.php" class="col-sm-6 col-sm-offset-3">
                <div class="form-group">
                    <input class="form-control text-center validate[required,custom[email]]" type="text" name="email"  placeholder="Email *">
                </div>
                <div class="form-group">
                    <input class="form-control text-center validate[required]" type="password" name="pass_usr" placeholder="password *">
                    <!-- <input type="hidden" name="tipo" value="1" /> -->
                </div>
                <input class="btn btn-default" type="submit" value="ENTRAR">
            </form>

            
          
        
    </article>
        <!-- /.container -->





<!-- /.wrapper -->
