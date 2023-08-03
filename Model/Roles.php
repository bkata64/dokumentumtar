<? 
include_once('Application.php');

class Roles extends Application {

    private $sql = array(
        'allRoles' => "SELECT id, name FROM roles WHERE active=1" ,   
        'roleById' => "SELECT id, name FROM roles WHERE id = {id} and active=1"
    );

    private $messages = array();

    protected $table = 'roles';
    protected $fields = array('id', 'name');

    public function __construct() {
        parent::__construct();        
    }

    public function getRoles() {
        $roles = $this->getResultList($this->sql['allRoles']);
        return $roles;
    }

    public function getRoleById($id) {
        if(!$this->isValidId($id)) {
            return array();
        }
        $params = array(
            '{id}' => $id
        );
        $role= $this->getSingleResult(strtr($this->sql['roleById'], $params));
        return $role;
    }

    public function delete($id) {
        if(!$this->isValidId($id)) {
            return false;
        }
        $res = $this->deleteRekordById("roles", $id);
        return $res;
    }

    public function save($role) {
        if(!$this->validation($role)) {
            $this->writeLog("\nA kapott adatsor invalid! <br>".implode('<br>', $this->messages));
            $this->msg->setSessionMessage('A form kitöltése nem megfelelő! <br>'.implode('<br>', $this->messages));            
            return null;
        } 
        if(isset($role['id']) && !empty($role['id'])) {
            if($this->isValidId(intval($role['id']))) {
                $this->id = intval($role['id']);                           
                $res = $this->modify($role);               
            } else {
                $this->writeLog("\nA kapott id invalid: {$role['id']}");
                $this->msg->setSessionMessage("\nA kapott id invalid: {$role['id']}");
            }
        } else {           
            $res = $this->create($role);  
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