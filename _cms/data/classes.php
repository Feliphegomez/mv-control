<?php
/* 
	Clase principal para Acceder a la base de datos.
*/
class ConectionDB
{
	var $error = true; // Error activo Si / No
	var $message = null; // Mensaje para el error
	var $sql = null; // Consulta vacia
	var $data = array(); // Infomacion SQL	
	
	/* Seleccionar Tabla SQL */
	function setSQL($sql=null)
	{
		$this->sql = $sql;
	}
	
	/* */
	function executeSQL()
	{
		try {
			$conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_HASH);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare($this->sql); 
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			#$result = $stmt->setFetchMode(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$DataFull = $stmt->fetchAll();
			if(count($DataFull) === 1){
				$this->dataCount = 1;
				$this->data = ($DataFull[0]);
			}else{
				$this->dataCount = count($DataFull);
				$this->data = ($DataFull);
			}
			
			$this->error = false;
			$this->message = "Consulta cargada con éxito.";
		}
		catch(PDOException $e) {
			$this->message = $e->getMessage();
		}
		$conn = null;
	}
}

/* 
	Clase principal para recolectar todos los datos necesarios
	como action, campos, pagina, modulo activo, entre otros...
*/
class DataPage
{
	var $path, $module, $page, $action, $server, $remoteIP, $messageGlobal = null;
    var $fields, $session = array();
    
	/* Crear y Detectar componentes de la pagina */
	function __construct()
	{
        $this->server = $_SERVER['HTTP_HOST']; // Servidor donde se ejecuta
        $this->remoteIP = $this->getRealIpAddr(); // IP Remota de Ejecucion
    
        if(isset($_GET['path']))
		{
            $this->path = $_GET['path'];
            $ex1 = explode("/", $_GET['path']);
            $datosPagina = array_values($ex1);
            if(isset($datosPagina[0]))
			{
                $this->module = $datosPagina[0];
                unset($datosPagina[0]);
                $datosPagina = array_values($datosPagina);
            }
			else
			{
                $this->module = 'dashboard';
            };
            
            if(isset($datosPagina[0]))
			{
                $this->page = $datosPagina[0];
                unset($datosPagina[0]);
                $datosPagina = array_values($datosPagina);
                $this->fields['page'] = $datosPagina;
            }
			else
			{
                $this->page = 'index';
            };
            unset($_GET['path']);
        }
        
		if(isset($_GET) && count($_GET) > 0)
		{
            foreach($_GET As $k=>$v)
			{
                $this->fields['get'][$k] = $v;
            }
        }
        
		if(isset($_POST) && count($_POST) > 0)
		{
            foreach($_POST As $k=>$v)
			{
                $this->fields['post'][$k] = $v;
                unset($_POST[$k]);
            }
        }
        
        if($this->path == null) $this->path = '/';
        if($this->module == null) $this->module = 'dashboard';
        if($this->page == null) $this->page = 'index';
        if($this->action == null) $this->action = 'view';
        
        
        /* Detectar si hay o no sesion activa. */
        $this->session = new Session();
        $session = $this->session;
        if($session->username != 'guest')
		{
            # $this->messageGlobal = ('session iniciada');
        }
        else
        {
            $this->messageGlobal = "Por Favor, Ingresa al aplicativo.";
            $this->module = 'login';
            $this->page = 'index';
            
            
            /* Detectar si se debe iniciar sesion */
            if(
                isset($this->fields['post']['loginNick'])
                && isset($this->fields['post']['loginHash'])
            )
            {
                $nick = (string) strtolower($this->fields['post']['loginNick']);
                $pass = (string) $this->fields['post']['loginHash'];
                $this->logIn($nick, $pass);
            }
        }
        
        /* Detectar si se debe cerrar sesion */
        if(
            isset($this->fields['get']['logOut'])
        )
        {
            $this->logOut();
        }
    }
	
	/* Login global */
	function logIn($username, $hash)
	{
		echo 'Comprobando datos de inicio de session...'.'<br>';
		echo "Usuario: {$username} <br>";
		echo "Contraseña: {$hash} <br>";
		$connect = new ConectionDB();
		$connect->setSQL("Select A.id, A.username, A.hash, A.profile_id, B.permissions, A.permission_id, B.name As permission_name From users A Left Join permissions B ON B.id = A.permission_id where username IN ('{$username}') and hash IN ('{$hash}') limit 1");
		$connect->executeSQL();
        if($connect->error == false)
        {
            if($connect->dataCount === 1)
            {
                
                $fecha = date_create();
                $connect->data->lastConnection = date_timestamp_get($fecha);
                $connect->data->lastIP = $this->getRealIpAddr();
                
                $userSession = new User();
                $userSession->setData($connect->data);
                
                foreach($userSession As $k=>$v){
                    $k = (string) $k;
                    $v = ($v);
                    $_SESSION[$k] = $v;
                }
                
                $this->messageGlobal = ("Datos Correctos" );
                $this->module = 'dashboard';
                $this->page = 'index';
                header('Location: /');
            }else{
                $this->messageGlobal = ("Datos Invalidos");
            }
        }
	}
    
	/* Logout global */
    function logOut()
    {
        // destroy session
        session_unset();
        $session = $_SESSION;
        $_SESSION = array();
        foreach($session As $k=>$v){
            unset($_SESSION[$k]);
        }
        session_destroy();
        header('Location: /');
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
    
	/* Funcion String Devuelve codigo Json de todo */
	function __toString()
	{
		return json_encode($this, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	}
	
	/* Funcion String/HTML Devuelve tabla  debug */
	function debugEnable()
	{
           $htmlR = '<div class="table-responsive"><table class="table table-striped">';
            foreach($this As $k=>$v)
            {
                $htmlR .= '<tr>';
                    $htmlR .= '<th>'.$k.'</th>';
                    $htmlR .= '<td>'.json_encode($v).'</td>';
                $htmlR .= '</tr>';
            }
		$htmlR .= '</table></div>';
        return $htmlR;
	}
	
	function includePageActive()
	{
		$file = "_cms/modules/{$this->module}/pages/{$this->page}.php";
		
		if(file_exists($file))
		{
			include($file);
		}
		else
		{
			echo 'Archivo no encontrado: '.$file;
		}
	}
	
	function includePageActiveFooterScripts()
	{
		$file = "_cms/modules/{$this->module}/pages/scripts/{$this->page}.php";
		if(file_exists($file))
		{
			include($file);
		}
		else
		{
			echo 'falta archivo de scripts';
		}
	}
	
	function includeFile($namefile='')
	{
		$file = "_cms/files/{$namefile}";
		if(file_exists($file))
		{
			include($file);
		}
		else
		{
			echo 'Archivo no encontrado: '.$file;
		}
	}
	
	/* Funcion para devolver el código HTML */
	function htmlRun()
	{
		$this->includeFile('template-home.php');
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
	function isActive()
	{
		if($this->delete == null && $this->delete_by == null)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/* Funcion String Devuelve codigo Json de todo */
	function __toString()
	{
		return json_encode($this, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	}
    
	function setValue($key, $value=null)
	{
        if($key!=null && $value!=null)
        {
            if(isset($this->{$key})){
                $this->{$key} = $value;
            }
        }
    }
}

/* Clase principal de Usuarios - LOGIN */
class User extends BaseGlobal
{
	var $id = 0;
	var $username = 'guest';
	var $hash = null;
	var $lastConnection = null;
	var $lastIP = null;
	var $permissions = null;
	var $permission_id = 0;
	var $permission_name = null;
	var $profile_id = 0;
	var $profile = null;
    
	function setData($data=null)
	{
        if(isset($data->id)) $this->id = (int) $data->id;
        if(isset($data->username)) $this->username = $data->username;
        if(isset($data->hash)) $this->hash = $data->hash;
        if(isset($data->lastConnection)) $this->lastConnection = $data->lastConnection;
        if(isset($data->lastIP)) $this->lastIP = $data->lastIP;
        if(isset($data->permissions)) $this->permissions = $data->permissions;
        if(isset($data->permission_id)) $this->permission_id = (int) $data->permission_id;
        if(isset($data->permission_name)) $this->permission_name = $data->permission_name;
        if(isset($data->create)) $this->create = $data->create;
        if(isset($data->create_by)) $this->create_by = $data->create_by;
        if(isset($data->change)) $this->change = $data->change;
        if(isset($data->change_by)) $this->change_by = $data->change_by;
        if(isset($data->delete)) $this->delete = $data->delete;
        if(isset($data->delete_by)) $this->delete_by = $data->delete_by;
        if(isset($data->profile_id)){
            $this->profile_id = (int) $data->profile_id;
        };
        $prof = new Profile($this->profile_id);
        $this->profile = (string) $prof;
        
    }
}

class Session
{
	var $error = true;
	var $id = 0;
	var $username = 'guest';
	var $hash = null;
	var $lastConnection = null;
	var $lastIP = null;
	var $permissions = null;
	var $permission_id = null;
	var $permission_name = null;
	var $profile_id = null;
	var $profile = null;

	function __construct()
	{		        
		if(
			isset($_SESSION['id'])
			&& isset($_SESSION['username'])
			&& isset($_SESSION['hash'])
			&& isset($_SESSION['lastConnection'])
			&& isset($_SESSION['lastIP'])
			&& isset($_SESSION['permissions'])
			&& isset($_SESSION['permission_id'])
			&& isset($_SESSION['permission_name'])
			&& isset($_SESSION['profile_id'])
			&& isset($_SESSION['profile'])
		)
		{
			$this->error = false;
			$this->id = (int) $_SESSION['id'];
			$this->username = $_SESSION['username'];
			$this->hash = $_SESSION['hash'];
			$this->lastConnection = $_SESSION['lastConnection'];
			$this->lastIP = $_SESSION['lastIP'];
			$this->permissions = json_decode($_SESSION['permissions']);
			$this->permission_id = (int) $_SESSION['permission_id'];
			$this->permission_name = $_SESSION['permission_name'];
			$this->profile_id = (int) $_SESSION['profile_id'];
			$this->profile = json_decode($_SESSION['profile']);
		}
		else
		{
			$this->error = true;
		}
	}
}

/* Clase principal de Personas - LOGIN */
class Profile extends BaseGlobal
{
	/* - DATOS PERSONALES - */
	var $id = null; // ID Interno de Usuario
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
	
    function __construct($profile_id=0)
    {
        $this->id = $profile_id;
        echo $this->id;
        $profileInfo = new ConectionDB();
        $profileInfo->setSQL("Select * From persons where id IN ('{$this->id}') ");
        $profileInfo->executeSQL();
        if($profileInfo->error == false)
        {
            foreach($profileInfo->data as $k=>$v)
            {
                if($this->{$k} == null){
                    $this->{$k} = $v;
                }
                #$this->{$k} = $v;
                #if(isset($this->{$k})) $this->{$k} = $v;
            }
        }
        
        
    }
    
	/* Cambiar validacion si el contenido esta activo */
	function isActive()
	{
		if($this->status == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}








