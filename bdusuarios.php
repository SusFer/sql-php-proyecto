<?php

/**
 * bdusuarios.php
 * Módulo secundario que implementa la clase BDUsuarios.
 *
 * @author Pedro Andrés Mancebo
 * @since 04/11/2019
 */
class BDUsuarios {

	/**
	 * @var PDO Conexión con el servidor de bases de datos.
	 * @access private 
	 */
	protected $pdocon = null;

	/**
	 * @var string Dirección de correo electrónico del usuario.
	 * @access private 
	 */
	private $email;

	/**
	 * @var string Contraseña del usuario.
	 * @access private 
	 */
	private $contraseña;

	/**
	 * @var string Nombre completo del usuario.
	 * @access private 
	 */
	private $nombre;

	/**
	 * @var string Nombre completo del usuario.
	 * @access private 
	 */
	private $fechanac;


	/**
	 * @const DSN Nombre del origen de datos.
	 */
	const DSN = "mysql:host=localhost;dbname=mitologiausuarios";

	/**
	 * @const USUARIO Nombre del usuario del servidor de bases de datos.
	 */
	const USUARIO = "mitologiausuarios";

	/**
	 * @const CONTRASEÑA Contraseña del usuario.
	 */
	const CONTRASEÑA = "Lo-1234-lo";

	/**
	 * @const OPCIONES[] Opciones de conexión específicas del controlador.
	 */
	const OPCIONES = array(PDO::MYSQL_ATTR_INIT_COMMAND =>
		'SET CHARACTER SET utf8');

	/**
	 * Constructor de la clase.
	 * 
	 * @access public
	 */
	public function __construct() {
		try {
			/** Establece la conexión con el servidor de bases de datos. */
			$this->pdocon = new PDO(self::DSN, self::USUARIO, self::CONTRASEÑA,
				self::OPCIONES);
		}
		catch (PDOException $e) {
			$this->pdocon = null;
		}
	}

	/**
	 * Destructor de la clase.
	 * 
	 * @access public
	 */
	public function __destruct() {
		/** Cierra la conexión con el servidor de bases de datos. */
		$this->pdocon = null;

	}

	/**
	 * Método que inicializa el atributo email.
	 * 
	 * @access public
	 * @param string $email Nombre del usuario.
	 * @return void 
	 */
	public function setEmail($email) {
		$this->email = $email;

	}

	/**
	 * Método que inicializa el atributo contraseña.
	 * 
	 * @access public
	 * @param string $contraseña Nombre del usuario.
	 * @return void 
	 */
	public function setContraseña($contraseña) {
		$this->contraseña = $contraseña;

	}

	/**
	 * Método que inicializa el atributo nombre.
	 * 
	 * @access public
	 * @param string $nombre Nombre del usuario.
	 * @return void 
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;

	}
	/**
	 * Método que inicializa el atributo nombre.
	 * 
	 * @access public
	 * @param string $nombre Nombre del usuario.
	 * @return void 
	 */
	public function setFechanac($fechanac) {
		$this->fechanac = $fechanac;

	}


	/**
	 * Método que devuelve el valor de la conexión.
	 * 
	 * @access public
	 * @return PDO Conexión con el servidor de bases de datos.
	 */
	public function getPdocon() {
		return $this->pdocon;

	}

	/**
	 * Método que devuelve el valor del atributo email.
	 * 
	 * @access public
	 * @return string Email del usuario.
	 */
	public function getEmail() {
		return $this->email;

	}

	/**
	 * Método que devuelve el valor del atributo contraseña.
	 * 
	 * @access public
	 * @return string Contraseña del usuario.
	 */
	public function getContraseña() {
		return $this->contraseña;

	}

	/**
	 * Método que devuelve el valor del atributo nombre.
	 * 
	 * @access public
	 * @return string Nombre completo del usuario.
	 */
	public function getNombre() {
		return $this->nombre;

	}

	/**
	 * Método que devuelve el valor del atributo nombre.
	 * 
	 * @access public
	 * @return string Nombre completo del usuario.
	 */
	public function getfechanac() {
		return $this->fechanac;

	}


	/**
	 * Método que comprueba si existe el usuario en la base de datos.
	 * 
	 * @access public
	 * @return boolean True si existe el email del usuario y False en otro caso
	 */
	public function existeUsuario() {
		/** Comprueba si existe conexión con la base de datos. */
		if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
			$resultado = $this->getPdocon()->prepare(
				"SELECT *
					FROM Usuarios
					WHERE email = :email");
			/** Vincula un parámetro al nombre de variable especificado. */
			$resultado->bindParam(':email', $this->email);
			/** Ejecuta la sentencia preparada y comprueba un posible error. */
			if ($resultado->execute()) {
				/** Comprueba que el número de filas sea 1. */
				if ($resultado->rowCount() === 1) {
					/** Existe el email del usuario. */
					return true;
				}
			}
		}
		/** No existe el email del usuario. */
		return false;

	}

	/**
	 * Método que valida un usuario en la base de datos.
	 * 
	 * @access public
	 * @return boolean True si existe y False en otro caso
	 */
	public function validaUsuario() {
		/** Comprueba si existe conexión con la base de datos. */
		if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
			$resultado = $this->getPdocon()->prepare("
				SELECT *
				FROM Usuarios
				WHERE email = :email AND contraseña = :contrasena");
			/** Vincula un parámetro al nombre de variable especificado. */
			$resultado->bindParam(':email', $this->email);
			$resultado->bindParam(':contrasena', $this->contraseña);
			/** Ejecuta la sentencia preparada y comprueba un posible error. */
			$resultado->execute();
			/** Comprueba que el número de filas sea 1. */
			if ($resultado->rowCount() === 1) {
				/** Accede a los valores obtenidos. */
				$fila = $resultado->fetch();
				/** Inicializa los atributos del objeto. */
				$this->email = $fila['email'];
				$this->contraseña = $fila['contraseña'];
				$this->nombre = $fila['nombre'];
				$this->nombre2 = $fila['fechanac'];
				/** Existe el usuario. */
				return (true);
			}
		}
		/** No existe el usuario. */
		return (false);

	}

	/**
	 * Método que inserta un nuevo usuario en la base de datos
	 * 
	 * @access public
	 * @return boolean True si tiene éxito y False en otro caso
	 */
	public function altaUsuario() {
		/** Comprueba si existe conexión con la base de datos. */
		if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
			$resultado = $this->getPdocon()->prepare(
				"INSERT INTO Usuarios (email, contraseña, nombre, fechanac)
					VALUES (:email, :contrasena, :nombre, :fechanac)");
			/** Vincula un parámetro al nombre de variable especificado. */
			$resultado->bindParam(':email', $this->email);
			$resultado->bindParam(':contrasena', $this->contraseña);
			$resultado->bindParam(':nombre', $this->nombre);
			$resultado->bindParam(':fechanac', $this->fechanac);
			/** Ejecuta la sentencia preparada y comprueba un posible error. */
			if ($resultado->execute()) {
				/** Devuelve true si se ha conseguido. */
				return true;
			}
		}
		/** Devuelve false si se ha producido un error. */
		return false;

	}

	/**
	 * Método que elimina un usuario existente de la base de datos.
	 * 
	 * @access public
	 * @return boolean True si tiene éxito y False en otro caso
	 */
	public function eliminaUsuario() {
		/** Comprueba si existe conexión con la base de datos. */
		if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
			$resultado = $this->getPdocon()->prepare(
				"DELETE FROM Usuarios
					WHERE email = :email");
			/** Vincula un parámetro al nombre de variable especificado. */
			$resultado->bindParam(':email', $this->email);
			/** Ejecuta la sentencia preparada y comprueba un posible error. */
			if ($resultado->execute()) {
				/** Devuelve true si se ha conseguido. */
				return true;
			}
		}
		/** Devuelve false si se ha producido un error. */
		return false;

	}

	/**
	 * Método que modifica los campos de un usuario de la base de datos.
	 * 
	 * @access public
	 * @param string $emailOriginal Valor inicial del email del usuario.
	 * @return boolean True si tiene éxito y False en otro caso
	 */
	public function modificaUsuario($emailOriginal) {
		/** Comprueba si existe conexión con la base de datos. */
		if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
			$resultado = $this->getPdocon()->prepare(
				"UPDATE Usuarios
					SET email = :email,
						contraseña = :contrasena,
						nombre = :nombre
					WHERE email = :emailOriginal");
			/** Vincula los parámetros a los nombre de variables especificado. */
			$resultado->bindParam(':email', $this->email);
			$resultado->bindParam(':contrasena', $this->contraseña);
			$resultado->bindParam(':nombre', $this->nombre);
			$resultado->bindParam(':fechanac', $this->fechanac);
			$resultado->bindParam(':emailOriginal', $emailOriginal);
			/** Ejecuta la sentencia preparada y comprueba un posible error. */
			if ($resultado->execute()) {
				/** Devuelve true si se ha conseguido. */
				return true;
			}
		}
		/** Devuelve false si se ha producido un error. */
		return($resultado);

	}

}
