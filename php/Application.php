<?

include_once('debug.php');

class Application {
    private $dbParams = array(
        'servername' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'documents'
    );

    private $connection;
    private $connectionLive = false;
    
    protected $template = '';

    public function __construct() {
        $this->connectDb();
    }

    public function getTemplate() {
        return $this->template;
    }

    private function connectDb() {
        $this->connection = new mysqli($this->dbParams['servername'], $this->dbParams['username'], $this->dbParams['password'], $this->dbParams['dbname']);
        if($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        $this->connectionLive = true;
    }

    protected function isDbConnectionLive() {
        return $this->connectionLive;
    }

    protected function getResultList($sql) {
        $resultList = array();
        $result = $this->connection->query($sql);
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultList[] = $row;
            }            
        } else {
            $this->writeLog("nem talált értéket a lekérdezés", $sql);
        }
        return $resultList;
    }

    protected function getSingleResult($sql) {
        $resultList = $this->getResultList($sql);
        if(!$resultList) {
            $this->writeLog("nem talált értéket a lekérdezés", $sql);
            return array();
        } else {
            return $resultList[0];
        }
    }

    public function writeLog($string, $sql = null) {
        $logStr = $string;

        if($sql !== null) {
            $logStr .= " -- SQL QUERY: " . $sql;
        }

        $log = fopen("log/log.txt", "a");
        fwrite($log, $logStr);
        fclose($log);
    }

    protected function isValidId($id) {
        if(is_int($id) && $id > 0) {
            return true;
        } else {
            return false;
        }
    }


    protected function deleteRekordById($table, $id) {
        $result = $this->connection->query("delete from $table where id = $id");
        return $result;
    }
    
}

?>