<html>
  <head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <meta charset="utf-8"/>
    <script src="https://maps.maplink.global"></script>
    <style>
      #map {position: absolute; top: 0; right: 0; bottom: 0; left: 0;}
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script type = "text/javascript">
          const apiKey = "SUA CHAVE DE API";
          const maplink = new MaplinkMap(apiKey, "map", { center: [19.301846648235813, -98.44791447958605] });
 
          const icon = maplink.icon(
              "iconfinder_Marker_1891030.png",
              null,
              {
                  iconSize: [32, 32],
                  shadowSize: [0, 0],
                  iconAnchor: [20, 42],
                  shadowAnchor: [0, 0],
                  popupAnchor: [-3, -32]
              });
          maplink.marker({
              latitude: 19.301846648235813,
              longitude: -98.44791447958605
          }, {
              icon,
              popup: "<strong>Casa</strong>"
          });
    </script>
  </body>
</html>