    <!--   ------------------------------------------pop up------------------------------------------------------>




  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" onclick="CloseUploadPicturesModel()">&times;</button>
          <h2 class="modal-title"> Upload PG Pictures </h2>
        </div>
        <div class="modal-body">

 
<form action="upload.php" class="dropzone" id="uploadFile" name="uploadFile" method="POST">
        <span id="tmp-path"></span>
    </form>
You Have To Choose At least One Picture

    

        </div>
        <div class="modal-footer">
          <button type="button" onclick="CloseUploadPicturesModel()" class="btn11 btn-default">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!--    ----------------------------------------------------------end model and images popup--------------------------->