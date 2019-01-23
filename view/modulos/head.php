    <link rel="stylesheet" href="view/css/estilos.css">
       

        <div class="top_nav">
          <div class="nav_menu">
          <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              
         
			  <?php  
			     $status = session_status();
			     if  (isset( $_SESSION['nombre_usuarios'] ))  {  
              ?>
              	
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="view/images/usuario.jpg" alt="">-->
                    <img src="view/DevuelveImagenView.php?id_valor=<?php echo $_SESSION['id_usuarios']; ?>&id_nombre=id_usuarios&tabla=usuarios&campo=fotografia_usuarios" alt="" ><?php echo $_SESSION['nombre_usuarios'];?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="index.php?controller=Usuarios&action=Actualiza"> Perfil Usuario</a></li>
                    <li><a href="index.php?controller=Usuarios&action=cerrar_sesion"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                  </ul>
                </li>
               
                
			       
             </ul>
              <?php }?>
              
              
            </nav>
            </div>
          
        
        
        </div>
        
        
  






  