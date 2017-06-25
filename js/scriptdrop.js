!function($){$(document).ready(function(){
         Dropzone.autoDiscover = false;
            
            Dropzone.options.uploadFile = {
                maxFiles: 4,
                maxFilesize: 1,
                
                accept: function(file, done) {
    console.log("uploaded");
    done();
  },
              init: function() {
                this.on("success", function(file, responseText) {
                 //   alert(responseText);
               //  file.previewTemplate.appendChild(document.createTextNode(responseText));
                });
                
                this.on("sending", function(file) {
                    $("#tmp-path").html('<input type="hidden" name="path" value="'+file.fullPath+'" />')
                });      
          
              },
               acceptedFiles: "image/*"
    
  
            }; 
            
            var myDropzone = new Dropzone("#uploadFile", { 
                url: "upload.php"
            });               
      
});}(jQuery);