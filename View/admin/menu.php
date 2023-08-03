<div class="col-6 col-sm-2" id="navigacio">
    <h2 class="mb-0 bg-secondary p-2">Menü</h2>
    <nav class="navbar pt-0">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link<?= ($active == "Listák") ? ' active' : '' ?>" href="?archives/backend/" >Listák</a>                          
            </li>
            <li class="nav-item text-end">
                <a class="nav-link<?= ($active == "Új kategória") ? ' active' : '' ?>" href="?archives/category">Új kategória</a>
            </li>
            <li class="nav-item text-end">
                <a class="nav-link<?= ($active == "Új kiadó") ? ' active' : '' ?>" href="?archives/publisher">Új kiadó</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= ($active == "Dokumentumok") ? ' active' : '' ?>" href="?archives/backend_doku/">Dokumentumok</a>                            
            </li>
            <li class="nav-item text-end">                            
                <a class="nav-link<?= ($active == "Új dokumentum") ? ' active' : '' ?>" href="?archives/document">Új dokumentum</a>                            
            </li>
            <li class="nav-item">
                <a class="nav-link<?= ($active == "Felhasználók") ? ' active' : '' ?>" href="?archives/backend_user/">Felhasználók</a>                            
            </li>
            <li class="nav-item text-end">
                <a class="nav-link<?= ($active == "Új felhasználó") ? ' active' : '' ?>" href="?archives/user">Új felhasználó</a>
            </li>
            <li class="nav-item text-end">
                <a class="nav-link<?= ($active == "Új jogosultság") ? ' active' : '' ?>" href="?archives/role">Új jogosultság</a>
            </li>
        </ul>
    </nav>        
</div>