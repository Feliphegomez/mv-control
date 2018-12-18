<?php global $pageDataGlobal; ?>
<nav id="sidebar">
    <div id="dismiss"><i class="fa fa-arrow-left"></i></div>

    <div class="sidebar-header"><h3>Monteverde LTDA</h3></div>

    <ul class="list-unstyled components">
        <p>Bienvenid@</p>
        <li class="active"><a href="/">Dashboard</a></li>
        <!-- <li><a href="/forms/new-client">Nuevo Cliente Estilo 1</a></li> -->
        
        <li><a href="/forms/new-activity">Nueva Actividad</a></li>
        
        
        <li>
			<a href="#clientsSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fa fa-users"></i> Clientes </a>
            <ul class="collapse list-unstyled" id="clientsSubmenu">
                <li><a href="/clients"> <i class="fa fa-user-circle"></i> Clientes</a></li>
                <li><a href="/clients/client-types"> <i class="fa fa-male"></i> Tipos de Cliente</a></li>
                <li><a href="/clients/identification-types"> <i class="fa fa-user-md"></i> Tipos de Identificaciones</a></li>
                <li><a href="/clients/society-types"> <i class="fa fa-user-secret"></i> Tipos de Sociedades</a></li>
            </ul>
        </li>
        <li>
			<a href="#servicesSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fa fa-cogs"></i> Servicios </a>
            <ul class="collapse list-unstyled" id="servicesSubmenu">
                <li><a href="/forms/services"> <i class="fa fa-cog"></i> Servicios</a></li>
                <li><a href="/forms/status-services"> <i class="fa fa-eyedropper"></i> Estados</a></li>
                <li><a href="/forms/categorys-services"> <i class="fa fa-bars"></i> Categorias</a></li>
                <li><a href="/forms/payments-types"> <i class="fa fa-circle"></i> Unidades de Medida</a></li>
            </ul>
        </li>
        <li>
			<a href="#locationsSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fa fa-globe"></i> Locaciones </a>
            <ul class="collapse list-unstyled" id="locationsSubmenu">
                <li><a href="/forms/departments-citys"> <i class="fa fa-map-marker"></i> Departamentos</a></li>
                <li><a href="/forms/citys"> <i class="fa fa-thumb-tack"></i> Ciudades</a></li>
                <li><a href="/forms/lots"> <i class="fa fa-map-signs"></i> Lotes</a></li>
                <li><a href="/forms/categorys-lots"> <i class="fa fa-bars"></i> Categorias de Lotes</a></li>
            </ul>
        </li>
        <li>
			<a href="#employeeSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fa fa-users"></i> Empleados </a>
            <ul class="collapse list-unstyled" id="employeeSubmenu">
                <li><a href="/persons/employee"> <i class="fa fa-user-circle"></i> Personal</a></li>
                <li><a href="/persons/employee-charges"> <i class="fa fa-address-card-o"></i> Cargos</a></li>
                <li><a href="/persons/employee-tasks"> <i class="fa fa-tasks"></i> Tareas</a></li>
                
            </ul>
        </li>
        <li>
			<a href="#vehiclesSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fa fa-bus"></i> Vehículos </a>
            <ul class="collapse list-unstyled" id="vehiclesSubmenu">
                <li><a href="/forms/categorys-vehicles"> <i class="fa fa-bars"></i> Categorias</a></li>
                
            </ul>
        </li>
        <!--
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
        <li><a href="#">Contact</a></li>-->
        <li>
			<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fa fa-plus"></i> Listas </a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li><a href="/forms/zones">Zonas</a></li>
                <li><a href="/forms/arl">ARL</a></li>
                <li><a href="/forms/eps">EPS</a></li>
                <li><a href="/forms/environmental-authorities">Autoridades Ambientales</a></li>
                <li><a href="/forms/novelty-types">Tipos de Novedades</a></li>
                <li><a href="/forms/fortnights">Quincenas</a></li>
                <li><a href="/forms/status-registrations"> Estados de Registros</a></li>
            </ul>
        </li>
    </ul>

    <ul class="list-unstyled CTAs">
        <!-- <li><a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a></li> -->
        <li><a href="/?logOut=true" class="article">Cerrar Sesion</a></li>
    </ul>
</nav>