
(async ()=>{
    const {value : pass} =  Swal.fire({
        title:'IMPORTANTE!',
         text:'Por favor cambiar la contraseña temporal. ',
        // html:
         icon:'warning',
        // confirmButtonText:
        // footer:
        // width:
         padding:'1rem',
        // background:
        // grow:
         backdrop:true,
        // timer:
        // timerProgressBar:
        // toast:
         position:'center',
         allowOutsideClick: false,
         allowEscapeKey: false, 
         allowEnterKey: false,
         stopKeydownPropagation: false,
    
         input: 'password',
         inputPlaceholder: '123' ,
        inputValue:'',
        // inputOptions:
        
        //  customClass:
        // 	container:
        // 	popup:
        // 	header:
        // 	title:
        // 	closeButton:
        // 	icon:
        // 	image:
        // 	content:
        // 	input:
        // 	actions:
        // 	confirmButton:
        // 	cancelButton:
        // 	footer:	
    
         showConfirmButton:true,
         confirmButtonColor:'#dc3545',
         confirmButtonAriaLabel:'Confirmar'
    
        // showCancelButton:
        // cancelButtonText:
        // cancelButtonColor:
        // cancelButtonAriaLabel:
        
        // buttonsStyling:
        // showCloseButton:
        // closeButtonAriaLabel:
    
    
        // imageUrl:
        // imageWidth:
        // imageHeight:
        // imageAlt:
    });
    if(pass)
    {
      //  Swal.fire({
          //  html: 'Cambio hecho con exito!',
            //confirmButtonText:'Aceptar',
           // icon: 'info',
           /// padding:'1rem',
           // grow: 'row',
           // backdrop: true,
           // toast: true,
            //pasition: 'botton',
            //allowOutsideClick: ture,
            //allowEscapeKey:false,
            //stopKeydownPropagation: false,
           // showConfirmButton: true,
            //showCancelButton: false,
            //showCloseButton: true
            
        //});
    }
})()

