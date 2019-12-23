tinymce.init({
			    selector: 'textarea',
			    plugins: ["advlist autolink lists link image charmap print preview anchor",
		        "searchreplace visualblocks code fullscreen",
		        "insertdatetime media table contextmenu paste"],
			    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			    images_upload_url: 'upload.php',
			    height: 350,
			    language: "fr_FR",
			    style_formats: [
			    {
			        title: 'Image Left',
			        selector: 'img',
			        styles: {
			            'float': 'left', 
			            'margin': '10px 10px 10px 0'
			        }
			     },
			     {
			         title: 'Image Right',
			         selector: 'img', 
			         styles: {
			             'float': 'right', 
			             'margin': '10px 0 10px 10px'
			         }
			     }
				],
			    images_upload_handler: function (blobInfo, success, failure) {
			        var xhr, formData;
			      
			        xhr = new XMLHttpRequest();
			        xhr.withCredentials = false;
			        xhr.open('POST', 'vendor/tinymce/upload/upload.php');
			      
			        xhr.onload = function() {
			            var json;
			        
			            if (xhr.status != 200) {
			                failure('HTTP Error: ' + xhr.status);
			                return;
			            }
			        
			            json = JSON.parse(xhr.responseText);
			        
			            if (!json || typeof json.location != 'string') {
			                failure('Invalid JSON: ' + xhr.responseText);
			                return;
			            }
			        
			            success(json.location);
			        };
			      
			        formData = new FormData();
			        formData.append('file', blobInfo.blob(), blobInfo.filename());
			      
			        xhr.send(formData);
			    },
			});