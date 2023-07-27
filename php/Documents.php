<? 
include_once('Application.php');

class Documents extends Application {

    private $sql = array(
        'allDocuments' => "SELECT d.id, title, group_concat(c.name SEPARATOR ', ') AS category, p.name AS publisher, short_text, content, coalesce(r.name, 'bárki') AS role
                            FROM documents d 
                            LEFT JOIN publishers p ON p.id = d.publisher_id 
                            LEFT JOIN categories_documents cd ON cd.document_id = d.id 
                            LEFT JOIN categories c ON c.id = cd.category_id
                            LEFT JOIN roles r ON r.id = d.role_id
                            GROUP BY d.title;",
        'documentById' => "SELECT d.id, title, group_concat(c.name SEPARATOR ', ') AS category, p.name AS publisher, short_text, logo_url, content, r.name AS role
                            FROM documents d 
                            LEFT JOIN publishers p ON p.id = d.publisher_id 
                            LEFT JOIN categories_documents cd ON cd.document_id = d.id 
                            LEFT JOIN categories c ON c.id = cd.category_id
                            LEFT JOIN roles r ON r.id = d.role_id
                            WHERE d.id = {id}
                            GROUP BY d.title
                            LIMIT 1;"
    );

    public function __construct() {
        parent::__construct();       
    }

    public function index() {
        $this->template = 'frontend';
    }

    public function backend() {
        $this->template = 'admin/dokumentumok';
    }

    public function getDocuments() {
        $documents = $this->getResultList($this->sql['allDocuments']);
        return $documents;
    }

    public function getDocumentById($id) {
        if(!$this->isValidId($id)) {
            return array();
        }
        $params = array(
            '{id}' => $id
        );

        $document = $this->getSingleResult(strtr($this->sql['documentById'], $params));
        return $document;
    }

    public function delete($id) {
        if(!$this->isValidId($id)) {
            return false;
        }
        $res = $this->deleteRekordById("documents", $id);
        return $res;
    }
}


?>