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
    
  }

}

const map = new mapObjet('map_viewer',[parseFloat(document.getElementById('longY').value),parseFloat(document.getElementById('latX').value)],14);

