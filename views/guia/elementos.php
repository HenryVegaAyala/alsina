<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
        <tr>
            <th>N°</th>
            <th>Código</th>
            <th>Elementos</th>
            <th>P.U x día</th>
            <th>Peso Real</th>
            <th>Peso Vol.</th>
            <th>Ud.</th>
            <th>Peso R. T.</th>
            <th>Cant. Dias</th>
            <th>Costo T.</th>
            <th>Peso V. T.</th>
        </tr>
        </thead>
        <?php
        $connection = \Yii::$app->db;
        $sqlStatement = '
        SELECT COD_MAE_PRODU,COD_MAE_CATG,NUM_PROD, DESC_CORTAR, PREC_X_DIA, PESO_REAL, PESO_VOL, UD, PESO_REAL_TOTAL, CANT_DIAS, COST_TOTAL, PESO_V_TOTAL
        FROM mae_produ
        WHERE COD_ESTA = 1 AND COD_MAE_CATG = "' . $id . '" ORDER BY DESC_CORTAR ASC ;';
        $comando = $connection->createCommand($sqlStatement);
        $resultado = $comando->query();
        ?>
        <tbody>
        <?php
        $i = 0;
        while ($row = $resultado->read()):
            ?>
            <tr>
                <td><?= $i+1 ?></td>
                <td style="display: none">
                    <input type='text' value='<?= $row['COD_MAE_CATG']; ?>'     id='COD_MAE_CATG<?= $i ?>'      name='COD_MAE_CATG[]' class='form-control input' readonly/>
                </td>
                <td style="display: none">
                    <input type='text' value='<?= $row['COD_MAE_PRODU']; ?>'     id='COD_MAE_PRODU<?= $i ?>'      name='COD_MAE_PRODU[]' class='form-control input' readonly/>
                </td>
                <td><input type='text' value='<?= $row['NUM_PROD']; ?>'         id='NUM_PROD_<?= $i ?>'         name='NUM_PROD[]' size='7' class='form-control input' readonly/></td>
                <td><input type='text' value='<?= $row['DESC_CORTAR']; ?>'      id='DESC_CORTAR_<?= $i ?>'      name='DESC_CORTAR[]' size='50' class='form-control input' readonly/></td>
                <td><input type='text' value='<?= $row['PREC_X_DIA']; ?>'       id='PREC_X_DIA_<?= $i ?>'       name='PREC_X_DIA[]' onkeyup="CalcularPesoRealTotal()" size='3' class='form-control input'/></td>
                <td><input type='text' value='<?= $row['PESO_REAL']; ?>'        id='PESO_REAL_<?= $i ?>'        name='PESO_REAL[]' size='2' class='form-control input' readonly/></td>
                <td><input type='text' value='<?= $row['PESO_VOL']; ?>'         id='PESO_VOL_<?= $i ?>'         name='PESO_VOL[]' size='3' class='form-control input' readonly/></td>
                <td><input type='text' value='<?= $row['UD']; ?>'               id='UD_<?= $i ?>'               name='UD[]' size='3' onkeyup="CalcularPesoRealTotal()"  class='form-control input'/></td>
                <td><input type='text' value='<?= $row['PESO_REAL_TOTAL']; ?>'  id='PESO_REAL_TOTAL_<?= $i ?>'  name='PESO_REAL_TOTAL[]' size='3' class='form-control input' readonly/></td>
                <td><input type='text' value='<?= $row['CANT_DIAS']; ?>'        id='CANT_DIAS_<?= $i ?>'        name='CANT_DIAS[]' size='3' class='form-control input' readonly/></td>
                <td><input type='text' value='<?= $row['COST_TOTAL']; ?>'       id='COST_TOTAL_<?= $i ?>'       name='COST_TOTAL[]' size='3' class='form-control input' readonly/></td>
                <td><input type='text' value='<?= $row['PESO_V_TOTAL']; ?>'     id='PESO_V_TOTAL_<?= $i ?>'     name='PESO_V_TOTAL[]' size='3' class='form-control input' readonly/></td>
            </tr>
            <?php
            $i++;
        endwhile;
        ?>
        </tbody>
    </table>
</div>





