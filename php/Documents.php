<? 
include_once('Application.php');

class Documents extends Application {

    private $sql = array(
        'allDocuments' => "SELECT title, group_concat(c.name SEPARATOR ', ') AS category, p.name AS publisher, short_text 
                            FROM documents d 
                            LEFT JOIN publishers p ON p.id = d.publisher_id 
                            LEFT JOIN categories_documents cd ON cd.document_id = d.id 
                            LEFT JOIN categories c ON c.id = cd.category_id
                            GROUP BY d.title;"
    );

    public function __construct() {
        parent::__construct();
        // if($this->isDbConnectionLive()) {
        //     echo 'db kapcsolat él';
        // } else {
        //     echo 'db kapcsolat nincs meg';
        // }

        // debug($this->getResultList("select * from documents"));
    }

    public function getDocuments() {
        $documents = $this->getResultList($this->sql['allDocuments']);
        return $documents;
    }
}


?>