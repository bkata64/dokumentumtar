<table class="table table-striped">
    <tr>
        <th>Cím</th>
        <th>Kategóriák</th>
        <th>Kiadta</th>
        <th>Rövid szöveg</th>
    </tr>
    <? foreach ($documents as $key => $document) { ?>
        <tr>
            <td class="document-row" document="<?= $document['id'] ?>"><?= $document['title'] ?></td>
            <td><?= $document['category'] ?></td>
            <td><?= $document['publisher'] ?></td>
            <td><?= $document['short_text'] ?></td>
        </tr>
    <? } ?>                    
    <tr>
        <td colspan="4" class="text-center">Összesen megjelenítve <?=count($documents) ?> dokumentum</td>
    </tr>
</table>
<!-- <script src="Sources/js/script.js"></script> -->
<script src="Sources/js/content_script.js"></script>
