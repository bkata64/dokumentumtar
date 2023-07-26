<? 
include_once('Application.php');

class Roles extends Application {

    private $sql = array(
        'allRoles' => "SELECT id, name FROM roles" ,   
        'roleById' => "SELECT id, name FROM roles WHERE id = {id}"
    );

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
}


?>