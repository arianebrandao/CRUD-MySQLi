# CRUD-MySQLi

Funções genéricas de CRUD para PDO ou MySQLi que eu uso.

## Funções
### Deletar Registros
@param string $table Nome da tabela
@param string $where Condição
DBDelete($table, $where = null)
Ex: DBDelete('tabela',"id = 1");
  
### Alterar Registros
@param string $table Nome da tabela
@param array $data Array onde a chave recebe o nome da coluna e seu novo valor
@param string $where Condição
@return int $insertId Auto increment do registro
DBUpdate($table, array $data, $where = null, $insertId = false)
Ex: DBUpdate('tabela',$arrayDados, "id = 1");

### Ler Registros
@param string $table Nome da tabela
@param string $params Parâmetros da busca
@param string $fields Campos da tabela
DBRead($table, $params = null, $fields = '*')
Ex: DBRead('tabela',"WHERE id = 1 ORDER BY nome", "nome, idade");

### Gravar Registros
@param string $table Nome da tabela
@param array $data Array onde a chave recebe o nome da coluna e seu valor
@return int $insertId Auto increment do registro
DBCreate($table, array $data, $insertId = false)
Ex: DBUpdate('tabela',$arrayDados);
