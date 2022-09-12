import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

if(document.querySelector("#dropzone"))
{
    const dropzone = new Dropzone('#dropzone',{
        dictDefaultMessage:'Sube aqui tu imagen',
        acceptedFiles:".png,.jpg,.jpeg,.gif",
        addRemoveLinks:true,
        dictRemoveFile:'Borrar archivo',
        maxFiles:1,
        uploadMultiple:false,

        init: function(){
            // alert('dropzone eee')
            if(document.querySelector('input[name="imagen"]') && document.querySelector('input[name="imagen"]').value.trim()){
                const imagenPublicada = {}
                imagenPublicada.size = 1234;
                imagenPublicada.name = document.querySelector('input[name="imagen"]').value.trim();

                this.options.addedfile.call(this, imagenPublicada);
                this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

                imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
            }
        }
    });
    /*
    dropzone.on('sending', function(file, xhr, formdata) {
        console.log(formdata);
    });
    */
    dropzone.on('success', function(file, response){
        document.querySelector('input[name="imagen"]').value = response.imagen;
    });
    /*
    dropzone.on('error', function(file, message){
        console.log(message)
    });

    dropzone.on('removedfile', function(){
        console.log('Archivo eliminado')
    });
    */

    /* Eliminar imagen */

    dropzone.on('removedfile', function(){
        document.querySelector('input[name="imagen"]').value = '';
    })

}