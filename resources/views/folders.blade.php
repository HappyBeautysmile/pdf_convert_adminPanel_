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
<meta name="_token" content="{!! csrf_token() !!}" />

<script>
var currentFolderId = 0 ;
var currentFolderName ="";
var jsonFolderDirInform = JSON.parse(<?php echo json_encode($jsonFolderDirInform);?>);

// [{"id":"0","name":"ResourceData","text":"ResourceData","parent_id":"111","state":{"opened":"true"},"children":[{"id":"100","name":"PROJECTS","text":"PROJECTS","parent_id":"0","state":{"selected":"true"},"a_attr":{"href":"google.com"},"childeren":[{"id":"1607023252945","name":"New Folder","text":"New Folder","parent_id":"100","a_attr":{"href":"google.com"}}]},{"id":"200","name":"IMAGES","text":"IMAGES","parent_id":"0","children":[{"id":"1607023060928","name":"New Folder","text":"New Folder","parent_id":"200","a_attr":{"href":"google.com"}},{"id":"1607023201681","name":"new","text":"new","parent_id":"200","a_attr":{"href":"google.com"}}],"a_attr":{"href":"google.com"}},{"id":"300","name":"ALL PDF","text":"ALL PDF","parent_id":"0","children":[{"id":"1607023079560","name":"New Folder","text":"New Folder","parent_id":"300","a_attr":{"href":"google.com"}},{"id":"1607023186737","name":"teste","text":"teste","parent_id":"300","a_attr":{"href":"google.com"}},{"id":"1607023194841","name":"new","text":"new","parent_id":"300","a_attr":{"href":"google.com"}}],"a_attr":{"href":"google.com"}},{"id":"400","name":"ALL PROJECT","text":"ALL PROJECT","parent_id":"0","children":[{"id":"1607023068377","name":"New Folder","text":"New Folder","parent_id":"400","a_attr":{"href":"google.com"}}],"a_attr":{"href":"google.com"}},{"id":"1","name":"DATA","text":"DATA","parent_id":"0","children":[{"id":"2","name":"2020","text":"2020","parent_id":"1","children":[{"id":"7","name":"Janvier","text":"Janvier","parent_id":"2","a_attr":{"href":"google.com"}}],"a_attr":{"href":"google.com"}}],"a_attr":{"href":"google.com"}}],"a_attr":{"href":"google.com"}}]
var existFolder = false ;
console.log(jsonFolderDirInform);
function insertNodeIntoTree(node, nodeId, newNode) {
  if (node.id == nodeId) {
      let n = 0;
      /** Your logic to generate new Id **/
      if (newNode) {

        if(node.children === undefined){
          node.children= [newNode];
        }
        else{
          for (let i = 0 ; i < node.children.length ; i++)
          {
            if(node.children[i].name == newNode.name)
            {
              existFolder = true ;
              alert("The folder name exists");

            }
          }
          if(existFolder == false)
          {
            node.children.push(newNode);
          }
        }
        // node.children.push(newNode);
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
var addFolderDir ="" ;
var reanFolderDir ="";
var renameFolderDir ="" ;
var deleteFolderDir ="" ;
var deleteFolderDir ="" ;
 
function FolderTreeDisplayFunc(){
  $(document).ready(function() {
    $('#folder_tree')
      .on("changed.jstree", function (e, data) {
        folder_dir=[];
        findSelectFlag = false ;
        getParent(jsonFolderDirInform[0] ,data.instance.get_node(data.selected[0]).id ,0);
        var txt_folder_dir=""; currentFolderName=" "
        if(findSelectFlag == true){
          addFolderDir ="" ,renameFolderDir ="",deleteFolderDir="";
          for(var i = 0 ; i < folder_dir.length ; i++)
          {
            txt_folder_dir += folder_dir[i];
            if(folder_dir.length != i + 1){
              txt_folder_dir +=" > " ;
              renameFolderDir = renameFolderDir + folder_dir[i] + '/' 
              deleteFolderDir = deleteFolderDir + folder_dir[i] + '/' 
            }
            addFolderDir = addFolderDir + folder_dir[i] + '/' 
          }
          alert(addFolderDir);
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
    alert("id :" + newNode.id + "  name: " + newNode.name + "  " );
    // console.log("current jsonFolderDirInform :" + jsonFolderDirInform);
    insertNodeIntoTree(jsonFolderDirInform[0],currentFolderId,newNode)
    $('#addFolder').modal('hide');
    // alert("exsitFolder  :  " +existFolder);
    if(existFolder == false)
    {
      $.ajax({
            type:"POST",
            url: "{{ url('/addFolder') }}",
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            data: {"folderName" : newNode.name ,"addFolderDir":addFolderDir ,"jsonFolderDirInform" : jsonFolderDirInform},
            success:function(data){
              alert("create " + "'" + newNode.name + "'" + " folder!");
            }, 
            error: function (xhr, ajaxOptions, thrownError) {
              alert("Already floder exist!");
            }

          }).done(function() {
            $( this ).addClass( "done" );
      });
      $('#folder_tree').jstree(true).settings.core.data = jsonFolderDirInform;
      $('#folder_tree').jstree(true).refresh();
    }
    existFolder = false ;
  });

  $('#renamefolderBtn').on('click', function() {
    $('#folder_tree').jstree(true).settings.core.data = jsonFolderDirInform;
    var rename = $('#renamefolderInput').val();
    updateNodeInTree(jsonFolderDirInform[0], currentFolderId, rename);
    $('#folder_tree').jstree(true).refresh();
    $('#renameFolder').modal('hide');
    // alert(renameFolderDir +currentFolderName +" change name : " + renameFolderDir +rename );
    $.ajax({
          type:"POST",
          url: "{{ url('/renameFolder') }}",
          headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
          data: {"folderName" : currentFolderName ,"rename": rename,"renameFolderDir":renameFolderDir ,"jsonFolderDirInform" : jsonFolderDirInform},
          success:function(data){
            alert("change the name" + " from " +"'"+ currentFolderName + " ' " +" folder " + " to " + "'" + rename +"' " +"folder" +'!');
          }, 
          error: function (xhr, ajaxOptions, thrownError) {
            alert("change name faild!");
          }

        }).done(function() {
          $( this ).addClass( "done" );
    });
  });
  
  $('#deletefolderBtn').on('click', function() { 
    $('#folder_tree').jstree(true).settings.core.data = jsonFolderDirInform;
    deleteNodeFromTree(jsonFolderDirInform[0],currentFolderId);
    $('#deleteFolder').modal('hide');
    $('#folder_tree').jstree(true).refresh();
    alert("deleteFolderDir "+deleteFolderDir + currentFolderName );
    var deletedFolderName = currentFolderName;
    alert("cur : " + currentFolderName);
    $.ajax({
          type:"POST",
          url: "{{ url('/deleteFolder') }}",
          headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
          data: {"folderName" : currentFolderName , "deleteFolderDir":deleteFolderDir ,"jsonFolderDirInform" : jsonFolderDirInform},
          success:function(data){
            alert("success " +"'" + deletedFolderName + "'"+ " delete");
          }, 
          error: function (xhr, ajaxOptions, thrownError) {
            alert("delete folder faild");
          }

        }).done(function() {
          $( this ).addClass( "done" );
    });
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
