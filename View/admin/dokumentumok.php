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
            <? $active = "Dokumentumok"; include_once('menu.php'); ?>
            <div class="col-sm-10">
                <h3>Dokumentumok</h3>

                <form class="mb-3 pb-4">
                    <input type="search" name="search-category" id="category" placeholder="kategória">
                    <input type="search" name="search-title" id="title" placeholder="cím">
                    <button type="button" name="submit" id="admin_search" class="btn btn-info btn-sm search">&#128269; Keresés</button>
                    <button type="reset" name="reset" id="admin_cancel" class="btn btn-danger btn-sm cancel rejtett">&#9938; Mégse</button>
                </form>
                <button type="button" onclick="location.href='?archives/document';">Új dokumentum</button>
                <div id="admin-table-content">
                    <? include_once('admin_table_view.php'); ?>
                </div>     
            </div>            
        </div>
    </main>
</body>
</html>