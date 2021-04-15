var wms_layers = [];


        var lyr_OpenTopoMap_0 = new ol.layer.Tile({
            'title': 'OpenTopoMap',
            'type': 'base',
            'opacity': 1.000000,
            
            
            source: new ol.source.XYZ({
    attributions: ' &middot; <a href="https://www.openstreetmap.org/copyright">Kartendaten: © OpenStreetMap-Mitwirkende, SRTM | Kartendarstellung: © OpenTopoMap (CC-BY-SA)</a>',
                url: 'https://a.tile.opentopomap.org/{z}/{x}/{y}.png'
            })
        });
var lyr_altimetriaalos_1 = new ol.layer.Image({
                            opacity: 1,
                            title: "altimetria alos",
                            
                            
                            source: new ol.source.ImageStatic({
                               url: "./layers/altimetriaalos_1.png",
    attributions: ' ',
                                projection: 'EPSG:3857',
                                alwaysInRange: true,
                                imageExtent: [-5906479.559090, -3012576.551478, -5901210.436526, -3005925.050409]
                            })
                        });
var format_curvasdenivel5m_2 = new ol.format.GeoJSON();
var features_curvasdenivel5m_2 = format_curvasdenivel5m_2.readFeatures(json_curvasdenivel5m_2, 
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_curvasdenivel5m_2 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_curvasdenivel5m_2.addFeatures(features_curvasdenivel5m_2);
var lyr_curvasdenivel5m_2 = new ol.layer.Vector({
                declutter: true,
                source:jsonSource_curvasdenivel5m_2, 
                style: style_curvasdenivel5m_2,
                interactive: true,
                title: '<img src="styles/legend/curvasdenivel5m_2.png" /> curvas de nivel 5m'
            });
var format_pontos_3 = new ol.format.GeoJSON();
var features_pontos_3 = format_pontos_3.readFeatures(json_pontos_3, 
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_pontos_3 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_pontos_3.addFeatures(features_pontos_3);
var lyr_pontos_3 = new ol.layer.Vector({
                declutter: true,
                source:jsonSource_pontos_3, 
                style: style_pontos_3,
                interactive: true,
                title: '<img src="styles/legend/pontos_3.png" /> pontos'
            });
var format_rioss_4 = new ol.format.GeoJSON();
var features_rioss_4 = format_rioss_4.readFeatures(json_rioss_4, 
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_rioss_4 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_rioss_4.addFeatures(features_rioss_4);
var lyr_rioss_4 = new ol.layer.Vector({
                declutter: true,
                source:jsonSource_rioss_4, 
                style: style_rioss_4,
                interactive: true,
                title: '<img src="styles/legend/rioss_4.png" /> rioss'
            });

lyr_OpenTopoMap_0.setVisible(true);lyr_altimetriaalos_1.setVisible(true);lyr_curvasdenivel5m_2.setVisible(true);lyr_pontos_3.setVisible(true);lyr_rioss_4.setVisible(true);
var layersList = [lyr_OpenTopoMap_0,lyr_altimetriaalos_1,lyr_curvasdenivel5m_2,lyr_pontos_3,lyr_rioss_4];
lyr_curvasdenivel5m_2.set('fieldAliases', {'NAME': 'NAME', 'LAYER': 'LAYER', 'ELEVATION': 'ELEVATION', });
lyr_pontos_3.set('fieldAliases', {'id': 'id', 'NUM': 'NUM', });
lyr_rioss_4.set('fieldAliases', {'GM_LAYER': 'GM_LAYER', 'GM_TYPE': 'GM_TYPE', 'MAP_NAME': 'MAP_NAME', 'OBJECTID': 'OBJECTID', 'Id': 'Id', 'Curso_Dagu': 'Curso_Dagu', 'cotrecho': 'cotrecho', 'cocursodag': 'cocursodag', 'cobacia': 'cobacia', 'corio': 'corio', 'codom': 'codom', 'dedominial': 'dedominial', 'nucomptrec': 'nucomptrec', 'nudistbact': 'nudistbact', 'nudistcdag': 'nudistcdag', 'nuareacont': 'nuareacont', 'nuareamont': 'nuareamont', 'nunivotto': 'nunivotto', 'decorpodag': 'decorpodag', 'deligacao': 'deligacao', 'norio': 'norio', 'noriocomp': 'noriocomp', 'nucomprio': 'nucomprio', 'nudistbacr': 'nudistbacr', 'cocdadesag': 'cocdadesag', 'nucompcda': 'nucompcda', 'nutrjus': 'nutrjus', 'nutrmon': 'nutrmon', 'nutrafl': 'nutrafl', 'nudistbacc': 'nudistbacc', 'nuareabacc': 'nuareabacc', 'nuordemcda': 'nuordemcda', 'nunivotcda': 'nunivotcda', 'nulondetre': 'nulondetre', 'nulatdetre': 'nulatdetre', 'nulonpatre': 'nulonpatre', 'nulatpatre': 'nulatpatre', 'nulondecda': 'nulondecda', 'nulatdecda': 'nulatdecda', 'nulonpacda': 'nulonpacda', 'nulatpacda': 'nulatpacda', 'nulonderio': 'nulonderio', 'nulatderio': 'nulatderio', 'nulonpario': 'nulonpario', 'nulatpario': 'nulatpario', 'dtversao': 'dtversao', 'LAYER': 'LAYER', 'Nome': 'Nome', 'Fonte_Topo': 'Fonte_Topo', 'Tipo_Drena': 'Tipo_Drena', 'Regime': 'Regime', 'Compriment': 'Compriment', 'Fonte_Mape': 'Fonte_Mape', 'Data_Mapea': 'Data_Mapea', 'Shape_Leng': 'Shape_Leng', 'LINE_STYLE': 'LINE_STYLE', 'LINE_COLOR': 'LINE_COLOR', 'LINE_WIDTH': 'LINE_WIDTH', });
lyr_curvasdenivel5m_2.set('fieldImages', {'NAME': '', 'LAYER': '', 'ELEVATION': '', });
lyr_pontos_3.set('fieldImages', {'id': '', 'NUM': '', });
lyr_rioss_4.set('fieldImages', {'GM_LAYER': 'TextEdit', 'GM_TYPE': 'TextEdit', 'MAP_NAME': 'TextEdit', 'OBJECTID': 'Range', 'Id': 'Range', 'Curso_Dagu': 'TextEdit', 'cotrecho': 'Range', 'cocursodag': 'TextEdit', 'cobacia': 'TextEdit', 'corio': 'TextEdit', 'codom': 'Range', 'dedominial': 'TextEdit', 'nucomptrec': 'TextEdit', 'nudistbact': 'TextEdit', 'nudistcdag': 'TextEdit', 'nuareacont': 'TextEdit', 'nuareamont': 'TextEdit', 'nunivotto': 'Range', 'decorpodag': 'TextEdit', 'deligacao': 'TextEdit', 'norio': 'TextEdit', 'noriocomp': 'TextEdit', 'nucomprio': 'TextEdit', 'nudistbacr': 'TextEdit', 'cocdadesag': 'TextEdit', 'nucompcda': 'TextEdit', 'nutrjus': 'Range', 'nutrmon': 'Range', 'nutrafl': 'Range', 'nudistbacc': 'TextEdit', 'nuareabacc': 'TextEdit', 'nuordemcda': 'Range', 'nunivotcda': 'Range', 'nulondetre': 'TextEdit', 'nulatdetre': 'TextEdit', 'nulonpatre': 'TextEdit', 'nulatpatre': 'TextEdit', 'nulondecda': 'TextEdit', 'nulatdecda': 'TextEdit', 'nulonpacda': 'TextEdit', 'nulatpacda': 'TextEdit', 'nulonderio': 'TextEdit', 'nulatderio': 'TextEdit', 'nulonpario': 'TextEdit', 'nulatpario': 'TextEdit', 'dtversao': 'TextEdit', 'LAYER': 'TextEdit', 'Nome': 'TextEdit', 'Fonte_Topo': 'TextEdit', 'Tipo_Drena': 'TextEdit', 'Regime': 'TextEdit', 'Compriment': 'TextEdit', 'Fonte_Mape': 'TextEdit', 'Data_Mapea': 'TextEdit', 'Shape_Leng': 'TextEdit', 'LINE_STYLE': 'TextEdit', 'LINE_COLOR': 'TextEdit', 'LINE_WIDTH': 'Range', });
lyr_curvasdenivel5m_2.set('fieldLabels', {'NAME': 'no label', 'LAYER': 'no label', 'ELEVATION': 'no label', });
lyr_pontos_3.set('fieldLabels', {'id': 'no label', 'NUM': 'no label', });
lyr_rioss_4.set('fieldLabels', {'GM_LAYER': 'no label', 'GM_TYPE': 'no label', 'MAP_NAME': 'no label', 'OBJECTID': 'no label', 'Id': 'no label', 'Curso_Dagu': 'no label', 'cotrecho': 'no label', 'cocursodag': 'no label', 'cobacia': 'no label', 'corio': 'no label', 'codom': 'no label', 'dedominial': 'no label', 'nucomptrec': 'no label', 'nudistbact': 'no label', 'nudistcdag': 'no label', 'nuareacont': 'no label', 'nuareamont': 'no label', 'nunivotto': 'no label', 'decorpodag': 'no label', 'deligacao': 'no label', 'norio': 'no label', 'noriocomp': 'no label', 'nucomprio': 'no label', 'nudistbacr': 'no label', 'cocdadesag': 'no label', 'nucompcda': 'no label', 'nutrjus': 'no label', 'nutrmon': 'no label', 'nutrafl': 'no label', 'nudistbacc': 'no label', 'nuareabacc': 'no label', 'nuordemcda': 'no label', 'nunivotcda': 'no label', 'nulondetre': 'no label', 'nulatdetre': 'no label', 'nulonpatre': 'no label', 'nulatpatre': 'no label', 'nulondecda': 'no label', 'nulatdecda': 'no label', 'nulonpacda': 'no label', 'nulatpacda': 'no label', 'nulonderio': 'no label', 'nulatderio': 'no label', 'nulonpario': 'no label', 'nulatpario': 'no label', 'dtversao': 'no label', 'LAYER': 'no label', 'Nome': 'no label', 'Fonte_Topo': 'no label', 'Tipo_Drena': 'no label', 'Regime': 'no label', 'Compriment': 'no label', 'Fonte_Mape': 'no label', 'Data_Mapea': 'no label', 'Shape_Leng': 'no label', 'LINE_STYLE': 'no label', 'LINE_COLOR': 'no label', 'LINE_WIDTH': 'no label', });
lyr_rioss_4.on('precompose', function(evt) {
    evt.context.globalCompositeOperation = 'normal';
});