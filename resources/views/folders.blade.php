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
        <li>
          <div class="well" id="folder_tree" ></div>
        </li>
      </ul>
      </div>
      <div class="col-sm-5">      
        <div class="row" style="padding-top:10px">
          <button type="button" class="btn btn-success btn-lg" style="width:160px" data-toggle="modal" data-target="#addFolder">ADD Folder</button>
        </div> 
        <div class="row" style="padding-top:10px">
          <button type="button" class="btn btn-info btn-lg" style="width:160px" data-toggle="modal" data-target="#renameFolder" id="selectRename">Rename Folder</button>
        </div> 
        <div class="row" style="padding-top:10px">
          <button type="button" class="btn btn-danger btn-lg" style="width:160px" data-toggle="modal" data-target="#deleteFolder" id="selectDelete">Delete Folder</button>
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
                    <input type="text" class="form-control"  style= "font-size:20px; padding:10px" value="New Folder" placeholder="insert a new folder name.." id = "addfolderInput">
                    <div class="input-group-append">
                      <button type="button" class="btn btn-primary"   style="width:80px" id = "addfolderBtn">Okay</button>
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

                <div class="modal-header" >
                  <h5 class="modal-title"><i class="material-icons" class="text-success" style="font-size:30px;color:#5bc0de">mode_edit</i></h5>
                  <span style="font-size:23px;">Folder Rename</span>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" style= "font-size:20px; padding:10px"  placeholder="insert that folder rename.."  id = "renamefolderInput">
                    <div class="input-group-append">
                      <button type="button" class="btn btn-primary"   style="width:80px" id ="renamefolderBtn">Okay</button>
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
                  <p id="folderDeleteSentence">Are you sure you want to delete</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                  <button type="button" class="btn btn-danger"  id = "deletefolderBtn">Delete</button>
                </div>
              </div>
            </div>
          </div>


      </div>
    </div>
</div>
<script>
var currentFolderId = 0 ;
var currentFolderName ="";
var jsonFolderDirInform = JSON.parse(<?php echo json_encode($jsonFolderDirInform);?>);
 
function insertNodeIntoTree(node, nodeId, newNode) {
  if (node.id == nodeId) {
      let n = 0;
      /** Your logic to generate new Id **/
      if (newNode) {
          node.children.push(newNode);
      }

  } else if (node.children != null) {
      for (let i = 0; i < node.children.length; i++) {
          insertNodeIntoTree(node.children[i], nodeId, newNode);
      }

  }
}
function updateNodeInTree(node, nodeId, rename) {
  if (node.id == nodeId) {
      node.name = rename;
      node.text = rename;
  } else if (node.children != null) {
      for (let i = 0; i < node.children.length; i++) {
          result = updateNodeInTree(node.children[i], nodeId, rename);
      }
  }
}

function deleteNodeFromTree(node, id) {
    if (node.children != null)  {
        for (let i = 0; i < node.children.length; i++) {
            let filtered = node.children.filter(f => f.id == id);
            if (filtered && filtered.length > 0) {
                node.children = node.children.filter(f => f.id != id);
                return;
            }
            console.log("deleteNdoeFromTree  :  " + node.id);
            deleteNodeFromTree(node.children[i], id);
        }
    }

}

var findSelectFlag = false ;
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
      findSelectFlag = true;
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
function FolderTreeDisplayFunc(){
  $(document).ready(function() {
    $('#folder_tree')
      .on("changed.jstree", function (e, data) {
        folder_dir=[];
        findSelectFlag = false ;
        getParent(jsonFolderDirInform[0] ,data.instance.get_node(data.selected[0]).id ,0);
        var txt_folder_dir=""; currentFolderName=" "
        if(findSelectFlag == true){
          for(var i = 0 ; i < folder_dir.length ; i++)
          {
            txt_folder_dir += folder_dir[i];
            if(folder_dir.length != i + 1){
              txt_folder_dir +=" > " ;
            }
          }
          currentFolderName = folder_dir[folder_dir.length-1] ;
        }
        currentFolderId = data.instance.get_node(data.selected[0]).id;
        $('#selected_folder').val(txt_folder_dir);
        $('#renamefolderInput').val(currentFolderName);
      })
      .jstree({
        'core' : {
        'data' : jsonFolderDirInform
      }
      });
  
    });
  }
FolderTreeDisplayFunc();
$(document).ready(function() {
  $('#addfolderBtn').on('click', function() {
    var NewFolderName =$('#addfolderInput').val();
    var updateNode =jsonFolderDirInform;

    var newNode =new Object();
    var date = new Date();
    newNode.id = date.getTime().toString() ;
    newNode.name = NewFolderName;
    newNode.text = NewFolderName;
    newNode.parent_id =currentFolderId;
    newNode.state ={};
    newNode.children =[];
    newNode.data={};
    newNode.a_attr ={"href":"google.com"};
    // console.log("current jsonFolderDirInform :" + jsonFolderDirInform);
    insertNodeIntoTree(jsonFolderDirInform[0],currentFolderId,newNode)
    // alert($('#addfolderInput').val());
    $('#folder_tree').jstree(true).settings.core.data = jsonFolderDirInform;
    $('#folder_tree').jstree(true).refresh();
    $('#addFolder').modal('hide');
  });

  $('#renamefolderBtn').on('click', function() {
    $('#folder_tree').jstree(true).settings.core.data = jsonFolderDirInform;
    var rename = $('#renamefolderInput').val();
    updateNodeInTree(jsonFolderDirInform[0], currentFolderId, rename);
    $('#folder_tree').jstree(true).refresh();
    $('#renameFolder').modal('hide');
    });
  
  $('#deletefolderBtn').on('click', function() { 
    $('#folder_tree').jstree(true).settings.core.data = jsonFolderDirInform;
    deleteNodeFromTree(jsonFolderDirInform[0],currentFolderId);
    $('#deleteFolder').modal('hide');
    $('#folder_tree').jstree(true).refresh();
  });

  $('#selectRename').on('click', function() {
    $('#renamefolderInput').val(currentFolderName);
  });
  $('#selectDelete').on('click', function() {
    if($('#selected_folder').val()==""){
      var deleteTxt = "Are you sure you want to delete empty?";
      $('#folderDeleteSentence').text(deleteTxt);
      var deleteTxt ="";
    }
    else{
      var deleteTxt = "Are you sure you want to delete" +" '" + currentFolderName + "'"+ " Folder ?";
      $('#folderDeleteSentence').text(deleteTxt);
      var deleteTxt ="";
    }
  });
});

    
</script>
@endsection
