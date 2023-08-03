<? 

class ErrorHandler {
    private $debug = true;
    public function __constructor() {}

    public function errorAndDie($msg) {
        //logolja a hibát
        $this->writeLog($msg);
        
        if(!$this->debug) {
            $msg = 'Szerver oldali hiba!';
        }

        die($msg);
    }

    public function writeLog($string, $sql = null) {
        $logStr = $string;

        if($sql !== null) {
            $logStr .= " -- SQL QUERY: " . $sql;
        }

        $log = fopen("log/errorlog.txt", "a");
        fwrite($log, $logStr);
        fclose($log);
    }
}

?>