<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentumtár</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="Sources/css/style.css">
    <link rel="stylesheet" href="Sources/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="Sources/js/script.js"></script>
    <script src="Sources/js/admin_script.js"></script>
</head>
<body>    
    <? include_once('View/header.php'); ?>
    <main class="container-fluid">
        <div class="row">            
            <? $active = "Listák"; include_once('menu.php'); ?>
            <div class="col-sm-5">
                <h3>Kategóriák</h3>
                <button type="button" onclick="location.href='?archives/category';">Új kategória</button>
                <table class="table table-striped">
                    <tr>
                        <th>Kategória</th>
                        <th class="text-center">Funkciók</th>
                    </tr>
                    <? foreach ($categories as $key => $category) { ?>
                        <tr>
                            <td><?= $category['name'] ?></td>
                            <td class="functions">
                                <a href="?archives/category/<?= $category['id'] ?>"><img src="Sources/img/edit.png" alt="módosítás" title="módosítás"></a>
                                <a href="#" class="delete_rec" table="Categories" rec_id="<?= $category['id'] ?>"><img src="Sources/img/delete.png" alt="törlés" title="törlés"></a>
                            </td>
                        </tr>
                    <? } ?>                    
                </table>
            </div>
            <div class="col-sm-5">
                <h3>Kiadók</h3>
                <button type="button" onclick="location.href='?archives/publisher';">Új kiadó</button>
                <table class="table table-striped">
                    <tr>
                        <th>Név</th>
                        <th class="text-center">Funkciók</th>
                    </tr>
                    <? foreach ($publishers as $key => $publisher) { ?>
                        <tr>
                            <td><?= $publisher['name'] ?></td>
                            <td class="functions">
                                <a href="?archives/publisher/<?= $publisher['id'] ?>"><img src="Sources/img/edit.png" alt="módosítás" title="módosítás"></a>
                                <a href="#" class="delete_rec" table="Publishers" rec_id="<?= $publisher['id'] ?>"><img src="Sources/img/delete.png" alt="törlés" title="törlés"></a>
                            </td>
                        </tr>
                    <? } ?>                    
                </table>
            </div>
        </div>
    </main>
</body>
</html>