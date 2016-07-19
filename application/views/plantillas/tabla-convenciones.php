<script src="<?php echo base_url(); ?>js/html2canvas.min.js"></script>
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
<body>
<div id="convenciones">
    <div class="cabecera">
        <div>
            <img src="<?php  echo base_url()."img/logo_vinus.png" ?>" alt="VINUS" height="60px" />
        </div>

        <div>
            <h4>Convenciones de los mapas</h4>
        </div>

        <div>
            <img src="<?php echo base_url()."img/logo_ani.png" ?>" alt="ANI" height="60px" />
        </div>
    </div>

    <table width="100%">
            <tr>
                <div>
                    <th>
                        Estado de las vías:
                    </th>
                </div>
                <td>
                    <div style="border-bottom: 3px solid #ffffff">
                        Sin estado
                    </div>
                </td>
                <?php foreach ($estados_via as $estado): ?>
                    <td>
                        <div style="border-bottom: 3px solid #<?php echo $estado->color ?>; ">
                            <?php echo $estado->nombre; ?>
                        </div>
                    </td>
                <?php endforeach; ?>
            </tr>
        <tr>
            <th>
                Estado del proceso:
            </th>
            <td>
                <div style="border-bottom: 20px solid #ffffff">
                    Sin estado
                </div>
            </td>
            <?php foreach ($estados_proceso as $estado): ?>
                <td>
                    <div style="border-bottom: 20px solid #<?php echo $estado->color ?>; ">
                        <?php echo $estado->estado; ?>
                    </div>
                </td>
            <?php endforeach; ?>
        </tr>
    </table>
</div>
</body>
<script type="text/javascript">
    html2canvas(document.body, {
        onrendered: function(canvas) {
            var can = document.body.appendChild(canvas);
            can.id = "canvas";
        }
    });
</script>
