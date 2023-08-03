<? 
include_once('Application.php');

class Publishers extends Application {

    private $sql = array(
        'allPublishers' => "SELECT id, name FROM publishers WHERE active=1" ,   
        'publisherById' => "SELECT id, name FROM publishers WHERE id = {id} and active=1"
    );

    private $messages = array();

    protected $table = 'publishers';
    protected $fields = array('id', 'name');

    public function __construct() {
        parent::__construct();        
    }

    public function getPublishers() {
        $publishers = $this->getResultList($this->sql['allPublishers']);
        return $publishers;
    }

    public function getPublisherById($id) {
        if(!$this->isValidId($id)) {
            return array();
        }
        $params = array(
            '{id}' => $id
        );
        $publisher= $this->getSingleResult(strtr($this->sql['publisherById'], $params));
        return $publisher;
    }

    public function delete($id) {
        if(!$this->isValidId($id)) {
            return false;
        }
        $res = $this->deleteRekordById("publishers", $id);
        return $res;
    }

    public function save($publisher) {
        if(!$this->validation($publisher)) {
            $this->writeLog("\nA kapott adatsor invalid! <br>".implode('<br>', $this->messages));
            $this->msg->setSessionMessage('A form kitöltése nem megfelelő! <br>'.implode('<br>', $this->messages));            
            return null;
        } 
        if(isset($publisher['id']) && !empty($publisher['id'])) {
            if($this->isValidId(intval($publisher['id']))) {
                $this->id = intval($publisher['id']);                           
                $res = $this->modify($publisher);               
            } else {
                $this->writeLog("\nA kapott id invalid: {$publisher['id']}");
                $this->msg->setSessionMessage("\nA kapott id invalid: {$publisher['id']}");
            }
        } else {           
            $res = $this->create($publisher);  
            if($res) {
                $this->id = $this->getLastInsertedId();                                       
            }  
        }    
        return $this->id;
    }

    protected function validation($data) {
        if(!isset($data['name']) || empty($data['name']) || $data['name'] == null) {
            $this->messages[] = 'A név mező kitöltése kötelező!';
            return false;
        }
    
        if(!is_string($data['name']))  {
            $this->messages[] = 'A név csak szöveg lehet!';
            return false;
        }
    
        if(strlen($data['name']) > 50) {
            $this->messages[] = 'A név hossza nem haladhatja meg az 50 karaktert!';
            return false;
        }

        return true;
    }
}


?>