<? 
include_once('Application.php');

class Categories extends Application {

    private $sql = array(
        'allCategories' => "SELECT id, name FROM categories WHERE active=1" ,   
        'categoryById' => "SELECT id, name FROM categories WHERE id = {id} and active=1"
    );

    private $messages = array();

    protected $table = 'categories';
    protected $fields = array('id', 'name');

    public function __construct() {
        parent::__construct();        
    }

    public function getCategories() {
        $categories = $this->getResultList($this->sql['allCategories']);
        return $categories;
    }

    public function getCategoryById($id) {
        if(!$this->isValidId($id)) {
            return array();
        }
        $params = array(
            '{id}' => $id
        );
        $category= $this->getSingleResult(strtr($this->sql['categoryById'], $params));
        return $category;
    }

    public function delete($id) {
        if(!$this->isValidId($id)) {
            return false;
        }
        $res = $this->deleteRekordById("categories", $id);
        return $res;
    }

    public function save($category) {
        if(!$this->validation($category)) {
            $this->writeLog("\nA kapott adatsor invalid! <br>".implode('<br>', $this->messages));
            $this->msg->setSessionMessage('A form kitöltése nem megfelelő! <br>'.implode('<br>', $this->messages));            
            return null;
        } 
        if(isset($category['id']) && !empty($category['id'])) {
            if($this->isValidId(intval($category['id']))) {
                $this->id = intval($category['id']);                           
                $res = $this->modify($category);               
            } else {
                $this->writeLog("\nA kapott id invalid: {$category['id']}");
                $this->msg->setSessionMessage("\nA kapott id invalid: {$category['id']}");
            }
        } else {           
            $res = $this->create($category);  
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