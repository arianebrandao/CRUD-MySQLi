<?php
	/**
	* CRUD MySQLi
	*
	* Funções genéricas de CRUD para PDO ou MySQLi
	* @author Desconhecido
	* Adaptado por Ariane Brandão
	*/

	/**
	* Deletar Registros
	* @param string $table Nome da tabela
	* @param string $where Condição
	* Ex DBDelete('tabela',"id = 1")
	*/
	function DBDelete($table, $where = null){
		$table 	= DB_PREFIX.'_'.$table;
		$where	= ($where) ? " WHERE {$where}" : null;

		$query 	= "DELETE FROM {$table}{$where}";
		return DBExecute($query);
	}

	/**
	* Alterar Registros
	* @param string $table Nome da tabela
	* @param array $data Array onde a chave recebe o nome da coluna e seu novo valor
	* @param string $where Condição
	* @return int $insertId Auto increment do registro
	* Ex DBUpdate('tabela',$arrayDados, "id = 1")
	*/
	function DBUpdate($table, array $data, $where = null, $insertId = false){
		foreach ($data as $key => $value){
			$fields[] = "{$key} = '{$value}'";
		}

		$fields = implode(', ', $fields);

		$table 	= DB_PREFIX.'_'.$table;
		$where	= ($where) ? " WHERE {$where}" : null;

		$query 	= "UPDATE {$table} SET {$fields}{$where}";
		return DBExecute($query, $insertId);
	}

	/**
	 * Ler Registros
	* @param string $table Nome da tabela
	* @param string $params Parâmetros da busca
	* @param string $fields Campos da tabela
	 * Ex DBRead('tabela',"WHERE id = 1 ORDER BY nome", "nome, idade")
	 */
	function DBRead($table, $params = null, $fields = '*'){
		$table 	= DB_PREFIX.'_'.$table;
		$params = ($params) ? " {$params}" : null;

		$query 	= "SELECT {$fields} FROM {$table}{$params}";
		$result	= DBExecute($query);

		if(!mysqli_num_rows($result))
			return false;
		else {
			while ($res = mysqli_fetch_assoc($result)){
				$data[] = $res;
			}

			return $data;
		}
	}
	
	/**
	 * Gravar Registros
	* @param string $table Nome da tabela
	* @param array $data Array onde a chave recebe o nome da coluna e seu valor
	* @return int $insertId Auto increment do registro
	 * Ex DBUpdate('tabela',$arrayDados)
	 */
	function DBCreate($table, array $data, $insertId = false){
		$table 	= DB_PREFIX.'_'.$table;
		$data 	= DBEscape($data);

		$fields	= implode(', ', array_keys($data));
		$values = "'".implode("', '", $data)."'";

		$query 	= "INSERT INTO {$table} ( {$fields} ) VALUES ( {$values} )";

		return DBExecute($query, $insertId);
	}


	//Executar Querys
	function DBExecute($query, $insertId = false){
		$link 	= DBConnect();
		$result = @mysqli_query($link, $query) or die(mysqli_error($link));

		if($insertId)
			$result = mysqli_insert_id($link);

		DBClose($link);
		return $result;
	}
?>
