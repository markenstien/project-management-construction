<?php
	
 	abstract class Model extends ModelCore
	 {

		private $_error = [];

		protected $instance = null;
		public $_dbConditionWrap = 'db_condition_wrap';

 		public function __construct()
 		{

 			$this->db = new Database(DBVENDOR , DBHOST , DBNAME , DBUSER , DBPASS);


 			$this->dbHelper = new DatabaseHelper( Database::getInstance() );


 			$this->prefix  = DB_PREFIX;
		 }

		 /** OVERRIDEDABLE */
		public function store($values)
		{
			$data = [
				$this->table,
				$values
			];

			return $this->saveId($this->dbHelper->insert(...$data));
		}

		public function update($values , $id)
		{
			$data = [
				$this->table,
				$values,
				"id = '{$id}'"
			];

			return $this->dbHelper->update(...$data);
		}

		public function delete($id)
		{
			$data = [
				$this->table,
				"id = '{$id}'"
			];

			return $this->dbHelper->delete(...$data);
		}

		public function get($id)
		{
			$data = [
				$this->table ,
				'*',
				"id = '{$id}'"
			];

			return $this->dbHelper->single(...$data);
		}

		public function all($where = null , $order_by = null , $limit = null)
		{

			if(!is_null($where))
			{
				if(is_array($where)) {
					$where = $this->conditionEqual($where);
				}
			}

			$data = [
				$this->table ,
				'*',
				$where,
				$order_by,
				$limit
			];
			return $this->dbHelper->resultSet(...$data);
		}


		public function single(array $where, $fields = '*' , $orderBy = null)
		{
			$whereString = $this->conditionEqual($where);

			$data = [
				$this->table ,
				$fields, 
				$whereString,
				$orderBy
			];
			
			return $this->dbHelper->single(...$data);
		}

		public function dbgetAssoc($field , $where = null)
	    {
			if(is_array($where))
			$where = $this->conditionEqual($where);

			$data = [
				$this->table,
				'*',
				$where,
				"$field ASC"
			];

	      return $this->dbHelper->resultSet(...$data);
	    }

	    public function dbgetDesc($field , $where = null)
	    {
		  if(is_array($where))
			$where = $this->conditionEqual($where);

	      $data = [
	        $this->table,
	        '*',
	        $where,
	        "$field DESC"
	      ];

	      return $this->dbHelper->resultSet(...$data);
	    }

		public function first()
		{
			$data = [
				$this->table ,
				'*',
				null,
				'id asc',
				'1'
			];
			
			return $this->dbHelper->single(...$data);
		}

    final public function dbData($data)
    {
      $this->data = $data;
    }

    final public function getdbData($property = null)
    {
      if(is_null($property))
        return $this->data;

      return $this->data->$property;
    }


	public function filter($filters)
	{
		$filterCondition = '';

		$counter = 0;

		$fields = array_keys($filters);
		foreach($fields as $key => $val)
		{
			if($counter < $key) {

				$filterCondition .= " AND ";
				$counter++;
			}

			$filterCondition .= " {$val} like '%{$filters[$val]}%'";
		}

		return $filterCondition;
	}

	final public function add_model($varname , $instance)
	{
		$this->$varname = $instance;
	}


	final protected function saveId($id)
	{
		$this->database['id'] = $id;
		return $id;
	}

	final public function getId()
	{
		if(isset($this->database['id']))
			return $this->database['id'];
		return die("Saved Id Not Found");
	}


	// final public function conditionEqual($params)
	// {
	// 	$WHERE = '';

	// 	$counter = 0;
	// 	$increment = 0;

	// 	foreach($params as $key => $row) 
	// 	{
	// 		if($counter < $increment){
	// 			$WHERE .= ' AND ';
	// 			$counter++;
	// 		}

	// 		$WHERE .= " $key = '{$row}'";

	// 		$increment++;
	// 	}

	// 	return $WHERE;
	// }

	public function conditionEqual($params , $defaultCondition = '=')
		{
			$WHERE = '';
			$counter = 0;

			$errors = [];


			if( !is_array($params) )
				return $params;
			/*
			*convert-where default concatinator is and
			*add concat on param values to use it
			*/
			$condition_operation_concatinator = 'AND';

			foreach($params as $key => $param_value) 
			{	
				if($counter > 0)
					$WHERE .= " {$condition_operation_concatinator} ";
					
				/*should have a condition*/
				if(is_array($param_value) && isset($param_value['condition']) ) 
				{
					$condition_operation_concatinator = $param_value['concatinator'] ?? $condition_operation_concatinator;

					//check for what condition operation
					$condition = $param_value['condition'];
					$condition_values = $param_value['value'] ?? '';
					/**
					 * GROUPING CONDITION
					 * SAMPLE
					 * where => [0
					 *  => [value => convertWhere(condition), condition => _dbConditionWrap, concatinator],
					 * ]
					 */
					if(is_numeric($key) && isEqual($condition, $this->_dbConditionWrap)) {
						$WHERE .= "({$param_value['value']})";
						if(isset($param_value['concatinator'])) {
							$WHERE .= " {$param_value['concatinator']} ";
						}
						continue;
					}

					if(isEqual($condition , 'not null'))
					{
						$WHERE .= "{$key} IS NOT NULL ";
						$has_condition = true;
					}

					if(isEqual($condition , ['between' , 'not between']))
					{
						if(!is_array($condition_values) )
							echo die(["Invalid query" , $params]);
						if(count($condition_values) < 2 )
							echo die("Incorrect between condition");

						$condition = strtoupper($condition);

						list($valueA, $valueB) = $condition_values;
							$WHERE .= " {$key} {$condition} '{$valueA}' AND '{$valueB}'";

						$has_condition = true;
					}

					if(isEqual($condition, ['equal' , 'not equal' , 'in' , 'not in']) )
					{
						$conditionKeySign = '=';

						if(isEqual($condition , 'not equal'))
							$conditionKeySign = '!=';

						if(isEqual( $condition , 'in'))
							$conditionKeySign = ' IN ';

						if(isEqual( $condition , 'not in'))
							$conditionKeySign = ' NOT IN ';

						if(is_array($condition_values) ){
							$WHERE .= "{$key} $conditionKeySign ('".implode("','",$condition_values)."') ";
						}else{
							$WHERE .= "{$key} {$conditionKeySign} '{$condition_values}' ";
						}

						$has_condition = true;
					}

					/*
					*if using like
					*add '%' on value 
					*/
					if(isEqual($condition , 'like')){
						$conditionKeySign = 'like';
						$WHERE .= "{$key} {$conditionKeySign} '{$condition_values}'";
					}

					if(isEqual($condition , ['>' , '>=' , '<' , '<=' , '='])){
						$conditionKeySign = $condition;
						$WHERE .= "{$key} {$conditionKeySign} '{$condition_values}' ";
					}

					$counter++;
					continue;
				}

				if($key == 'db_wrap') {
					$WHERE .= "{$defaultCondition} ($param_value)";
				}

				if(isEqual($defaultCondition, 'like')){
					$WHERE .= " $key {$defaultCondition} '%{$param_value}%'";
				}
					

				if(isEqual($defaultCondition, '=')){
					$isNotCondition = substr( $param_value , 0 ,1); //get exlamation
					$isNotCondition = stripos($isNotCondition , '!');

					if($isNotCondition === FALSE) {
						$WHERE .= " $key = '{$param_value}'";
					}else{
						$cleanRow = substr($param_value , 1);
						$WHERE .= " $key != '{$cleanRow}'";
					}
				}

				$counter++;
			}

			return $WHERE;
		}



	public function setInstance($instance)
	{
		$this->instance = $instance;
	}

	public function getInstance( $field = null )
	{
		if( is_null($this->instance) )
			return false;

		if (is_null($field))
			return $this->instance;

		return $this->instance->$field;
	}

	public function getWhereIn($field , $fieldValues = [])
	{
		$this->db->query(
			"SELECT * FROM {$this->table}
				WHERE $field in ('".implode("','" , $fieldValues)."') "
		);

		return $this->db->resultSet();
	}
	
 }
