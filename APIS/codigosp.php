<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Información de un código postal con JQuery - API COPOMEX</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">



    <script type="text/javascript">
        
        function informacion_cp(){

          $.ajax({
            url : 'https://api.copomex.com/query/info_cp/' + $("#codigo_postal").val(), //aqui va el endpoint de la api de copomex, con el método de info_cp, se deberá concatenar el CP ya que se recibe como parametro en la url, no como variable GET
            data : { 
              token : "373b1daa-2066-4677-aa95-063dc7884ea9", //aqui va tu token. Crea una cuenta gratuita para obtener tu token en https://api.copomex.com/panel
              type : 'simplified'
            },
            type : 'GET', //el método http que se usará, COPOMEX solo ocupa método get
            dataType : 'json', // el tipo de información que se espera de respuesta
            success : function(copomex) { // código a ejecutar si la petición es satisfactoria, dentro irá el código personalizado

              if(!copomex.error){ //si NO hubo un error

                $("#cp_response").val(copomex.response.cp); //ingresamos la respuesta del cp, en el input destino
                $("#tipo_asentamiento").val(copomex.response.tipo_asentamiento); //ingresamos la respuesta del tipo de asentamiento, en el input destino
                $("#municipio").val(copomex.response.municipio); //ingresamos la respuesta del municipio, en el input destino
                $("#estado").val(copomex.response.estado); //ingresamos la respuesta del estado, en el input destino
                $("#ciudad").val(copomex.response.ciudad); //ingresamos la respuesta de la ciudad, en el input destino
                $("#pais").val(copomex.response.pais); //ingresamos la respuesta del pais, en el input destino

                $("#list_colonias").html(''); //reseteamos el input select para que no se concatene a los nuevos resultados
                for(var i = 0; i<copomex.response.asentamiento.length; i++){ //iteramos el resultado en un for
                  $("#list_colonias").append('<option>'+copomex.response.asentamiento[i]+'</option>'); //agregamos el item al listado de colonias
                }

              }else{ //si hubo error
                console.log('error: ' + copomex.error_message);
              }

            },
            error : function(jqXHR, status, error) { //si ocurrió un error en el request al endpoint de COPOMEX

                if(jqXHR.status==400){ //el código http 400 significa que algo se mandó mal (Bad Request)
                  copomex = jqXHR.responseJSON;
                  alert(copomex.error_message); //mostramos en un alerta, el error recibido
                }

            },
            complete : function(jqXHR, status) { // código a ejecutar sin importar si la petición falló o no
                console.log('Petición a COPOMEX terminada');
            }
          });

        }

    </script>

  </head>
  <body>
    <!-- <h2>Para mayor información visita https://api.copomex.com/documentacion</h2> -->

    <form name="estados" id="estados">

      <div class="input-group input-group-sm mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-sm">Código Postal:</span>
        </div>
        <input type="text" class="form-control" name="codigo_postal" id="codigo_postal">
      </div>
      <a href="javascript:void(0)" onclick="informacion_cp()" class="btn btn-primary">Obtener información Código Postal</a>
      <br/>


      <label for="cp_response">Código Postal Respuesta:</label>
      <input type="text" name="cp_response" id="cp_response" class="form-control" disabled readonly>
      <br>

      <label for="list_colonias">Colonias:</label>
      <select name="list_colonias" id="list_colonias" class="form-control">
        <option>Seleccione</option>
      </select>
      <br>

      <label for="tipo_asentamiento">Tipo Asentamiento:</label>
      <input type="text" name="tipo_asentamiento" id="tipo_asentamiento" class="form-control" disabled readonly>
      <br>

      <label for="municipio">Municipio:</label>
      <input type="text" name="municipio" id="municipio" class="form-control" disabled readonly>
      <br>

      <label for="estado">Estado:</label>
      <input type="text" name="estado" id="estado" class="form-control" disabled readonly>
      <br>

      <label for="ciudad">Ciudad:</label>
      <input type="text" name="ciudad" id="ciudad" class="form-control" disabled readonly>
      <br>

      <label for="pais">País:</label>
      <input type="text" name="pais" id="pais" class="form-control" disabled readonly>
      <br>

    </form>

  </body>
</html>