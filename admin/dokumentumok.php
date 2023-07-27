

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentumtár</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../js/admin_script.js"></script>
</head>
<body>
    <header class="container-fluid">       
        <div class="row p-3 bg-secondary">
            <h1 class="col-4 col-sm-7 col-lg-8 mb-0">Dokumentum tár - admin</h1>
            <div class="col-8 col-sm-5 col-lg-4">
                <span class="float-end">
                    <img src="" alt="avatar">
                    <span id="user">Felhasználó neve</span>
                    <a href="index.html"><img src="img/logout.png" alt="kilépés" title="kilépés"></a>
                </span>
                
            </div>            
        </div>          
    </header>
    <main class="container-fluid">
        <div class="row">
            <div class="col-6 col-sm-2" id="navigacio">
                <h2 class="mb-0 bg-secondary p-2">Menü</h2>
                <nav class="navbar pt-0">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                          <a class="nav-link" href="listak.php" >Listák</a>                          
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="kategoria_form.php">Új kategória</a>
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="kiado_form.php">Új kiadó</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="dokumentumok.php">Dokumentumok</a>                            
                        </li>
                        <li class="nav-item text-end">                            
                            <a class="nav-link" href="dokumentum_form.php">Új dokumentum</a>                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="felhasznalok.php">Felhasználók</a>                            
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="felhasznalo_form.php">Új felhasználó</a>
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="jogosultsag_form.php">Új jogosultság</a>
                        </li>
                    </ul>
                </nav>
                  
            </div>
            <div class="col-sm-10">
                <h3>Dokumentumok</h3>

                <form class="mb-3 pb-4">
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
                        <th>Jogosultság</th>
                        <th class="text-center">Funkciók</th>
                    </tr>
                    <? foreach ($object->getDocuments() as $key => $document) { ?>
                        <tr>
                            <td><?= $document['title'] ?></td>
                            <td><?= $document['category'] ?></td>
                            <td><?= $document['publisher'] ?></td>
                            <td><?= $document['short_text'] ?></td>
                            <td><?= $document['role'] ?></td>
                            <td class="functions">
                                <a href="dokumentum_form.php?document=<?= $document['id'] ?>"><img src="img/edit.png" alt="módosítás" title="módosítás"></a>
                                <a href="#" class="delete_rec" table="documents" rec_id="<?= $document['id'] ?>"><img src="img/delete.png" alt="törlés" title="törlés"></a>
                            </td>
                            
                        </tr>
                    <? } ?>              
                </table>                
            </div>            
        </div>
    </main>
</body>
</html>