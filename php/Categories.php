<? 
include_once('Application.php');

class Categories extends Application {

    private $sql = array(
        'allCategories' => "SELECT id, name FROM categories" ,   
        'CategoryById' => "SELECT id, name FROM categories WHERE id = {id}"
    );

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
}


?>