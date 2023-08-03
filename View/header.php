<header class="container-fluid">       
    <div class="row p-3 bg-secondary">
        <? 
            $adminGomb = "<br><button type='button' id='menu' style='margin: 10px 0 0 0; border-radius: 20px 0;'>Admin menü &#8615;</button>";
            $visszaGomb = "<br><button type='button' id='vissza' style='margin: 10px 0 0 0; border-radius: 20px 0;'>Főoldal &#8612;</button>";
            $gomb = '';
            if($_SESSION['user'] && $_SESSION['user']['role'] == 'admin') {
                $gomb = ($this->template == 'frontend') ? $adminGomb : " - admin" . $visszaGomb;
            } else {
                $gomb = '';
            }    
        ?>
        <h1 class="col-4 col-sm-7 col-lg-8 mb-0">Dokumentum tár<?= $gomb ?></h1>
        <div class="col-8 col-sm-5 col-lg-4">
            <span class="float-end"> 
                <? 
                    if(!empty($_SESSION['user'])) { ?> 
                        <img src='Sources/uploads/<?= ($_SESSION['user']['avatar']) ?>' class='userimg'  alt='<?= $_SESSION['user']['name'] ?>' title='<?= $_SESSION['user']['name'] ?>'>
                        <span id="user"><?= $_SESSION['user']['name'] ?></span>
                        <a href="?userhandler/logout"><img src="Sources/img/logout.png" alt="kilépés" title="kilépés"></a>
                    <? } else { ?> 
                        <span id="user">Nincs bejelentkezve...</span>
                        <a href="?userhandler/login"><img src="Sources/img/login.png" alt="belépés" title="belépés"></a>
                    <?}
                ?> 
            </span>                
        </div>            
    </div>          
</header>