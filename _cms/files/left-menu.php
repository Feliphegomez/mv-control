<?php global $pageDataGlobal; ?>
<nav id="sidebar">
    <div id="dismiss"><i class="fa fa-arrow-left"></i></div>

    <div class="sidebar-header"><h3>Monteverde LTDA</h3></div>

    <ul class="list-unstyled components">
        <p>Bienvenid@</p>
        <li><a href="/">Dashboard</a></li>
        <!-- <li><a href="/forms/new-activity">Nueva Actividad</a></li> -->
        <!-- <li><a href="/forms/new-client">Nuevo Cliente Estilo 1</a></li> -->
        <li><a href="/forms/clients"><i class="fa fa-user-circle"></i> Clientes</a></li>
        
        <li class="active">
			<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fa fa-plus"></i> Listas </a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li><a href="/forms/client-types">Tipos de Cliente</a></li>
                <li><a href="/forms/identification-types">Tipos de Identificaciones</a></li>
                <li><a href="/forms/society-types">Tipos de Sociedades</a></li>
                <li><a href="/forms/citys">Ciudades</a></li>
                <li><a href="/forms/services">Servicios</a></li>
            </ul>
        </li>
        
        <li>
            <a href="#">About</a>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
            </ul>
        </li>
        <li><a href="#">Portfolio</a></li>
        <li><a href="#">Contact</a></li>
    </ul>

    <ul class="list-unstyled CTAs">
        <!-- <li><a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a></li> -->
        <li><a href="/?logOut=true" class="article">Cerrar Sesion</a></li>
    </ul>
</nav>