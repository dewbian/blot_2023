<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />  
	<title>CKEditor 5 – classic editor build sample</title>
</head>
<body>

<header>
	
</header>

<main>
	
	<div class="centered">
		<div id="editor">
			
		</div>

		
		
	</div>
</main>
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/super-build/ckeditor.js"></script>  //-->

<script src="http://127.0.0.1:8000/vendor/ghost/ckeditor/superbuild/ckeditor.js"></script> 
<script src="http://127.0.0.1:8000/vendor/ghost/ckeditor/MyUploadAdapter.js"></script> 


<script>
     
 
     function MyCustomUploadAdapterPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                return new MyUploadAdapter( loader );
            };
        }
		CKEDITOR.ClassicEditor.create( document.querySelector( '#editor' ),  {"extraPlugins":  [MyCustomUploadAdapterPlugin] ,"toolbar":{"items":["findAndReplace","selectAll","|"],"shouldNotGroupWhenFull":true},"removePlugins":["ExportPdf","ExportWord","CKBox","CKFinder","EasyImage","Base64UploadAdapter","RealTimeCollaborativeComments","RealTimeCollaborativeTrackChanges","RealTimeCollaborativeRevisionHistory","PresenceList","Comments","TrackChanges","TrackChangesData","RevisionHistory","Pagination","WProofreader","MathType"]}   )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( error => {
			console.log(  error );
		} );


    
        // CKEDITOR222.ClassicEditor.create( document.querySelector( '#editor' )
        // ,{
        //     "extraPlugins": [ MyCustomUploadAdapterPlugin ] ,             
        //     "toolbar":{
        //         "items": [
        //             "findAndReplace","selectAll","|",
        //             "heading","|",
        //             "bold","italic","strikethrough","underline","code", "subscript","superscript","removeFormat","|",
        //             "bulletedList","numberedList","|",
        //             "outdent","indent","|",
        //             "undo","redo",
        //             "-",
        //             "fontColor","fontBackgroundColor","|",
        //             "alignment","|",
        //             "link","insertImage","blockQuote","insertTable", "mediaEmbed","|",
        //             "horizontalLine","|",
        //             "sourceEditing"
        //         ],
        //         "shouldNotGroupWhenFull": true
        //     },
        //     "language" : 'kr', 
        //     "removePlugins":["ExportPdf","ExportWord","CKBox","CKFinder","EasyImage","Base64UploadAdapter","RealTimeCollaborativeComments",
        //         "RealTimeCollaborativeTrackChanges","RealTimeCollaborativeRevisionHistory","PresenceList","Comments","TrackChanges",
        //         "TrackChangesData","RevisionHistory","Pagination","WProofreader","MathType"
        //     ],
        //     "fontSize":  {"options":[9,11,13,"default",17,19,21]},
        //     // "simpleUpload":{"headers":{"X-CSRF-TOKEN":"3mN5MRIbx3wwrKfbEPMBk9ycfAPID6ZQHt6nQgRd"}}, 
        // })
		// .then( editor => {
		// 	window.editor = editor;
		// } )
		// .catch( error => {
		// 	console.log(  error );
		// } );


    // CKEDITOR.ClassicEditor 
    // .create( document.querySelector( '#editor' )         
    // , { 
            
	// 		  extraPlugins: [ MyCustomUploadAdapterPlugin ]   ,
    //         toolbar: {
    //             items: [ 
    //                 'findAndReplace', 'selectAll', '|',
    //                 'heading', '|',
    //                 'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
    //                 'bulletedList', 'numberedList', '|',
    //                 'outdent', 'indent', '|',
    //                 'undo', 'redo',
    //                 '-',
    //                 'fontColor', 'fontBackgroundColor', '|',
    //                 'alignment', '|',
    //                 'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
    //                  'horizontalLine', '|',
    //                  'sourceEditing'
    //             ],
    //             shouldNotGroupWhenFull: true
    //         }, 
    //         language: 'kr', 
    //         // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
    //         heading: {
    //             options: [
    //                 { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
    //                 { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
    //                 { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
    //                 { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
    //                 { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
    //                 { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
    //                 { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
    //             ]
    //         },
    //         // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
    //         placeholder: 'Insert into ',
    //         // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
    //         fontFamily: {
    //             options: [
    //                 'default',
    //                 'Arial, Helvetica, sans-serif',
    //                 'Courier New, Courier, monospace',
    //                 'Georgia, serif',
    //                 'Lucida Sans Unicode, Lucida Grande, sans-serif',
    //                 'Tahoma, Geneva, sans-serif',
    //                 'Times New Roman, Times, serif',
    //                 'Trebuchet MS, Helvetica, sans-serif',
    //                 'Verdana, Geneva, sans-serif'
    //             ],
    //             supportAllValues: true
    //         },
    //         // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
    //         fontSize: {
    //             options: [ 10, 12, 14, 'default', 18, 20, 22 ],
    //             supportAllValues: true
    //         },
    //         // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
    //         // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
    //         htmlSupport: {
    //             allow: [
    //                 {
    //                     name: /.*/,
    //                     attributes: true,
    //                     classes: true,
    //                     styles: true
    //                 }
    //             ]
    //         },
    //         // Be careful with enabling previews
    //         // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
    //         htmlEmbed: {
    //             showPreviews: true
    //         },
    //         // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
    //         link: {
    //             decorators: {
    //                 addTargetToExternalLinks: true,
    //                 defaultProtocol: 'https://',
    //                 toggleDownloadable: {
    //                     mode: 'manual',
    //                     label: 'Downloadable',
    //                     attributes: {
    //                         download: 'file'
    //                     }
    //                 }
    //             }
    //         }, 
    //         removePlugins: [
    //             'ExportPdf',
    //             'ExportWord',
    //             'CKBox',
    //             'CKFinder',
    //             'EasyImage',
    //             'Base64UploadAdapter',
    //             'RealTimeCollaborativeComments',
    //             'RealTimeCollaborativeTrackChanges',
    //             'RealTimeCollaborativeRevisionHistory',
    //             'PresenceList',
    //             'Comments',
    //             'TrackChanges',
    //             'TrackChangesData',
    //             'RevisionHistory',
    //             'Pagination',
    //             'WProofreader',
    //             'MathType'
    //         ], 
    //         }
    // )
    // .catch( error => {
    //     console.error( error );  });




</script> 




</body>
</html>
