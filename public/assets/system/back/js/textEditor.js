ClassicEditor
	.create( document.querySelector( '#postContent' ), {
		ckfinder: {
			uploadUrl: 'http://localhost:70/orion-v1/public/assets/system/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
		},
		toolbar: [ 'ckfinder', '|', 'heading', '|', 'bold', 'italic', '|', 'numberedList', 'bulletedList', 'fontsize', 'undo', 'redo' ]
	} )
	.catch( error => {
		console.error( error );
    } );
    

ClassicEditor
.create( document.querySelector( '#pageContent' ), {
    ckfinder: {
        uploadUrl: 'http://localhost:70/orion-v1/public/assets/system/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
    },
    toolbar: [ 'ckfinder', '|', 'heading', '|', 'bold', 'italic', '|', 'numberedList', 'bulletedList', 'fontsize', 'undo', 'redo' ]
} )
.catch( error => {
    console.error( error );
} );