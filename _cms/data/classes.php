<?php

class DataPage
{
	var $path, $module, $page, $action, $server, $remoteIP = null;
    var $fields = array();
    
	function __construct(){
        $this->server = $_SERVER['HTTP_HOST'];
        $this->remoteIP = $this->getRealIpAddr();
    
        if(isset($_GET['path'])){
            $this->path = $_GET['path'];
            $ex1 = explode("/", $_GET['path']);
            $datosPagina = array_values($ex1);
            if(isset($datosPagina[0])){
                $this->module = $datosPagina[0];
                unset($datosPagina[0]);
                $datosPagina = array_values($datosPagina);
            }else{
                $this->module = 'dashboard';
            };
            if(isset($datosPagina[0])){
                $this->page = $datosPagina[0];
                unset($datosPagina[0]);
                $datosPagina = array_values($datosPagina);
                $this->fields['page'] = $datosPagina;
            }else{
                $this->page = 'index';
            };
            unset($_GET['path']);
        }
        
		if(isset($_GET) && count($_GET) > 0){
            foreach($_GET As $k=>$v){
                $this->fields['get'][$k] = $v;
            }
        }
        
        if($this->path == null) $this->path = '/';
        if($this->module == null) $this->module = 'dashboard';
        if($this->page == null) $this->page = 'index';
        if($this->action == null) $this->action = 'view';
        
        
        /* Detectar si hay o no sesion activa. */
        $session = new Session();
        if($session->error == false){
            echo "Session Encontrada".$session->username;
        }else{
            echo "Por Favor, Ingresa al aplicativo.";
            $this->module = 'login';
            $this->page = 'index';
        }
    }
    
    function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    
    
	/* Funcion Strin Devuelve codigo Json de todo */
	function __toString()
	{
		return json_encode($this, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	}
}


/* 
	Clase principal para heredar en todas las clases
	Informacion sobre Creacion, Modificacion y Eliminacion (Logica)
*/
class BaseGlobal
{
	var $create, $create_by, $change, $change_by, $delete, $delete_by = null;
	
	/* Validar si el contenido esta activo */
	function isActive(){
		if($this->delete == null && $this->delete_by == null){
			return true;
		}else{
			return false;
		}
	}
	
	/* Funcion Strin Devuelve codigo Json de todo */
	function __toString()
	{
		return json_encode($this, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	}
}

/* Clase principal de Usuarios - LOGIN */
class Session extends BaseGlobal
{
	var $error = true;
	var $userid = null;
	var $username = null;
	var $hash = null;
	var $lastConnection = null;
	var $lastIP = null;
	var $roles = array();

	function __construct(){
		if(
			isset($_SESSION['userid'])
			&& isset($_SESSION['username'])
			&& isset($_SESSION['hash'])
			&& isset($_SESSION['lastConnection'])
			&& isset($_SESSION['lastIP'])
			&& isset($_SESSION['roles'])
		){
			$this->error = false;
			$this->username = $_SESSION['username'];
			$this->hash = $_SESSION['hash'];
			$this->lastConnection = $_SESSION['lastConnection'];
			$this->lastIP = $_SESSION['lastIP'];
			$this->roles = $_SESSION['roles'];
		}else{
			$this->error = true;
		}
	}
}

/* Clase principal de Personas - LOGIN */
class Profile extends BaseGlobal
{
	/* - DATOS PERSONALES - */
	var $userid = null; // ID Interno de Usuario
	var $first_name = null; // Primer Nombre
	var $second_name = null; // Segundo Nombre
	var $surname = null; // Primer Apellido
	var $second_surname = null; // Segundo Apellido
	var $identification_type = null; // Tipo de Identificacion
	var $identification_number = null; // Numero Identificacion
	var $identification_date_expedition = null; // Fecha expedicion de identificacion
	var $birthdate = null; // Fecha de nacimineto / cumpleaños
	var $blood_type = null; // Tipo de Sangre
	var $blood_rh = null; // Tipo de RH
	var $mail = null; // Email Personal
	var $number_phone = null; // Numero Fijo Personal
	var $number_mobile = null; // Numero Movil Personal
	
	/* - EMPRESA - */
	var $company_date_entry = null; // Fecha Ingreso a la compañia
	var $company_mail = null; // Email Corporativo
	var $company_number_phone = null; // Numero Fijo / Exten
	var $company_number_mobile = null; // Numero movil corporativo
	var $gang = null; // Cuadrilla
	var $observations = array(); // Notas U Observaciones
	var $avatar = null; // Foto 3x4
	var $status = null; // Estado habilitado o no
	var $currentStatus = null; // Estado Actual
	var $novelty = array(); // Novedades
	var $eps = null; // EPS
	var $arl = null; // ARL
	var $pension_fund = null; // Fondo de Pension
	var $compensation_fund = null; // Caja de compensacion
	var $severance_fund = null; // Fondo de cesantias
	var $contracts = array();
	
	/* Cambiar validacion si el contenido esta activo */
	function isActive(){
		if($this->status == true){
			return true;
		}else{
			return false;
		}
	}
}










