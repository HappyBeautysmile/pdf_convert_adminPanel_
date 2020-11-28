@extends('home')

@section('main_area')
<style>
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}
.select_lable{
  font-size:20px;
  text-align:right;
  font-weight: bold;
}
</style>
<div class="container">

<script>
  function getSourceFiles()
  {
    <?php
      $soureDir = "./Home1/uploads/media/";
      // Sort in descending order
      // $src_pdfFileArray = scandir($dir,1);
      $src_pdfFileArray = scandir($soureDir,0);
      $currentPdfPageIndex = 4;
      // print_r($a);
      $currentPdfPageName=$src_pdfFileArray[2];
      //convert php array to javascript array _____begin
      function js_str($s)
      {
          return '"' . addcslashes($s, "\0..\37\"\\") . '"';
      }

      function js_array($array)
      {
          $temp = array_map('js_str', $array);
          return '[' . implode(',', $temp) . ']';
      }
      //convert php array to javascript array _____end
      // echo 'var cities = ', js_array($src_pdfFileArray), ';';
      $src_pdfFile = "./Home1/uploads/media/".$currentPdfPageName;
    ?>
  }
</script>
<div class="container">
    <div class="row" style="margin-top:50px;">
        <div class="col-sm-2 select_lable">Select FOLDER</div>
        <div class="col-sm-9"> 
            <p>
            <input class="col-sm-10" placeholder="select folder..." oninput="this.className = ''" name="selected_folder" disabled id="selected_folder">
            <button type="button" class="btn btn-success btn-lg"name="select_folder_btn"  data-toggle="modal" data-target="#folder" >SELECT</button> 
            </p>
        </div>
    </div>
    <div class="modal fade" id="folder">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h1 class="modal-title">Select Folder</h1>
            <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <ul class="nav nav-tabs flex-column">
                <li>HOME
                    <div class="well" id="folder_tree"></div>
                    </li>
                </ul>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            
        </div>
    </div>
</div>
  <center><h2 class="text-success">PDF Preview</h2></center>
  <div class="row">
    <div class="col-sm-4" style="">
      <div class="" style="height: 50%;padding-top:30px;">
      </div>
      <div class="" style="height: 50%;">
        <button type="button" class="btn btn-outline-info btn-lg" style="float:left" id="backPdfViewBtn" onclick="nextPdfFunc(-1)"><span><i class="fa fa-hand-o-left" style="font-size:25px"></i> BACK </span> </button>
        <button type="button" class="btn btn-outline-info btn-lg" style="float:right" id="nextPdfViewBtn" onclick="nextPdfFunc(1)"><span>NEXT <i class="fa fa-hand-o-right" style="font-size:25px"></i></span> </button>
      </div>
    </div>
    <div class="col-sm-8" style="">
      <iframe src="" id="pdfView" width="100%" height="500px">
      </iframe>
    </div>
  </div>
</div>
<script>
  var srcPdfFileArray = <?php echo js_array($src_pdfFileArray);?>;//convert php array to javascript array
  var currentPdfPageIndex = <?php echo $currentPdfPageIndex?>;
  var sourceDir ="./Home1/uploads/media";
  var folder_dir =["ok"];

    function nextPdfFunc(index)
    {
        if(folder_dir[0]!="ok")
        {
            document.getElementById("pdfView").src=sourceDir + "/" + srcPdfFileArray[currentPdfPageIndex];
            $(document).ready(function() {
                if(currentPdfPageIndex + index + 1== srcPdfFileArray.length)
                {
                $("#nextPdfViewBtn").addClass("disabled");
                $("#nextPdfViewBtn").prop('disabled',true);
                
                }
                else if(currentPdfPageIndex < srcPdfFileArray.length)
                {
                $("#nextPdfViewBtn").removeClass("disabled");
                $("#nextPdfViewBtn").prop('disabled',false);
                }
                if(currentPdfPageIndex + index == 2)
                {
                $("#backPdfViewBtn").addClass('disabled');
                $("#backPdfViewBtn").prop('disabled',true);
                }
                else if(currentPdfPageIndex > 1)
                {
                $("#backPdfViewBtn").removeClass('disabled');
                $("#backPdfViewBtn").prop('disabled',false);
                }
                if(currentPdfPageIndex + index > 1  && currentPdfPageIndex + index < srcPdfFileArray.length){
                currentPdfPageIndex += index ;
                }
                // alert(currentPdfPageIndex + "   " +srcPdfFileArray[currentPdfPageIndex]);
                // alert(currentPdfPageIndex);
                document.getElementById("pdfView").src= sourceDir + "/" + srcPdfFileArray[currentPdfPageIndex];

            });

        }
    }

  var jsonTreeData =
        [
            {"id":"100","name":"PROJECTS","text":"PROJECTS","parent_id":"0",    "data":{},
                "a_attr":{"href":"google.com"}
            },
            {"id":"200","name":"IMAGES","text":"IMAGES","parent_id":"0",    "data":{},
                "a_attr":{"href":"google.com"}
            },
            {"id":"300","name":"ALL PDF","text":"ALL PDF","parent_id":"0",    "data":{},
                "a_attr":{"href":"google.com"}
            },
            {"id":"00","name":"ALL PDF","text":"ALL PROJECT","parent_id":"0",    "data":{},
                "a_attr":{"href":"google.com"}
            },
            {"id":"1","name":"Electronics","text":"Electronics","parent_id":"0",
                    "children":[
                        {
                            "id":"2","name":"Mobile","text":"Mobile","parent_id":"1",
                            "children":[
                                {"id":"7","name":"Samsung","text":"Samsung","parent_id":"2","children":[],"data":{},"a_attr":{"href":"google.com"}},
                                {"id":"8","name":"Apple","text":"Apple","parent_id":"2","children":[],"data":{},"a_attr":{"href":"google.com"}}
                            ],
                            "data":{},
                            "a_attr":{"href":"google.com"}
                        },
                        {
                            "id":"3","name":"Laptop","text":"Laptop","parent_id":"1",
                            "children":[
                                {"id":"4","name":"Keyboard","text":"Keyboard","parent_id":"3","children":[],"data":{},"a_attr":{"href":"google.com"}},
                                {"id":"5","name":"Computer Peripherals","text":"Computer Peripherals","parent_id":"3",
                                    "children":[
                                        {"id":"6","name":"Printers","text":"Printers","parent_id":"5","children":[],"data":{},"a_attr":{"href":"google.com"}},
                                        {"id":"10","name":"Monitors","text":"Monitors","parent_id":"5","children":[],"data":{},"a_attr":{"href":"google.com"}}
                                    ],
                                    "data":{},"a_attr":{"href":"google.com"}},
                                {"id":"11","name":"Dell","text":"Dell","parent_id":"3","children":[],"data":{},"a_attr":{"href":"google.com"}}
                            ],
                            "data":{},
                            "a_attr":{"href":"google.com"}
                        }
                    ],
                    "data":{},
                    "a_attr":{"href":"google.com"}
                }
        ];
    function generatePossible()
    {
      $(document).ready(function() {
        if($('#selected_folder').val() !="" &&  $('#selected_data').val() !="")
        {
          $('#generator').removeClass('disabled');
          $( "#generator" ).prop( "disabled", false );
        }
        else{
          $('#generator').addClass('disabled');
          $( "#generator" ).prop( "disabled", true );

        }
        // alert($('#selected_folder').val());
      });
    }
    // select folder tree event -begin-*******************
    $(document).ready(function() {
      $('#folder_tree')
        .on("changed.jstree", function (e, data) {
          if(data.selected.length) {
            if(data.instance.get_node(data.selected[0]).children.length ==0)
            {
              function getParent(tree, childNode, index)
              {
                var i, res;
                if (tree!="[object Object]" || !tree.children.length) {
                  return null;
                }
                for (var i = 0 ;i < tree.children.length; i++) {
                  if (tree.children[i].id == childNode) {
                    folder_dir[index++] = tree.name ;
                    folder_dir[index++] = tree.children[i].name ;
                    return tree;
                  }
                  if(tree.children[i].children != null && tree.children[i].children.length > 0){
                    folder_dir[index] = tree.name ;
                    res = getParent(tree.children[i], childNode, index + 1);
                    if (res) {
                      return res;
                    }
                  }
                }
                return null;
              }
              folder_dir=[];
              for(var i = 0 ; i < jsonTreeData.length ; i++)
              {
                folder_dir[0] = jsonTreeData[i].name;
                if(data.instance.get_node(data.selected[0]).id == jsonTreeData[i].id)
                {
                  break;
                }
                if(jsonTreeData[i].children !=null)
                {
                  getParent(jsonTreeData[i] ,data.instance.get_node(data.selected[0]).id ,0);
                }
              }
              // alert(folder_dir);
              // $('#selected_data').val( table.row( this ).data()[0]);
              var txt_folder_dir=""
              for(var i = 0 ; i < folder_dir.length ; i++)
              {
                txt_folder_dir += folder_dir[i];
                if(folder_dir.length != i + 1){
                  txt_folder_dir +=" > " ;
                }
              }
              $('#selected_folder').val(txt_folder_dir);
            //   alert(folder_dir[0]);
              currentPdfPageIndex = 2;
            nextPdfFunc(currentPdfPageIndex);
              generatePossible();
              $('#folder').modal('hide')
            }
          }
        })
        .jstree({
          'core' : {
          'data' : jsonTreeData
        }
        });
    } );
    
</script>
</div>

@endsection
