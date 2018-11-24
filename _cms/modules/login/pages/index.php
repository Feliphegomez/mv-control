<?php
    
?>

<div id="login-button">
    <img src="https://dqcgrsy5v35b9.cloudfront.net/cruiseplanner/assets/img/icons/login-w-icon.png" />
</div>
<div id="container">
    <h1>Iniciar Sesion</h1>
    <span class="close-btn">
    <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png" />
    </span>
    <form method="POST">
        <input type="text" name="loginNick" placeholder="Usuario">
        <input type="password" name="loginHash" placeholder="Contraseña">
        <button href="#">Ingresar</button>
        <div id="remember-container">
            <!--
            <input type="checkbox" id="checkbox-2-1" class="checkbox" checked="checked"/>
            <span id="remember">Dispositivo Personal</span> -->
            <span id="rememberUser" >Recordar Usuario</span>
            <span id="forgotten">Restablecer clave</span>
        </div>
    </form>
</div>

<!-- Container Recuperar Contraseña -->
<div id="forgotten-container">
    <h1>Restablecer clave</h1>
    <span class="close-btn">
    <img src="//cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png" />
    </span>
    <form>
        <input type="text" name="identification" placeholder="Numero de Identificacion">
        <a href="#" class="orange-btn">Restablecer</a>
    </form>
</div>