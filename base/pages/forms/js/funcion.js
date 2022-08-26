$('#btnguardar').click(regresar);
function regresar(){
    $.ajax({
        url:'core/control_muro.php',
        type: 'post',
        dataType:'json',
        data:{
            codigo:('#codigo').val(),
            mensaje:$('#message').val()
        }
    }).done(
        function(data){
            alert('funciona');
           $('#message').val('');
        }
    );
}