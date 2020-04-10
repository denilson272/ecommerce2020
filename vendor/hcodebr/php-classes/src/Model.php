<?php 

namespace Hcode;

class Model {

	private $values = []; // tem todos os campos do usuario caso objeto for usuario

	public function __call($name, $args) // metodo magico, nome do metodo e parametros
	{

		$method = substr($name, 0, 3); // metodo get, ou set ?
		$fieldName = substr($name, 3, strlen($name)); //nome do campo da terceira letra até o tamanho total dos ch

		/* var_dump($method, $fieldName);
		exit;
		 */switch ($method)
		{

			case "get":
				return $this->values[$fieldName];
			break;

			case "set":
				$this->values[$fieldName] = $args[0];
			break;

		}

	}

	public function setData($data = array())
	{

		foreach ($data as $key => $value) {
			
			$this->{"set".$key}($value);

		}

	}

	public function getValues()
	{

		return $this->values;

	}

}

 ?>