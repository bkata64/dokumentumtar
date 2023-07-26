<? 
include_once('Application.php');

class Publishers extends Application {

    private $sql = array(
        'allPublishers' => "SELECT id, name FROM publishers" ,   
        'publisherById' => "SELECT id, name FROM publishers WHERE id = {id}"
    );

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
}


?>