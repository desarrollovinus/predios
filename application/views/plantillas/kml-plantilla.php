<?xml version="1.0" encoding="UTF-8"?>
<kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:kml="http://www.opengis.net/kml/2.2" xmlns:atom="http://www.w3.org/2005/Atom">
<Document>
<name><?php echo $ficha ?></name>

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
    <name>Área</name>
    <Style>
        <!-- Color de la linea  -->
        <LineStyle>
            <color>ff0000ff</color>
        </LineStyle>
        <!-- Color interior del poligono  -->
        <PolyStyle>
            <color>3b0000ff</color>
            <fill>1</fill>
        </PolyStyle>
    </Style>
    <!-- Tabla de datos  -->
    <ExtendedData>
        <SchemaData schemaUrl="">
            <SimpleData name="Predio N°"><?php echo $ficha ?></SimpleData>
            <SimpleData name="Tramo">PORCESITO - SANTIAGO</SimpleData>
            <SimpleData name="Propietario">JESUS HUMBERTO ROLDAN JIMENEZ</SimpleData>
        </SchemaData>
    </ExtendedData>
    <!-- visibilidad de la tabla de datos al iniciar el google earth 1:visible kml- 0: no visible  -->
    <gx:balloonVisibility>1</gx:balloonVisibility>

    <Polygon>
        <outerBoundaryIs>
            <LinearRing>
                <coordinates>
                    -75.18892531435638,6.548624671398745,0 -75.18892531435638,6.548624671398751,0 -75.18885179204484,6.548636643523492,0 -75.18865209686709,6.548655410868842,0 -75.18858260804268,6.548659059669588,0 -75.18852814571575,6.548661040909389,0 -75.18841773115402,6.548662590705499,0 -75.18837690374357,6.548445128062151,0 -75.18836428475967,6.548387764553587,0 -75.18836428475967,6.548387764553587,0 -75.18836391577274,6.548386087208637,0 -75.18835778942247,6.548358237974669,0 -75.18852542249216,6.548356431787862,0 -75.18869289550732,6.548348888384806,0 -75.18886001220143,6.54833561660679,0 -75.1890265767257,6.548316632008362,0 -75.18904471360564,6.548290153039898,0 -75.18910859160899,6.548277919907505,0 -75.18917275565285,6.54827277736488,0 -75.18919624464566,6.548291314671472,0 -75.18936401973798,6.548260253152018,0 -75.18935641838419,6.548293619040271,0 -75.18934597189687,6.54833947354234,0 -75.1893018384805,6.548385705789912,0 -75.1892527800446,6.548451553979923,0 -75.18916353921246,6.548587807603575,0 -75.18902734970389,6.548618571859374,0 -75.1889271408466,6.54863588997897,0 -75.18892531435638,6.548624671398745,0
                </coordinates>
            </LinearRing>
        </outerBoundaryIs>
    </Polygon>
</Placemark>

<!-- Punto de área -->
<Placemark>
    <name>Area:3300.5 m2 </name>
    <styleUrl>#msn_placemark_circle0</styleUrl>
    <Point>
        <coordinates>-75.18892475,6.54845965,0</coordinates>
    </Point>
</Placemark>

<!-- Vertices -->
<Placemark>
<name>1</name>
<styleUrl>#msn_placemark_circle</styleUrl>
<Point>
    <coordinates>-75.18835779,6.54835824,0</coordinates>
</Point>
</Placemark>

</Document>
</kml>

<?php
header('Cache-Control: max-age=0');
header('Content-Type: text/xml');
header("Content-Disposition: attachment; filename="."{$ficha}.kml");
  ?>
