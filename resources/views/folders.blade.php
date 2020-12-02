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
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"></head>
<div class="container">
  <div class = "row" style="margin-top:50px;">
      <div class="col-sm-2 select_lable">Selected FOLDER</div>
      <div class="col-sm-9"> 
          <p>
          <input class="col-sm-10" placeholder="select folder..." oninput="this.className = ''" name="selected_folder" disabled id="selected_folder">
          </p>
      </div>
  </div>
  <div class = "row">
    <div class="col-sm-7">
      <ul class="nav nav-tabs flex-column">
        <li>ConvertPDF
          <div class="well" id="folder_tree" ></div>
        </li>
      </ul>
      </div>
      <div class="col-sm-5">      
        <div class="row" style="padding-top:10px">
          <button type="button" class="btn btn-success btn-lg" style="width:160px" data-toggle="modal" data-target="#addFolder">ADD Folder</button>
        </div> 
        <div class="row" style="padding-top:10px">
          <button type="button" class="btn btn-info btn-lg" style="width:160px" data-toggle="modal" data-target="#renameFolder">Rename Folder</button>
        </div> 
        <div class="row" style="padding-top:10px">
          <button type="button" class="btn btn-danger btn-lg" style="width:160px" data-toggle="modal" data-target="#deleteFolder">Delete Folder</button>
        </div> 

          <!-- Add New Folder Modal -->
          <div class="modal fade" id="addFolder" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title"><i class="material-icons" style="font-size:30px;color:#5cb85c">create_new_folder</i></h5>
                  <span style="font-size:23px;">Add Folder</span>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control"  style= "font-size:20px; padding:10px" placeholder="insert a new folder name..">
                    <div class="input-group-append">
                      <button type="button" class="btn btn-primary"   style="width:80px"data-dismiss="modal">Okay</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Rename Folder Modal -->
          <div class="modal fade" id="renameFolder" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title"><i class="material-icons" class="text-success" style="font-size:30px;color:#5bc0de">mode_edit</i></h5>
                  <span style="font-size:23px;">Folder Rename</span>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" style= "font-size:20px; padding:10px"  placeholder="insert that folder rename..">
                    <div class="input-group-append">
                      <button type="button" class="btn btn-primary"   style="width:80px"data-dismiss="modal">Okay</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- Delete Folder Modal -->

          <div class="modal fade" tabindex="-1" id='deleteFolder'>
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"> <i class="material-icons" style="font-size:30px;color:#d9534f">delete</i></h5><span style="font-size:23px;">Delete !</span>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to Delete ?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                  <button type="button" class="btn btn-danger">Delete</button>
                </div>
              </div>
            </div>
          </div>


      </div>
    </div>
   
</div>
<script>

var currentNodeId = 0 ;
 var jsonTreeData =
    [
        {"id":"100","name":"PROJECTS","text":"PROJECTS","parent_id":"0",  "state" : { "disabled" : false } ,   "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"200","name":"IMAGES","text":"IMAGES","parent_id":"0",   "state" : { "disabled" : false } ,  "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"300","name":"ALL PDF","text":"ALL PDF","parent_id":"0",  "state" : { "disabled" : false }  ,  "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"400","name":"ALL PDF","text":"ALL PROJECT","parent_id":"0", "state" : { "disabled" : false } ,   "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"1","name":"DATA","text":"DATA","parent_id":"0","state" : { "opened" : true },
                "children":[
                    {
                        "id":"2","name":"2020","text":"2020","parent_id":"1","state" : { "opened" : true },
                        "children":[
                            {"id":"7","name":"Janvier","text":"Janvier","parent_id":"2","state" : { "selected" : true }, "children":[],"data":{},"a_attr":{"href":"google.com"}}
                        ],
                        "data":{},
                        "a_attr":{"href":"google.com"}
                    }
                ],
                "data":{},
                "a_attr":{"href":"google.com"}
            }
    ];
    $(document).ready(function() {
      $('#folder_tree')
        .on("changed.jstree", function (e, data) {
          folder_dir=[];
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
          var txt_folder_dir=""
          for(var i = 0 ; i < folder_dir.length ; i++)
          {
            txt_folder_dir += folder_dir[i];
            if(folder_dir.length != i + 1){
              txt_folder_dir +=" > " ;
            }
          }
          currentNodeId = data.instance.get_node(data.selected[0]).id;
          // alert("currentNodeId    " + currentNodeId);
          $('#selected_folder').val(txt_folder_dir);
        })
        .jstree({
          'core' : {
          'data' : jsonTreeData
        }
        });
    } );


</script>
@endsection
