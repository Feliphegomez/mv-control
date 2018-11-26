<style>
/*
 * Base structure
 */

/* Move down content because we have a fixed navbar that is 50px tall */
body {
  padding-top: 50px;
}


/*
 * Global add-ons
 */

.sub-header {
  padding-bottom: 10px;
  border-bottom: 1px solid #eee;
}

/*
 * Top navigation
 * Hide default border to remove 1px line.
 */
.navbar-fixed-top {
  border: 0;
}

/*
 * Sidebar
 */

/* Hide for mobile, show later */
.sidebar {
  display: none;
}
@media (min-width: 768px) {
  .sidebar {
    position: fixed;
    top: 51px;
    bottom: 0;
    left: 0;
    z-index: 1000;
    display: block;
    padding: 20px;
    overflow-x: hidden;
    overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
    background-color: #f5f5f5;
    border-right: 1px solid #eee;
  }
}

/* Sidebar navigation */
.nav-sidebar {
  margin-right: -21px; /* 20px padding + 1px border */
  margin-bottom: 20px;
  margin-left: -20px;
}
.nav-sidebar > li > a {
  padding-right: 20px;
  padding-left: 20px;
}
.nav-sidebar > .active > a,
.nav-sidebar > .active > a:hover,
.nav-sidebar > .active > a:focus {
  color: #fff;
  background-color: #428bca;
}


/*
 * Main content
 */

.main {
  padding: 20px;
}
@media (min-width: 768px) {
  .main {
    padding-right: 40px;
    padding-left: 40px;
  }
}
.main .page-header {
  margin-top: 0;
}


/*
 * Placeholder dashboard ideas
 */

.placeholders {
  margin-bottom: 30px;
  text-align: center;
}
.placeholders h4 {
  margin-bottom: 0;
}
.placeholder {
  margin-bottom: 20px;
}
.placeholder img {
  display: inline-block;
  border-radius: 50%;
}
</style>

<?php global $pageDataGlobal; ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"><?php echo appTitleSmall; ?></a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <form class="navbar-form navbar-left">
        <input type="text" class="form-control" placeholder="Search...">
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle animated rubberBand" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-bell"></i> 
                <span class="badge total-notifications-response-navbartop">0</span>
            </a>
            <ul class="dropdown-menu two question-pending-navbar">
                <li class="dropdown-header">Notificaciones</li>
                <li><a href="#"><i class="fa fa-spinner fa-spin" style="color:#000;"></i> Cargando</a></li>
                <li><a href="#">No tienes notidficaciones pdtes.</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Ver todas las notificaciones</a></li>
                
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle animated rubberBand" data-toggle="dropdown" aria-expanded="true">
                <!--<i class="fa fa-bell"></i> 
                <span class="badge total-notifications-response-navbartop">0</span>-->
                <i class="fa fa-user-circle" aria-hidden="true"></i> <?php echo $pageDataGlobal->session->username; ?>
            </a>
            <ul class="dropdown-menu two question-pending-navbar">
                <li class="dropdown-header"><?php echo "{$pageDataGlobal->session->profile->first_name} {$pageDataGlobal->session->profile->second_name}"; ?></li>
                <li class="dropdown-header"><?php echo "{$pageDataGlobal->session->profile->surname} {$pageDataGlobal->session->profile->second_surname}"; ?></li>
                <li><a href="<?php echo "/profiles/biography/?profile_id={$pageDataGlobal->session->profile->id}"; ?>"><i class="fa fa-wrench"></i> Mi Perfil</a></li>
                <li><a href="#"><i class="fa fa-spinner fa-spin" style="color:#000;"></i> Cargando</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#"><i class="fa fa-wrench"></i> Opciones</a></li>
                <li><a href="?logOut=true"><i class="fa fa-sign-out"></i> Salir</a></li>
                
            </ul>
        </li>
        <!--<li><a href="#"><i class="fa fa-" aria-hidden="true"></i> </a></li>-->
        <li><a href="#"><i class="fa fa-question"></i> Ayuda</a></li>
        
      </ul>
    </div>
  </div>
</nav>
