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
            <div class="col-lg-7" id="lista">
                <form class="my-4 pt-4 pb-2">
                    <input type="search" name="category" id="category" placeholder="kategória">
                    <input type="search" name="title" id="title" placeholder="cím">
                    <button type="button" name="submit" id="submit" class="btn btn-info btn-sm search">&#128269; Keresés</button>
                    <button type="reset" name="reset" id="reset" class="btn btn-danger btn-sm cancel rejtett">&#9938; Mégse</button>
                </form>
                
                <table class="table table-striped">
                    <tr>
                        <th>Cím</th>
                        <th>Kategóriák</th>
                        <th>Kiadta</th>
                        <th>Rövid szöveg</th>
                    </tr>
                    <? foreach ($object->getDocuments() as $key => $document) { ?>
                        <tr>
                            <td><a href="detail.php?document=<?= $document['id'] ?>"><?= $document['title'] ?></a></td>
                            <td><?= $document['category'] ?></td>
                            <td><?= $document['publisher'] ?></td>
                            <td><?= $document['short_text'] ?></td>
                        </tr>
                    <? } ?>                    
                    <tr>
                        <td colspan="4" class="text-center">Összesen megjelenítve <?=count($object->getDocuments()) ?> dokumentum</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-5 p-0" id="reszletek">
                <header class="mr-5">
                    <h2 class="mb-3 bg-secondary p-2">Dokumentum részletes nézete</h2>
                    <div class="px-3">
                        <span><img src="" alt="doku logo"></span>
                        <span class="float-end">kategória1, kategória2</span>
                    </div>
                </header>
                <div class="p-4 mr-2">
                    <h3>Dokumentum címe</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio aspernatur nemo tempora perferendis saepe, unde quod doloremque! Ipsam, est. Ipsam ad magni nobis. Mollitia, eveniet earum in magni error vel.</p>
                    <p>Laboriosam maxime voluptatem soluta minus quos esse eum, id optio quis corrupti dolores officiis odit debitis unde vel odio quia cum nesciunt, in similique veniam minima. Nobis laborum ut at?</p>
                    <p>Vitae, omnis id! Nihil optio sunt provident sint laudantium, modi, sit nemo fugit officiis atque magni enim inventore doloremque tempore corrupti quas iste alias culpa quam aspernatur similique omnis facilis.</p>
                    <p>Beatae aliquid doloremque dolorem saepe veritatis sequi provident error impedit nostrum ullam, minus cupiditate quos odit sapiente dicta tenetur illo architecto cum illum. Error officia dolores, qui itaque repellendus facilis.</p>
                    <p>Exercitationem, adipisci nisi reiciendis nostrum voluptate architecto iste, nihil incidunt sit eligendi eos modi, sunt earum totam laboriosam quibusdam beatae aliquam doloremque saepe ratione dignissimos. Fugit, sed nulla. Repudiandae, a!</p>
                    <p class="text-end" id="author">Szerző neve</p>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>