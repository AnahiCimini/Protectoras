<!-- header.php -->
<header class="container">
    <div class="row">
        
        <div class="col-2">
            <img alt="logoHeader" class="header-image img-left" src="<?php echo BASE_URL; ?>assets/img/perroYgato2.png">
        </div>

        <!-- Contenedor central -->
        <div class="col-8 header_central">

            <div class="container">

                <!-- Menú registros -->
                 <div class="row" id="registro_login">
                    <div class="registerButtons">
                        <?php if (isset($_SESSION['email'])): ?>
                            <!-- Si está logueado, mostrar el botón de Logout -->
                            <a href="<?php echo BASE_URL; ?>router.php?action=logout" class="btn btn-dark">Logout</a>
                            <a href="<?php echo BASE_URL; ?>router.php?action=detalleProtectora&nombre_protectora=<?php echo urlencode($_SESSION['nombre_protectora']); ?>" class="btn btn-dark">Mi perfil</a>
                            <a href="<?php echo BASE_URL; ?>router.php?action=addCase&proteEmail=<?php echo urlencode($_SESSION['email']); ?>" class="btn btn-dark">Añadir caso</a>
                        <?php else: ?>
                            <!-- Si no está logueado, mostrar los botones de Regístrate y Login -->
                            <a href="<?php echo BASE_URL; ?>?page=registro" class="btn btn-dark">Regístrate</a>
                            <a href="<?php echo BASE_URL; ?>?page=login" class="btn btn-dark">Login</a>
                        <?php endif; ?>
                    </div>
                 </div>

                <!-- Menú principal -->
                <div class="row align-items-center" id="menu_principal">

                    <div class="col-4">
                        <a href="<?php echo BASE_URL; ?>?page=nosotros" class="menu-link">
                            <div id="menu_nosotros" class="menu_lateral">NOSOTROS</div>
                        </a>
                    </div>
                    
                    <div class="col-4" id="menu_home">
                        <a href="<?php echo BASE_URL; ?>?page=home">
                            <img class="img_menu_home" src="<?php echo BASE_URL; ?>assets/img/homeImage.png">
                        </a>
                    </div>
                
                    <div class="col-4">
                        <a href="<?php echo BASE_URL; ?>?page=protectoras" class="menu-link">
                        <div id="menu_protectoras" class="menu_lateral">PROTECTORAS</div>    
                        </a>
                    </div> 

                </div>
            </div>
        </div>

        <div class="col-2">         
            <img alt="logoHeader" class="header-image img-right" src="<?php echo BASE_URL; ?>assets/img/perroYgato2.png">
        </div>
    </div>
</header>
