<? 
include_once('php/Documents.php');

$documents = new Documents();
$document = $documents->getDocumentById(intval($_GET['document']));

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentumtár</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <header class="container-fluid">       
        <div class="row p-3 bg-secondary">
            <h1 class="col-4 col-sm-7 col-lg-8 mb-0">Dokumentum tár</h1>
            <div class="col-8 col-sm-5 col-lg-4">
                <span class="float-end">
                    <img src="" alt="avatar">
                    <span id="user">Felhasználó neve</span>
                    <a href="admin/login.html"><img src="img/login.png" alt="belépés" title="belépés"></a>
                </span>
                
            </div>            
        </div>          
    </header>
    <main class="container-fluid">
        <div class="row">
        <div class="col-lg-5 offset-4 p-0" id="reszletek">
                <header class="mr-5">               
                    <h2 class="mb-3 bg-secondary p-2">Dokumentum részletes nézete</h2>
                    <div class="px-3">
                        <span><img src="" alt="<?= $document['title'] ?>" title="<?= $document['title'] ?>"></span>
                        <span class="float-end"><?= $document['category'] ?></span>
                    </div>
                </header>
                <div class="p-4 mr-2">
                    <h3><?= $document['title'] ?></h3>
                    <p><?= $document['content'] ?></p>
                    
                    <p class="text-end" id="author"><?= $document['publisher'] ?></p>
                </div>
            </div>
        </div>
    </main>
    
</body>
</html>