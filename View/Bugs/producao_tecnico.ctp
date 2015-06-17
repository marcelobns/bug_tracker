<div class="report col-md-8">
    <legend>Produção por Técnico <span class="no-display print"><?=@$_GET['from']?> à <?=@$_GET['to']?></span></legend>
    <form class="no-print">
        <fieldset>
            <div class="input text required col-md-5">
                <label for="from">De</label>
                <input type="text" id="from" name="from" required value="<?=@$_GET['from']?>">
            </div>
            <div class="input text required col-md-5">
                <label for="to">até</label>
                <input type="text" id="to" name="to" required value="<?=@$_GET['to']?>">
            </div>
            <button type="submit" class="btn btn-primary" style="margin: 20px 13px;">Filtrar</button>
        </fieldset>
    </form>
    <table class="table">
    <?php foreach($producao as $i=>$value) : ?>
        <tr>
            <td><?=$value[0]['tecnico']?></td>
            <td><?=$value[0]['qtd']?></td>
        </tr>
    <?php endforeach  ?>
    </table>
</div>
