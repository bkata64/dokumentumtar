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
                            WHERE d.active = 1 
                            GROUP BY d.title
                            {having};",                            
        'documentById' => "SELECT d.id, title, group_concat(c.name SEPARATOR ', ') AS category, group_concat(c.id SEPARATOR ', ') AS category_ids, d.publisher_id, p.name AS publisher, short_text, logo_url, content, d.role_id, r.name AS role
                            FROM documents d 
                            LEFT JOIN publishers p ON p.id = d.publisher_id 
                            LEFT JOIN categories_documents cd ON cd.document_id = d.id 
                            LEFT JOIN categories c ON c.id = cd.category_id
                            LEFT JOIN roles r ON r.id = d.role_id
                            WHERE d.id = {id} and d.active = 1
                            GROUP BY d.title
                            LIMIT 1;",
        'documentsByFilter'=> "SELECT d.id, title, group_concat(c.name SEPARATOR ', ') AS category, p.name AS publisher, short_text, content, coalesce(r.name, 'bárki') AS role
                            FROM documents d 
                            LEFT JOIN publishers p ON p.id = d.publisher_id 
                            LEFT JOIN categories_documents cd ON cd.document_id = d.id 
                            LEFT JOIN categories c ON c.id = cd.category_id
                            LEFT JOIN roles r ON r.id = d.role_id
                            WHERE d.active = 1 and lower(d.title) like '%{title}%'
                            GROUP BY d.title
                            HAVING lower(category) like '%{cat}%'{having};"
    );

    private $messages = array();

    protected $table = 'documents';
    protected $fields = array('id', 'title', 'short_text', 'logo_url', 'content', 'role_id', 'publisher_id');

    public function __construct() {
        parent::__construct();       
    }   

    public function getDocuments() {
        $params = array('{having}' => "HAVING role = 'bárki'");
        if($_SESSION['user']) {
            if($_SESSION['user']['role'] == 'admin') {
                $params = array('{having}' => "");
            } else {
                $params = array('{having}' => "HAVING role = 'bárki' OR role = '" . $_SESSION['user']['role'] . "'");
            }
        }        
        $documents = $this->getResultList(strtr($this->sql['allDocuments'], $params));
        return $documents;
    }

    public function getDocumentsFilter($title, $cat) {
        if(strlen($title) >255 || strlen($cat) >50) {
            return false;
        }
        $params = array('{title}' => strtolower($title), '{cat}' => strtolower($cat));
        $params['{having}'] = " AND role = 'bárki'";
        if($_SESSION['user']) {
            if($_SESSION['user']['role'] == 'admin') {
                $params['{having}'] = "";
            } else {
                $params['{having}'] = " AND role = 'bárki' OR role = '" . $_SESSION['user']['role'] . "'";
            }
        }    
        $documents = $this->getResultList(strtr($this->sql['documentsByFilter'], $params));
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

    public function save($document) {
         if(!$this->validation($document)) {
            $this->writeLog("\nA kapott adatsor invalid! <br>".implode('<br>', $this->messages));
            $this->msg->setSessionMessage('A form kitöltése nem megfelelő! <br>'.implode('<br>', $this->messages));            
            return null;
        } 

        if(isset($document['id']) && !empty($document['id'])) {
            if($this->isValidId(intval($document['id']))) {
                $this->id = intval($document['id']);
                $filename = $this->fileUpload();

                if($filename) {
                    $document['logo_url'] = $filename;
                }                
                $res = $this->modify($document);
                $this->saveCategory($document);
            } else {
                $this->writeLog("\nA kapott id invalid: {$document['id']}");
                $this->msg->setSessionMessage("\nA kapott id invalid: {$document['id']}");
            }
        } else {
            $filename = $this->fileUpload();
            $document['logo_url'] = $filename ? $filename : '';
            $res = $this->create($document);  
            if($res) {
                $this->id = $this->getLastInsertedId();
                $this->saveCategory($document);                        
            }  
        }      
         
        return $this->id;
    }

    private function fileUpload() {
        echo $_FILES['kep']['tmp_name'];
        if(isset($_FILES) && !empty($_FILES['kep']['tmp_name'])) {
           $targetDir = "Sources/uploads/";
           $targetFile = $targetDir . basename($_FILES['kep']['name']);

           $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

           $check = getimagesize($_FILES['kep']['tmp_name']);
           if($check !== false) {
                // if(file_exists($targetFile)) {
                //     $this->msg->setSessionMessage('A fájl már létezik!');
                //     return false;
                // }

                if($_FILES['kep']['size'] > 500000) {
                    $this->msg->setSessionMessage('A fájl túl nagy!');
                    return false;
                }

                if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
                    $this->msg->setSessionMessage('A megengedett képformátumok: JPG, JPEG, PNG vagy GIF.');
                    return false;
                }

                if(move_uploaded_file($_FILES['kep']['tmp_name'], $targetFile)) {
                    $filename = basename($_FILES['kep']['name']);
                    return $filename;
                } else {
                    $this->msg->setSessionMessage('A fájl áthelyezése sikertelen!');
                    return false;
                }

           } else {
            $this->msg->setSessionMessage('A feltöltött fájl nem kép!');
            return false;
           }
        }
        return false;
    }

    private function saveCategory($document) {
        $sql = "delete from categories_documents where document_id = {$this->id}";
        $this->execute($sql); 
        $categories = array();
        foreach ($document as $key => $value) {
            if($key == 'kategoria') {
                $keys = array_keys($value);
                foreach ($keys as $catId) {
                    $categories[] = "($catId, {$this->id})";
                }
            }
        }
        $sql = "INSERT INTO categories_documents(category_id, document_id) VALUES " . implode(', ', $categories);
        //echo $sql;
        $this->execute($sql);
    }

    /** override */
    protected function validation($data) {        
        if(!isset($data['title']) || empty($data['title']) || $data['title'] == null) {
            $this->messages[] = 'A cím mező kitöltése kötelező!';
            return false;
        }

        if(!is_string($data['title']))  {
            $this->messages[] = 'A cím csak szöveg lehet!';
            return false;
        }

        if(strlen($data['title']) > 255) {
            $this->messages[] = 'A cím hossza nem haladhatja meg a 255 karaktert!';
            return false;
        }

        if(!isset($data['short_text']) || empty($data['short_text']) || $data['short_text'] == null) {
            $this->messages[] = 'A rövid szöveg mező kitöltése kötelező!';
            return false;
        }

        if(!is_string($data['short_text']))  {
            $this->messages[] = 'A rövid szöveg csak szöveg lehet!';
            return false;
        }

        if(strlen($data['short_text']) > 255) {
            $this->messages[] = 'A rövid szöveg hossza nem haladhatja meg a 255 karaktert!';
            return false;
        }

        if(!is_string($data['content']))  {
            $this->messages[] = 'A tartalom csak szöveg lehet!';
            return false;
        }

        if(strlen($data['content']) > 65535) {
            $this->messages[] = 'A tartalom hossza nem haladhatja meg a 65535 karaktert!';
            return false;
        }

        if(!is_numeric($data['publisher_id'])) {
            $this->messages[] = 'A kiadó azonosítója nem szám típusú!';
            return false;
        } else {
            $kiado = intval($data['publisher_id']);
            if(!$this->existing('publishers', $kiado)) {
                $this->messages[] = 'Nincs ilyen kiadó!';
                return false;
            }
        }

        if(!is_numeric($data['role_id'])) {
            $this->messages[] = 'Az jogosultság azonosítója nem szám típusú!';
            return false;
        } else {
            $jog = intval($data['role_id']);
            if(!$this->existing('roles', $jog)) {
                $this->messages[] = 'Nincs ilyen jogosultság!';
                return false;
            }
        }
            
        
        
        $kategoria = null;
        foreach ($data as $key => $value) {
            if($key == 'kategoria') {
                $keys = array_keys($value);
                foreach ($keys as $catId) {                   
                    $kategoria = intval($key);
                    if(!$this->existing('categories', $kategoria)) {
                            $this->messages[] = 'Nincs ilyen kategória!';
                            return false;
                        }
                }
            }
        }        
        return true;
    }

    private function existing($table, $id) {
       if($this->existingRekordById($table, $id)) {
        return true;
       }
       return false;
    }
}


?>