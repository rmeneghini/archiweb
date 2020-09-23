var Descargas = {
    calculoNetoApli: function() {
        var kgNet = jQuery("#Descargas_kg_netos_destino").val();
        var merHum = jQuery("#Descargas_merma_humedad").val();
        var merZar = jQuery("#Descargas_merma_zaranda").val();
        var otraMer = jQuery("#Descargas_otras_mermas").val();
        jQuery("#Descargas_neto_aplicable").val(kgNet - merHum - merZar - otraMer);
    },
    calculoNeto: function() {
        jQuery("#Descargas_kg_netos_destino").val(jQuery("#Descargas_kg_brutos_destino").val() - jQuery("#Descargas_kg_tara_destino").val());
        Descargas.calculoNetoApli();
    }
}

var Usuario = {
        // esta funcion las empresas asocidas a un usuario
        cargarEmpresas: function(datos) {
            // limpio los datos de la sesion
            sessionStorage.clear();
            datos.forEach(function(valor, indice, array) {
                Usuario.asociarEmpresa(valor.idEmp, valor.razonSoc, valor.idUsuario);
            });
            //console.log(datos);
        },
        asociarEmpresa: function(idEmp, razonSocial, idUsuario = 0) {

            jQuery('#list-empresas').after('<span style="padding:2px;">' + razonSocial + '&nbsp;<button type="button" class="badge btn btn-default btn-xs" onclick="Usuario.eliminarEmpresa(' + idEmp + ',$(this),' + idUsuario + ');" title="Quitar empresa" type="button">&times;</button></span>');
            // guardo en el SessionStorage
            var lineaJson = { "empresa": idEmp, "razonSocial": razonSocial };
            var datosLinea = JSON.stringify(lineaJson);
            sessionStorage.setItem(idEmp, datosLinea);

            return false;
        },
        eliminarEmpresa: function(idEmp, elemento, idUsuario = 0) {
            if (confirm('Esta seguro de quitar esta Empresa?')) {
                /* debo comprobar si estaba insertado en la tabla lo debo eliminar para que se liste en la grilla */
                if (idUsuario > 0) {
                    url = jQuery.fn.yiiGridView.getUrl('empresa-grid');
                    //console.log(url);
                    pos = url.search("usuario");
                    ctrlUrl = url.substring(0, pos) + "usuario/eliminarEmp";
                    //console.log(ctrlUrl);
                    var parametros = { "usuario": idUsuario, "empresa": idEmp };
                    jQuery.getJSON(ctrlUrl, parametros, function(data) {
                        jQuery.fn.yiiGridView.update('empresa-grid');
                    }).fail(function() {
                        alert('Ocurrio un error y no se realizo la eliminación de la empresa');
                    });
                }
                jQuery(elemento).parent().remove();
                sessionStorage.removeItem(idEmp);

            }
            return false;
        },
        procesar: function(idForm) {
            //esta funcion toma las empresas almacenado en SesionStorage y se cargan en un input oculto
            var lineas = {};
            for (var i = 0; i < sessionStorage.length; i++) {
                var docente = sessionStorage.key(i);
                var linea = JSON.parse(sessionStorage.getItem(docente));
                lineas[i] = linea;
            }
            //console.log(JSON.stringify(lineas));return false;
            var lineasJson = JSON.stringify(lineas);
            jQuery(idForm).append('<input type="hidden" id="list-emp-json" name="Usuario[list-emp-json]" value="" /> ');
            jQuery("#list-emp-json").val(lineasJson);
            //console.log(jQuery("#list-prod-json").val()); return false;
            sessionStorage.clear();
            return true;

        },
    } //Fin Usuario