class mapObjet {

  constructor(viewer,center,zoom){
    this.viewer = viewer;
    this.center = center;
    this.zoom = zoom;

    this.olMap = new ol.Map({
        target: this.viewer,
        layers: [
           new ol.layer.Tile({
              source: new ol.source.OSM()
            }),
          ],
        view: new ol.View({
            center: ol.proj.fromLonLat(this.center),
            zoom: this.zoom,
            minZoom: 12,
            maxZoom:18
        }),
        controls: ol.control.defaults().extend([
           new ol.control.ScaleLine()
        ])
    });

    this.couchePointer();
  }

  //Création du pointer
  couchePointer(){
    var pointer = {};
    pointer.type = 'Feature';
    pointer.geometry = {};
    pointer.geometry.type = 'Point';
    pointer.geometry.coordinates = this.center;

    var pointerCab = {};
    pointerCab.type = 'FeatureCollection';
    pointerCab.crs = {};
    pointerCab.crs.type = 'name';
    pointerCab.crs.properties = {};
    pointerCab.crs.properties.name = 'EPSG:3857';
    pointerCab.features = [pointer];
    this.ajoutCoucheCarte(pointerCab);
  }

  //Ajout du pointer à la carte
  ajoutCoucheCarte(featureCollection) {
    var coucheSource = new ol.source.Vector({
      features: (new ol.format.GeoJSON({
        defaultDataProjection:'EPSG:4326',
        featureProjection:'EPSG:3857'
      })).readFeatures(featureCollection)
    });

    var coucheLayer = new ol.layer.Vector({
      source: coucheSource,
      style: this.styleFunction
    });
    this.olMap.addLayer(coucheLayer);
  }

  //Définition du style du pointer
  styleFunction(geostat) {
    var stylePointer = new ol.style.Icon({
      anchor: [0.5, 49],
      anchorXUnits: 'fraction',
      anchorYUnits: 'pixels',
      src: 'public/Illustrations/pointer_map.png'
    });
    return new ol.style.Style({
      image: stylePointer
    });
 }

}

const map = new mapObjet('map_viewer',[parseFloat(document.getElementById('longY').value),parseFloat(document.getElementById('latX').value)],14);

