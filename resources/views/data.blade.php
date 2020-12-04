@extends('home')

@section('main_area')
<!-- <h1><?php echo gettype($jsonDataInformDir) ?></h1> -->
<?php
  function js_str($s)
  {
      return '"' . addcslashes($s, "\0..\37\"\\") . '"';
  }

  function js_array($array)
  {
      $temp = array_map('js_str', $array);
      return '[' . implode(',', $temp) . ']';
  }
  // echo 'var cities = ', js_array($jsonDataInformDir ), ';';
?>
<div class="container">
  <div class="row" style="margin-top:50px;">
    {{ csrf_field() }}
    <div class="col-sm-10"> 
      <div class="tab-content">
        <div class="tab-pane container active" id="datas_area">
          <div class="text-right" >
              <form method="POST" id="contact" name="13" class="form-horizontal wpc_contact" novalidate="novalidate" enctype="multipart/form-data">
                  <fieldset>
                      <div class="control-group">
                          <!-- File Upload --> 
                          {{ csrf_field() }}
                          <input class="input-file" id="fileInput" type="file" id="fileToUpload" name="fileToUpload">
                          <button class="btn btn-success" id="wpc_contact">Button</button>
                      </div>
                  </fieldset>
              </form>           
            <!-- <form action=" {{URL::to('/xlsxuploadingToJson')}}" method="post" enctype="multipart/form-data">
              Select image to upload:
              {{ csrf_field() }}
              <input type="file" name="fileToUpload" id="fileToUpload">
              <input type="submit" value="Upload xlsx" name="submit">
            </form> -->
          </div>
          <table id="datas_table" class="display" width="100%"></table>
        </div>
      </div>
    </div>
  </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />
<script>
  
    var dataUrlArray = JSON.parse(<?php echo json_encode($jsonDataInformDir);?>);
    
    function datatUrlPrint(srcData){
      // alert(srcData.length);
      $(document).ready(function() {
        var dataTable= $('#datas_table').DataTable( {
              data: srcData,
              paging: false,
              destroy: true,
              paging: true,
              columns: [
                  { title: "Name data"},
                  { title: "Create date" },
                  { title: "Author" }
              ],
          } );
      } );

  }
  datatUrlPrint(dataUrlArray);
    // table data end------------------
        //     url: "{{ url('/xlsxuploadingToJson') }}",

//  xlsx file upload begin
  var form = $('form')[0]; // You need to use standard javascript object here
  var formData = new FormData(form);
  var formData = new FormData();
  var src_jsonDataFileArray = [];
    $('.wpc_contact').submit(function(event){
       event.preventDefault();
        formData.append('fileToUpload', $('input[type=file]')[0].files[0]); 
        console.log( $('input[type=file]')[0].files[0]);
        $.ajax({

            url: "{{ url('/xlsxuploadingToJson') }}",
            headers: {
				               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
            enctype: 'multipart/form-data',
            data: formData,
            type: 'POST',
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
            success : function(data){
              var contact = JSON.parse(data);  
              dataUrlArray = contact;
              datatUrlPrint(dataUrlArray);
            },
            error : function(data){
              console.log("error" , data); 
            }
        });
        // alert(src_jsonDataFileArray); 
        
   });
//  xlsx file upload end
</script>
@endsection
