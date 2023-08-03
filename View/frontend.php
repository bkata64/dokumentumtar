<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentumtár</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="Sources/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="Sources/js/script.js"></script>
</head>
<body>
    <? include_once('header.php'); ?>
    <main class="container-fluid">
        <div id="menu_panel">
            <? $active = 'Listák'; include_once('admin/menu.php'); ?>
        </div>
        <div class="row">
            <div class="col-lg-7" id="lista">
                <form class="my-4 pt-4 pb-2">
                    <? $msg->messages(); ?>
                    <input type="search" name="search-category" id="category" placeholder="kategória">
                    <input type="search" name="search-title" id="title" placeholder="cím">
                    <button type="button" name="submit" id="search" class="btn btn-info btn-sm search">&#128269; Keresés</button>
                    <button type="reset" name="reset" id="cancel" class="btn btn-danger btn-sm cancel rejtett">&#9938; Mégse</button>
                </form>
                <div id='table-content'>
                    <? include_once('View/table_view.php'); ?>
                </div>
            </div>
            <div class="col-lg-5 p-0" id="reszletek">
                <? 
                    $document = $documents[0];
                    include_once('View/detail.php');
                ?>
            </div>            
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>