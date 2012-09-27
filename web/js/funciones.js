/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/* Función para llenar combos desde JSON con Ajax */
function cargarCombo(url,value,target){
    var combo = document.getElementById(target);
    limpiarCombo(combo);
    $.getJSON(url,'id='+value,
        function(data){
            $.each(data.datos,
                function(i,item){
                    addItem(combo,item.id,item.descripcion);
                });
        });
}

/* Función para limpiar combos */
function limpiarCombo(target){
    while (target.length > 0) {
        target.remove(0);
    }
}

/* Función para agregar un item al combo */
function addItem(target, value, content){
    var opt;
    opt = document.createElement('option');
    opt.value = value;
    opt.appendChild(document.createTextNode(content));
    target.appendChild(opt);
}

/* Función para marcar voto */
function marcarVoto(pk, action, row, image){
    var kendoWindow = $("<div />").kendoWindow({
        title: "Confirmar",
        resizable: false,
        modal: true
    });
        
    kendoWindow.data("kendoWindow")
    .content($("#votar-confirmation").html())
    .center().open();
        
    kendoWindow
    .find(".votar-confirm,.votar-cancel")
    .click(function() {
        if ($(this).hasClass("votar-confirm")) {
            $.ajax({
                url: action,
                data: {
                    id: pk
                },
                type: 'POST',
                dataType: 'html',
                success : function(html) {
                    alert(html);
                    $("#"+row).html( image );
                },
                error : function(xhr, status) {
                    alert( "Petición fallida: " + status + ' '+xhr.statusText );
                }
            });
        }
                
        kendoWindow.data("kendoWindow").close();
    })
    .end()
}

