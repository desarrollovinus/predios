<?xml version="1.0" encoding="UTF-8"?>
<kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:kml="http://www.opengis.net/kml/2.2" xmlns:atom="http://www.w3.org/2005/Atom">
<Document>
<name><?php echo $ficha ?></name>
<LookAt>
    <longitude><?php echo $area["x"]; ?></longitude>
    <latitude><?php echo $area["y"]; ?></latitude>
    <altitude><?php echo $predio->area_requerida * 0.05; ?></altitude>
    <heading>3.234624111048396e-012</heading>
    <tilt>0</tilt>
    <range>0</range>
    <gx:altitudeMode>relativeToSeaFloor</gx:altitudeMode>
</LookAt>
<!-- Estilos  -->
<Style id="sn_ylw-pushpin">
<IconStyle>
    <scale>1.1</scale>
        <Icon>
            <href>http://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png</href>
        </Icon>
        <hotSpot x="20" y="2" xunits="pixels" yunits="pixels"/>
    </IconStyle>
    <LineStyle>
        <color>ff7fff55</color>
        <width>2</width>
    </LineStyle>
    <PolyStyle>
        <color>7f0000ff</color>
    </PolyStyle>
</Style>
<Style id="sh_placemark_circle_highlight">
    <IconStyle>
        <scale>0.5</scale>
        <Icon>
            <href>http://maps.google.com/mapfiles/kml/shapes/placemark_circle_highlight.png</href>
        </Icon>
    </IconStyle>
</Style>
<StyleMap id="msn_ylw-pushpin">
    <Pair>
        <key>normal</key>
        <styleUrl>#sn_ylw-pushpin0</styleUrl>
    </Pair>
    <Pair>
        <key>highlight</key>
        <styleUrl>#sh_ylw-pushpin</styleUrl>
    </Pair>
</StyleMap>
<Style id="sh_ylw-pushpin">
    <IconStyle>
        <scale>1.3</scale>
        <Icon>
            <href>http://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png</href>
        </Icon>
        <hotSpot x="20" y="2" xunits="pixels" yunits="pixels"/>
    </IconStyle>
    <LineStyle>
        <color>ff7fff55</color>
        <width>2</width>
    </LineStyle>
    <PolyStyle>
        <color>ff0000ff</color>
        <outline>0</outline>
    </PolyStyle>
</Style>
<Style id="sh_placemark_circle_highlight0">
    <IconStyle>
        <scale>0.5</scale>
        <Icon>
            <href>http://maps.google.com/mapfiles/kml/shapes/placemark_circle_highlight.png</href>
        </Icon>
    </IconStyle>
</Style>
<StyleMap id="msn_placemark_circle">
    <Pair>
        <key>normal</key>
        <styleUrl>#sn_placemark_circle</styleUrl>
    </Pair>
    <Pair>
        <key>highlight</key>
        <styleUrl>#sh_placemark_circle_highlight0</styleUrl>
    </Pair>
</StyleMap>
<Style id="sh_ylw-pushpin0">
    <IconStyle>
        <scale>1.3</scale>
        <Icon>
            <href>http://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png</href>
        </Icon>
        <hotSpot x="20" y="2" xunits="pixels" yunits="pixels"/>
    </IconStyle>
    <LineStyle>
        <color>ff7fff55</color>
        <width>2</width>
    </LineStyle>
    <PolyStyle>
        <color>7f0000ff</color>
    </PolyStyle>
</Style>
<StyleMap id="msn_placemark_circle0">
    <Pair>
        <key>normal</key>
        <styleUrl>#sn_placemark_circle0</styleUrl>
    </Pair>
    <Pair>
        <key>highlight</key>
        <styleUrl>#sh_placemark_circle_highlight</styleUrl>
    </Pair>
</StyleMap>
<StyleMap id="msn_ylw-pushpin0">
    <Pair>
        <key>normal</key>
        <styleUrl>#sn_ylw-pushpin</styleUrl>
    </Pair>
    <Pair>
        <key>highlight</key>
        <styleUrl>#sh_ylw-pushpin0</styleUrl>
    </Pair>
</StyleMap>
<Style id="sn_ylw-pushpin0">
    <IconStyle>
        <scale>1.1</scale>
        <Icon>
            <href>http://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png</href>
        </Icon>
        <hotSpot x="20" y="2" xunits="pixels" yunits="pixels"/>
    </IconStyle>
    <LineStyle>
        <color>ff7fff55</color>
        <width>2</width>
    </LineStyle>
    <PolyStyle>
        <color>ff0000ff</color>
        <outline>0</outline>
    </PolyStyle>
</Style>
<Style id="sn_placemark_circle">
    <IconStyle>
        <scale>0.5</scale>
        <Icon>
            <href>http://maps.google.com/mapfiles/kml/shapes/placemark_circle.png</href>
        </Icon>
    </IconStyle>
</Style>
<Style id="sn_placemark_circle0">
    <IconStyle>
        <scale>0.5</scale>
        <Icon>
            <href>http://maps.google.com/mapfiles/kml/shapes/placemark_circle.png</href>
        </Icon>
    </IconStyle>
</Style>


<Placemark>
    <name><?php echo $ficha ?></name>
    <Style>
        <!-- Color de la linea  -->
        <LineStyle>
            <color><?php echo "ff".$predio->color_proceso ?></color>
        </LineStyle>
        <!-- Color interior del poligono  -->
        <PolyStyle>
            <color><?php if ($predio->color_via) {
                echo "7f".$predio->color_via;
            } else {
                echo "7fffffff";
            }?></color>
            <fill>1</fill>
        </PolyStyle>
    </Style>
    <!-- Tabla de datos  -->
    <ExtendedData>
        <SchemaData schemaUrl="">
            <SimpleData name="Tramo"><?php echo $predio->tramo ?></SimpleData>
            <SimpleData name="Municipio"><?php echo $predio->municipio ?></SimpleData>
            <SimpleData name="Abscisa inicial"><?php echo $predio->abscisa_inicial ?></SimpleData>
            <SimpleData name="Abscisa final"><?php echo $predio->abscisa_final ?></SimpleData>
            <SimpleData name="Propietario"><?php echo $predio->nombre_propietario ?></SimpleData>
            <SimpleData name="Estado del proceso"><?php echo $predio->estado_pro ?></SimpleData>
            <SimpleData name="Area requerida"><?php echo $predio->area_requerida ?></SimpleData>
            <SimpleData name="Cédula catastral"><?php echo $predio->no_catastral ?></SimpleData>
            <SimpleData name="Estado de la vía"><?php echo $predio->estado_via ?></SimpleData>
        </SchemaData>
    </ExtendedData>
    <!-- visibilidad de la tabla de datos al iniciar el google earth 1:visible kml- 0: no visible  -->
    <gx:balloonVisibility>0</gx:balloonVisibility>

    <Polygon>
        <outerBoundaryIs>
            <LinearRing>
                <coordinates>
                    <?php
                    $cont = 1;
                    $max = count($coordenadas);
                    foreach ($coordenadas as $punto){
                        echo $punto["x"].",".$punto["y"].",0 ";
                        if($cont == $max) {echo $coordenadas[0]["x"].",".$coordenadas[0]["y"].",0 ";}
                        $cont++;
                    }?>
                </coordinates>
            </LinearRing>
        </outerBoundaryIs>
        <LookAt>
            <longitude><?php echo $area["x"]; ?></longitude>
            <latitude><?php echo $area["y"]; ?></latitude>
            <altitude><?php echo $predio->area_requerida*0.1; ?></altitude>
            <heading>0</heading>
            <tilt>0</tilt>
            <range>0</range>
            <gx:altitudeMode>relativeToSeaFloor</gx:altitudeMode>
        </LookAt>
    </Polygon>
</Placemark>

<!-- Punto de área -->
<Placemark>
    <name>Área requerida: <?php echo $predio->area_requerida; ?> m2 </name>
    <styleUrl>#msn_placemark_circle0</styleUrl>
    <Point>
        <coordinates><?php echo $area["x"].",".$area["y"].",0 "; ?></coordinates>
    </Point>
</Placemark>

<!-- Vertices -->
<Folder>
    <name>Vértices</name>
<?php foreach ($coordenadas as $punto): ?>
    <Placemark>
    <name><?php echo $punto["punto"]; ?></name>
    <styleUrl>#msn_placemark_circle</styleUrl>
    <Point>
        <coordinates><?php echo $punto["x"].",".$punto["y"].","."0 "; ?></coordinates>
    </Point>
    </Placemark>
<?php endforeach; ?>
</Folder>
</Document>
</kml>

<?php
header('Cache-Control: max-age=0');
header('Content-Type: text/xml');
header("Content-Disposition: attachment; filename="."{$ficha}.kml");
  ?>
