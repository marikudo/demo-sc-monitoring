<?php
if(!defined('APPS')) exit ('No direct access allowed');
class pdo_mysql extends dbAccess{
	
	private $dbconfig = array();
    private $count = 0;
    private $error = null;
    private $instance = false;
    private $err = null;
	public function __construct($conf = array()){
		$this->dbconfig = $conf;
	}

    protected function dbConnection(){


         try{
    	 $this->instance = new pdo('mysql:host='.$this->dbconfig['host'].';dbname='.$this->dbconfig['database_name'].'', $this->dbconfig['username'], $this->dbconfig['password']);
        $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
		      $this->instance = false;
           $this->err = $e->getMessage();
           $this->error = $e->getMessage();
        }
    
    }



    /**
     * Closes connection to database server
     *
     * @access protected
     * @return bool
     */
    protected function db_close(){
       return $this->instance = false;
    }

    /**
     * Prepare a statement  and execute
     *
     * @access protected
     * @return mixed
     */
     
    protected function _query($str){
	
        return $this->instance->query($str);
    }

    /**
     * Prepare a statement for execution
     *
     * @access protected
     * @return mixed
     */
     
     protected function _prepare($string){
        $this->statement = $this->instance;
        if ($this->instance != false) {
            $this->statement =  $this->instance->prepare($string);
        }
        return $this->statement;
     }
     /* 
     * return last inserted id
     */
     protected function _lastInsertId(){
        return $this->instance->lastInsertId();
     }

     /*
     * error message
     */

     protected function errorMessage(){
        return $this->instance->errorno();
     }


     /*
     * fetchObj returns an anonymous object with property names that correspond to the column names returned in your result set
     */

     protected function _fetchObj($statement,$vals){
        return $this->selectRecords($statement,$vals,'obj');
     }

     /*
     * fetchboth returns an array indexed by both column name and 0-indexed column number as returned in your result set
     */

     protected function _fetchBoth($statement,$vals){ 
        return $this->selectRecords($statement,$vals,'all');
     }

     /*
     * fetchnum returns an array indexed by column number as returned in your result set, starting at column 0
     */

     protected function _fetchNum($statement,$vals){

        return $this->selectRecords($statement,$vals,'num');
     }

     /*
     * fetchassoc returns an array indexed by column name as returned in your result set
     */

     protected function _fetchAssoc($statement,$vals){
        return $this->selectRecords($statement,$vals,'assoc');
     }
     /*
     * rowCount Returns the number of rows affected by the last SQL statement
     */

     protected function count(){
        return $this->count;
     }


     protected function err(){
        return $this->error;
     }

     /** 
     * Method to record query
     * 
     * @ Access private static 
     * @ Param string $query SQL query 
     * @ Param string $type Return type given query 
     * @ Return mixed 
     * 
     **/

     private function selectRecords($query,$vals, $type,$count = true){
        try {
    
          $result = $this->_prepare($query);
            if ($result != null) {
                $this->statement->execute($vals);
                switch ($type) {
                    case 'all':
                        # code...

                            $result = $this->statement->fetchAll(PDO::FETCH_BOTH);
                        break;

                    case 'num':
                        # code...
                            $result = $this->statement->fetch(PDO::FETCH_NUM);
                        break;
                    
                    case 'obj':
                        # code...
                            $result = $this->statement->fetchAll(PDO::FETCH_OBJ);
                        break;
                    default:
                        # code...
                            $result = $this->statement->fetch(PDO::FETCH_ASSOC);
                        break;
                }
                $this->count = $this->statement->rowCount();
            }else{
               echo $this->err();
            }
          

            
        }catch(PDOException $e){

            echo $e->getMessage();
            
        }
    
     return $result;

     }


}