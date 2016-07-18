<style media="screen">
    body {
        font-family: arial;
    }

    h1 {
        text-align: center;
    }

    table {
       border-collapse:collapse;
       padding:0;
    }

    table td, th {
        display: table-cell;
        text-align: center;
        width:220px;
        vertical-align:middle;
        height:0;
        padding-left: 20px;
        padding-bottom: 30px;
    }

    table td div {
        min-height:100%;
    }

</style>
<h1>Convención</h1>
<table>
    <tr>
        <div>
            <th>
                Estado de las vías:
            </th>
        </div>
        <?php foreach ($estados_via as $estado): ?>
            <td>
                <div style="border-bottom: 6px solid #<?php echo $estado->color ?>; ">
                    <?php echo $estado->nombre; ?>
                </div>
            </td>
        <?php endforeach; ?>
        <td>
            <img src="http://sicc.vinus.com.co/img/logo_ani.jpg" alt="ANI" height="60px"/>
        </td>
    </tr>
</table>
<br><br>
<table>
    <tr>
        <th rowspan="2">
            Estado del proceso:
        </th>
        <?php $cont = 0; ?>
        <?php foreach ($estados_proceso as $estado): ?>
            <td>
                <div style="border-bottom: 20px solid #<?php echo $estado->color ?>; ">
                    <?php echo $estado->estado; ?>
                </div>
                <?php if ($cont > 9) {
                    echo "</tr><tr>";
                    $cont = 0;
                }
                $cont++;
                 ?>
            </td>
        <?php endforeach; ?>
        <td>
            <img src="http://sicc.vinus.com.co/img/Logo_vinus.png" alt="ANI" height="60px"/>
        </td>
    </tr>
</table>
