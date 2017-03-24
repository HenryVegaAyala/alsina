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
        SELECT NUM_PROD, DESC_CORTAR, PREC_X_DIA, PESO_REAL, PESO_VOL, UD, PESO_REAL_TOTAL, CANT_DIAS, COST_TOTAL, PESO_V_TOTAL
        FROM mae_produ
        WHERE COD_ESTA = 1 AND COD_MAE_CATG = "'.$id.'" ORDER BY DESC_CORTAR ASC ;';
        $comando = $connection->createCommand($sqlStatement);
        $resultado = $comando->query();
        ?>
        <tbody>
        <?php
        $i = 1;
        while ($row = $resultado->read()):
        ?>
            <tr>
                    <td><?= $i ?></td>
                    <td><input type='text' value='<?= $row['NUM_PROD'];?>' id='facguiadetal-num_prod_<?= $i ?>' name='FacGuiaDetal[NUM_PROD][]' size='7'  class='form-control input' readonly/></td>
                    <td><input type='text' value='<?= $row['DESC_CORTAR'];?>' id='facguiadetal-desc_cortar_<?= $i ?>' name='FacGuiaDetal[DESC_CORTAR][]' size='58'  class='form-control input' readonly/></td>
                    <td><input type='text' value='<?= $row['PREC_X_DIA'];?>' id='facguiadetal-prec_x_dia_<?= $i ?>' name='FacGuiaDetal[PREC_X_DIA][]' size='2'  class='form-control input' /></td>
                    <td><input type='text' value='<?= $row['PESO_REAL'];?>' id='facguiadetal-peso_real_<?= $i ?>' name='FacGuiaDetal[PESO_REAL][]' size='2'  class='form-control input' readonly/></td>
                    <td><input type='text' value='<?= $row['PESO_VOL'];?>' id='facguiadetal-peso_vol_<?= $i ?>' name='FacGuiaDetal[PESO_VOL][]' size='3'  class='form-control input' readonly/></td>
                    <td><input type='text' value='<?= $row['UD'];?>' id='facguiadetal-ud_<?= $i ?>' name='FacGuiaDetal[UD][]' size='1'  class='form-control input' /></td>
                    <td><input type='text' value='<?= $row['PESO_REAL_TOTAL'];?>' id='facguiadetal-peso_real_total_<?= $i ?>' name='FacGuiaDetal[PESO_REAL_TOTAL][]' size='3'  class='form-control input' readonly/></td>
                    <td><input type='text' value='<?= $row['CANT_DIAS'];?>' id='facguiadetal-cant_dias_<?= $i ?>' name='FacGuiaDetal[CANT_DIAS][]' size='3'  class='form-control input' readonly/></td>
                    <td><input type='text' value='<?= $row['COST_TOTAL'];?>' id='facguiadetal-cost_total_<?= $i ?>' name='FacGuiaDetal[COST_TOTAL][]' size='3'  class='form-control input' readonly/></td>
                    <td><input type='text' value='<?= $row['PESO_V_TOTAL'];?>' id='facguiadetal-peso_v_total_<?= $i ?>' name='FacGuiaDetal[PESO_V_TOTAL][]' size='3'  class='form-control input' readonly/></td>
            </tr>
        <?php
        $i++;
        endwhile;
        ?>
        </tbody>
    </table>
</div>

