let map = new L.Map('map', { center: new L.LatLng(-8.171783, 113.701500), zoom: 11, maxZoom: 20, zoomControl: true }),
    baselayer = {
        'osm': L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxNativeZoom: 18, maxZoom: 20, attribution: '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }),
        "google-satelit": L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
            maxNativeZoom: 18, maxZoom: 20, attribution: 'google-satelit'
        }),
        "google-hybrid": L.tileLayer('http://mt0.google.com/vt/lyrs=y&hl=en&x={x}&y={y}&z={z}', {
            maxNativeZoom: 18, maxZoom: 20, attribution: 'google-hybrid'
        }).addTo(map)
    },
    overlayer = {}, luas_area = [], layerGroup = [], coordinates = [], drawnItems = L.featureGroup().addTo(map);

let yellowIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-yellow.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

self.drawControlFull = new L.Control.Draw({
    draw: {
        polyline: false,
        polygon: false,
        rectangle: false,
        circle: false,
        marker: false,
        circlemarker: false,
    },
});
self.drawControlEdit = new L.Control.Draw({
    edit: {
        featureGroup: drawnItems,
        edit: true
    },
    draw: false
});
map.addControl(drawControlFull);

map.on('draw:created', function(e) {
    var type = e.layerType,
        layer = e.layer;

    self.drawControlFull.remove();
    self.drawControlEdit.addTo(map);

    drawnItems.addLayer(layer);
    if ($("#kategori_area_id").val() == 3) {
        coordinates = layer.getLatLng();
        $("#coordinates").val('['+ coordinates.lat +', '+ coordinates.lng +']');
    } else {
        coordinates = layer.getLatLngs()[0];
        $("#coordinates").val(JSON.stringify(coordinates).replaceAll('{"lat":','[').replaceAll('"lng":','').replaceAll('}',']'));
        var seeArea = L.GeometryUtil.geodesicArea(layer.getLatLngs()[0]);
        $("#luas").val(roundToTwo(seeArea));
    }
    $("#simpan").removeAttr('disabled');
});

map.on('draw:edited', function(e) {
    var layers = e.layers;
    layers.eachLayer(function(layer) {
        if ($("#kategori_area_id").val() == 3) {
            coordinates = layer.getLatLng();
            $("#coordinates").val('['+ coordinates.lat +', '+ coordinates.lng +']')
        } else {
            coordinates = layer.getLatLngs()[0];
            $("#coordinates").val(JSON.stringify(coordinates).replaceAll('{"lat":','[').replaceAll('"lng":','').replaceAll('}',']'));
            var seeArea = L.GeometryUtil.geodesicArea(layer.getLatLngs()[0]);
            $("#luas").val(roundToTwo(seeArea));
        }

    })
});

map.on('draw:deleted', function (e) {
    kategori_area_id();
    $("#simpan").attr('disabled',true);
});

let jeni = L.polyline([[-8.394293720440649,113.40088024735452],[-8.394212789469739,113.40086951851846],[-8.39383997609081,113.40080246329308],[-8.39344991473465,113.40074345469475],[-8.393097001741475,113.40070992708208],[-8.393018724004039,113.40070858597757],[-8.392762662820502,113.40069115161897],[-8.392550383991122,113.40068042278291],[-8.392342085277004,113.40066969394685],[-8.391977230572218,113.40068712830545],[-8.391800773446555,113.40070188045503],[-8.391502255570263,113.40073272585869],[-8.391275381830834,113.40074613690378],[-8.391198430473908,113.4007501602173],[-8.390963596066292,113.40077966451646],[-8.390894605139902,113.40079173445704],[-8.390450144070334,113.40084001421931],[-8.390362578545918,113.4008212387562],[-8.390094574848533,113.40083867311479],[-8.389756253085338,113.40080246329308],[-8.389433852072123,113.40071126818657],[-8.389132678867453,113.40064421296121],[-8.388905803744127,113.40059190988542],[-8.388637799041788,113.40056508779529],[-8.38847726148304,113.4005503356457],[-8.388241098672756,113.40057313442232],[-8.388077907433487,113.40059325098994],[-8.387811228919338,113.40064689517021],[-8.387621502302833,113.40068310499193],[-8.38725796992569,113.40078502893451],[-8.386975369704137,113.40095534920694],[-8.386800237069329,113.40105861425401],[-8.386729918640732,113.4010934829712],[-8.386501715350825,113.40120479464534],[-8.386439357451781,113.40123429894449],[-8.386184618696458,113.401325494051],[-8.386062556317016,113.40136975049974],[-8.385860887953976,113.40140864253044],[-8.385546444310712,113.40141803026201],[-8.38537529133468,113.40140193700792],[-8.385194850906252,113.40136438608171],[-8.384973280559688,113.40128526091576],[-8.384751710086842,113.40121284127237]], {
    color: 'red',
}).bindPopup('Sengketa Batas Desa Kepanjen dan Desa Mayangan');

function kategori_area_id() {
    $("#luas").val('');
    $("#coordinates").val('');
    $("#coordinates").removeAttr('readonly');

    if ($("#kategori_area_id").val() == 2) {
        $(".tkd").show();
    } else {
        $(".tkd").hide();
    }

    map.removeControl(drawControlFull);
    map.removeControl(drawControlEdit);
    drawnItems.clearLayers()

    if ($("#kategori_area_id").val()) {
        $.get(BASEURL + '/api/kategori-area/' + $("#kategori_area_id").val(), function (response) {
            let drawControl = {
                draw: {
                    polyline: false,
                    polygon: false,
                    rectangle: false,
                    circle: false,
                    marker: false,
                    circlemarker: false,
                },
            }
            switch (response.data.type) {
                case 'Polygon':
                    drawControl.draw.polygon = {
                        shapeOptions: {color: '#ffe600'},
                        allowIntersection: true
                    };
                    break;
                case 'Polyline':
                    drawControl.draw.polyline = true;
                    break;
                case 'Point':
                    drawControl.draw.marker = {
                        icon: yellowIcon
                    };
                    break;
            }

            self.drawControlFull = new L.Control.Draw(drawControl);
            map.addControl(drawControlFull);
        });
    }
}

function onEachFeature(feature, layer) {
    let popupContent = '';
        if (feature.properties) {
            popupContent += `<div class="table-responsive mt-4 mb-1">
                                <table class="table table-sm table-hover table-striped">`;
            popupContent +=         `<tr>
                                        <td class="p-1" align="top">Kode Desa</td>
                                        <td class="p-1" align="top" width="10px">:</td>
                                        <td class="p-1" align="top">${feature.properties.Kd_Desa}</td>
                                    </tr>`;
            popupContent +=         `<tr>
                                        <td class="p-1" align="top">Desa</td>
                                        <td class="p-1" align="top" width="10px">:</td>
                                        <td class="p-1" align="top" style="white-space:normal">${feature.properties.desa}</td>
                                    </tr>`;
            popupContent +=         `<tr>
                                        <td class="p-1" align="top">Kecamatan</td>
                                        <td class="p-1" align="top" width="10px">:</td>
                                        <td class="p-1" align="top" style="white-space:normal">${feature.properties.kecamatan}</td>
                                    </tr>`;
            popupContent +=         `<tr>
                                        <td class="p-1" align="top">Kategori Area</td>
                                        <td class="p-1" align="top" width="10px">:</td>
                                        <td class="p-1" align="top" style="white-space:normal">${feature.properties.kategori}</td>
                                    </tr>`;
            if (feature.properties.kategori == 'Tanah Kas Desa') {
                popupContent +=         `<tr>
                                            <td class="p-1" align="top">Status Alas Hak</td>
                                            <td class="p-1" align="top" width="10px">:</td>
                                            <td class="p-1" align="top" style="white-space:normal">${feature.properties.status_alas_hak??'-'}</td>
                                        </tr>`;
                popupContent +=         `<tr>
                                            <td class="p-1" align="top">Pemanfaatan TKD</td>
                                            <td class="p-1" align="top" width="10px">:</td>
                                            <td class="p-1" align="top" style="white-space:normal">${feature.properties.pemanfaatan_tkd??'-'}</td>
                                        </tr>`;
            }
            let keterangan = '';
            if (feature.properties.keterangan) {
                keterangan = feature.properties.keterangan.replace(/\n/g,"<br>");
            }
            popupContent +=         `<tr>
                                        <td class="p-1" align="top">Keterangan</td>
                                        <td class="p-1" align="top" width="10px">:</td>
                                        <td class="p-1" align="top" style="white-space:normal">${keterangan}</td>
                                    </tr>`;
            if (feature.geometry.type != 'Point') {
                popupContent +=         `<tr>
                                            <td class="p-1" align="top">Luas</td>
                                            <td class="p-1" align="top" width="10px">:</td>
                                            <td class="p-1" align="top">` + roundToTwo(L.GeometryUtil.geodesicArea(layer.getLatLngs()[0])) + ` M<sup>2</sup></td>
                                        </tr>`;
            }

            popupContent +=         `</table>
                            </div>`;
            popupContent += `<div class="text-right">`;
            if (feature.properties.bukti_alas_hak != '-') {
                popupContent += `<a target="_blank" class="mx-1" href="${feature.properties.bukti_alas_hak}" title="Download Bukti Alas Hak" data-toggle="tooltip"><i class="fas fa-download"></i></a>`;
            }

            if ($('meta[name="peran"]').attr('content') == 'Super Admin' || $('meta[name="peran"]').attr('content') == 'Bidang Keuangan' || $('meta[name="peran"]').attr('content') == 'Kepala') {
                popupContent +=     `<a class="mx-1" href="${BASEURL}/pemetaan/${feature.properties.id}/edit" title="Ubah" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                                    <a class="mx-1 hapus-data" data-nama="${feature.properties.kategori} ${feature.properties.desa}" data-action="${BASEURL}/pemetaan/${feature.properties.id}" href="#modal-hapus" title="Hapus" data-toggle="tooltip">
                                        <i class="fas fa-trash text-danger"></i>
                                    </a>`;
            }

            popupContent +=`</div>`;
    }
    layer.bindPopup(popupContent);
}