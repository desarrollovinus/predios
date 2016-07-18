<style media="screen">
    body {
        font-family: arial;
        font-size: 0.8em;
        color: white;
    }

    h1 {
        text-align: center;
    }

    table {
        border-collapse:collapse;
        font-size: 0.8em;
        padding:0;
    }

    table td, th {
        /*display: table-cell;*/
        height:0;
        padding: 2.5;
        padding-left: 20px;
        text-align: center;
        vertical-align:middle;
        /*width:220px;*/
    }

    table td div {
        min-height:100%;
    }
    img{
        margin: 0;
        text-align: right;
    }

    #convenciones{
        border: 1px solid white;
        padding:5px;
    }

    .cabecera {
        text-align: center;
        padding-bottom: 10px;
        width: 100%;
    }
    .cabecera div {
        /*border: 1px solid black;*/
        display: inline-block;
        vertical-align: middle;
    }

</style>

<div id="convenciones">
    <div class="cabecera">
        <div>
            <img src="http://sicc.vinus.com.co/img/Logo_vinus.png" alt="ANI" height="60px" />
        </div>

        <div>
            <h4>Convenciones de los mapas</h4>
        </div>

        <div>
            <img src="http://sicc.vinus.com.co/img/logo_ani.jpg" alt="ANI" height="60px" />
        </div>
    </div>

    <table width="100%">
            <tr>
                <div>
                    <th>
                        Estado de las vías:
                    </th>
                </div>
                <?php foreach ($estados_via as $estado): ?>
                    <td>
                        <div style="border-bottom: 3px solid #<?php echo $estado->color ?>; ">
                            <?php echo $estado->nombre; ?>
                        </div>
                    </td>
                <?php endforeach; ?>
            </tr>
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
        </tr>
    </table>
</div>