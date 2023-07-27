<? 

class Messages {
    private $message = array();
    private $type = '';

    public function __construct() {

    }

    public function setErrorMsg($str) {
        $this->message[] = $str;
        $this->type = 'error_msg';
    }

    public function messages() {
        if(!empty($this->message)) {
            echo "<div class='{$this->type} msg'>" . implode("<br>", $this->message) . "</div>";
        }
    }
}

?>