<?php

/**
 * usuario.php
 * Módulo secundario que implementa la clase Usuario.
 *
 * @author Pedro Andrés Mancebo
 * @since 04/11/2019
 */
/** Incluye la clase. */
include '../capa_datos/bdusuarios.php';

class Usuario {

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
	}	/**


	/**
	 * Método que devuelve el valor del atributo nombre.
	 *
	 * @access public
	 * @return string Nombre completo del usuario.
	 */
	public function getFechanac() {
		return $this->fechanac;
	}	/**




	/**
	 * Método que comprueba si un usuario existe en la base de datos.
	 *
	 * @access public
	 * @return integer	1 el usuario existe
	 *					2 el usuario no existe
	 *					3 falla la conexión con el servidor de base de datos.
	 */
	public function existeUsuario() {
		/** @var BDUsuarios Instancia un objeto de la clase. */
		$bdusuario = new BDUsuarios();
		/** Se comprueba si existe la conexión con el servidor de BD. */
		if ($bdusuario->getPdocon()) {
			/** Inicializa los atributos del objeto. */
			$bdusuario->setEmail($this->email);
			$bdusuario->setContraseña($this->contraseña);
			$bdusuario->setNombre($this->nombre);
			$bdusuario->setFechanac($this->fechanac);
			/** Comprueba si existe el usuario. */
			if ($bdusuario->existeUsuario()) {
				/** El usuario existe. */
				return 1;
			}
			else {
				/** El no usuario existe. */
				return 2;
			}
		}
		/** Fallo en la conexión con el servidor de base de datos. */
		return 3;
	}

	/**
	 * Método que inserta un usuario en la base de datos.
	 *
	 * @access public
	 * @return integer	1 el usuario ha sido almacenado
	 *					2 el usuario no ha podido ser almacenado
	 *					3 falla la conexión con el servidor de base de datos.
	 */
	public function almacenaUsuario() {
		/** @var BDUsuarios Instancia un objeto de la clase. */
		$bdusuario = new BDUsuarios();
		/** Se comprueba si existe la conexión con el servidor de BD. */
		if ($bdusuario->getPdocon()) {
			/** Inicializa los atributos del objeto. */
			$bdusuario->setEmail($this->email);
			$bdusuario->setContraseña($this->contraseña);
			$bdusuario->setNombre($this->nombre);
			$bdusuario->setFechanac($this->fechanac);
			/** Inserta un nuevo usuario y comprueba un posible error. */
			if ($bdusuario->altaUsuario()) {
				/** El usuario ha sido almacenado. */
				return 1;
			}
			else {
				/** El usuario no ha podido ser almacenado. */
				return 2;
			}
		}
		/** Fallo en la conexión con el servidor de base de datos. */
		return 3;
	}

	/**
	 * Método que valida un usuario registrado en la base de datos.
	 *
	 * @access public
	 * @return integer	1 el usuario ha sido validado
	 *					2 el usuario no ha podido ser validado
	 *					3 falla la conexión con el servidor de base de datos.
	 */
	public function validaUsuario() {
		/** @var BDUsuarios Instancia un objeto de la clase. */
		$bdusuario = new BDUsuarios();
		/** Se comprueba si existe la conexión con el servidor de BD. */
		if ($bdusuario->getPdocon()) {
			/** Inicializa los atributos del objeto. */
			$bdusuario->setEmail($this->email);
			$bdusuario->setContraseña($this->contraseña);
			/** Comprueba si existe y gestiona un posible error. */
			if ($bdusuario->validaUsuario()) {
				/** Inicializa los atributos del objeto con los datos almacenados. */
				$this->nombre = $bdusuario->getNombre();
				$this->fechanac = $bdusuario->getFechanac();
				$this->email = $bdusuario->getEmail();
				$this->contraseña = $bdusuario->getContraseña();
				/** El usuario ha sido validado. */
				return 1;
			}
			else {
				/** El usuario no ha podido ser validado. */
				return 2;
			}
		}
		/** Fallo en la conexión con el servidor de base de datos. */
		return 3;
	}

	/**
	 * Método que modifica los datos de un usuario en la base de datos.
	 *
	 * @access public
	 * @return integer	1 el usuario ha sido modificado
	 *					2 el usuario no ha podido ser modificado
	 *					3 falla la conexión con el servidor de base de datos.
	 */
	public function modificaUsuario($emailOriginal) {
		/** @var BDUsuarios Instancia un objeto de la clase. */
		$bdusuario = new BDUsuarios();
		/** Se comprueba si existe la conexión con el servidor de BD. */
		if ($bdusuario->getPdocon()) {
			/** Inicializa los atributos del objeto. */
			$bdusuario->setEmail($this->email);
			$bdusuario->setContraseña($this->contraseña);
			$bdusuario->setNombre($this->nombre);
			$bdusuario->setFechanac($this->fechanac);
			/** Modifica los datos del usuario y comprueba un posible error. */
			if ($bdusuario->modificaUsuario($emailOriginal)) {
				/** El usuario ha sido modificado. */
				return 1;
			}
			else {
				/** El usuario no ha podido ser modificado. */
				return 2;
			}
		}
		/** Fallo en la conexión con el servidor de base de datos. */
		return 3;
	}

	/**
	 * Método que elimina un usuario registrado en la base de datos.
	 *
	 * @access public
	 * @return integer	1 el usuario ha sido eliminado
	 *					2 el usuario no ha podido ser eliminado
	 *					3 falla la conexión con el servidor de base de datos.
	 */
	public function eliminaUsuario() {
		/** @var BDUsuarios Instancia un objeto de la clase. */
		$bdusuario = new BDUsuarios();
		/** Se comprueba si existe la conexión con el servidor de BD. */
		if ($bdusuario->getPdocon()) {
			/** Inicializa los atributos del objeto. */
			$bdusuario->setEmail($this->email);
			/** Elimina un usuario y comprueba un posible error. */
			if ($bdusuario->eliminaUsuario()) {
				/** El usuario ha sido eliminado. */
				return 1;
			}
			else {
				/** El usuario no ha podido ser eliminado. */
				return 2;
			}
		}
		/** Fallo en la conexión con el servidor de base de datos. */
		return 3;
	}

}
