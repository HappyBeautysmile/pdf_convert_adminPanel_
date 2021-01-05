@extends('home')
@section('main_area')
<style>
.modal-roni{width:95%!important;padding:2rem!important}.modal-roni-button{width:100px!important}
</style>
<div class="container">
	<div class = "row" style="margin-top:30px;">
		<div class="col-md-3">
			<div style="padding-bottom:10px"><button type="button" class="btn btn-success" style="width:200px" data-toggle="modal" data-target="#addFolder"><i class="fa fa-plus" aria-hidden="true"></i> Ajouter un dossier</button></div>
			<div style="padding-bottom:10px"><button type="button" class="btn btn-danger" style="width:200px;" data-toggle="modal" data-target="#deleteFolder" id="selectDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Suprimmer un dossier</button></div>
			<div style="padding-bottom:10px"><button type="button" class="btn btn-info" style="width:200px;" data-toggle="modal" data-target="#renameFolder" id="selectRename"><i class="fa fa-refresh" aria-hidden="true"></i> Renommer un dossier</button></div>
		</div>
		<div class="col-md-9">
			<div class="input-group input-group-lg" style="margin-bottom:15px;">
				<div class="input-group-prepend">
					<span class="input-group-text text-dark" id="inputGroup-sizing-lg" style="background-color: fafafa;">Vous êtes ici : </span>
				</div>
				<input class="form-control bg-light lead" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" oninput="this.className = ''" name="selected_folder" disabled id="selected_folder">
			</div>
			<div class="well" id="folder_tree" ></div>
		</div>
	</div>
	<div class="modal fade" id="addFolder" role="dialog">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content modal-roni">
				<p class="h3 text-left" style="margin-bottom:20px;">
					 Ajouter un nouveau dossier
				</p>
				<div class="well"><input type="text" class="form-control" placeholder="Écrivez le nouveau nom du dossier" id ="addfolderInput" aria-label="Large" value="Nouveau dossier"></div>
				<div style="margin-top:20px">
					<button type="button" class="btn btn-primary modal-roni-button float-right" id ="addfolderBtn">Valider</button>
					<button type="button" class="btn btn-link float-right" data-dismiss="modal" aria-label="Close">Annuler</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" id='deleteFolder'>
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content modal-roni">
				<p class="h3 text-left">
					Êtes-vous sûr de vouloir supprimer le dossier ?
				</p>
				<div style="margin-top:20px">
					<button type="button" class="btn btn-primary modal-roni-button float-right" id = "deletefolderBtn">Valider</button>
					<button type="button" class="btn btn-link float-right" data-dismiss="modal" aria-label="Close">Annuler</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="renameFolder" role="dialog">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content modal-roni">
				<p class="h3 text-left">
					Renommer un dossier 
				</p>
				<div class="well"><input type="text" class="form-control" placeholder="Sélectionnez d'abord un dossier" id = "renamefolderInput" aria-label="Large"></div>
				<p class="font-italic text-right" style="padding-top:15px">Une fois le dossier renommé, merci d'actualiser la page</p>
				<div style="margin-top:10px">
					<button type="button" class="btn btn-primary modal-roni-button float-right" id = "renamefolderBtn">Valider</button>
					<button type="button" class="btn btn-link float-right" data-dismiss="modal" aria-label="Close">Annuler</button>
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
          // alert(addFolderDir);
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
    // alert("id :" + newNode.id + "  name: " + newNode.name + "  " );
    // console.log("current jsonFolderDirInform :" + jsonFolderDirInform);
    currentState = $('#selected_folder').val();
    if(currentState =="" || currentState == undefined)
    {
      // alert(currentState);
      addFolderDir = "DOSSIERS/";
      currentFolderId = 0;
    }
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
              // alert("create " + "'" + newNode.name + "'" + " folder!");
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
    $('#renameFolder').modal('hide');
    // alert(renameFolderDir +currentFolderName +" change name : " + renameFolderDir +rename );
    var oldFolderName = currentFolderName;
    $.ajax({
          type:"POST",
          url: "{{ url('/renameFolder') }}",
          headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
          data: {"folderName" : currentFolderName ,"rename": rename,"renameFolderDir":renameFolderDir ,"jsonFolderDirInform" : jsonFolderDirInform},
          success:function(data){
            // alert("change the name" + " from " +"'"+ oldFolderName + " ' " +" folder " + " to " + "'" + rename +"' " +"folder" +'!');
          }, 
          error: function (xhr, ajaxOptions, thrownError) {
            alert("Folder name exist!");
          }

        }).done(function() {
          // $( this ).addClass( "done" );

      });
      $.ajax({
          type:"POST",
          url: "{{ url('/getFolderDirInform') }}",
          headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
          data: { },
          success:function(data){
            jsonFolderDirInform = JSON.parse(data["jsonFolderDirInform"]);
            console.log(jsonFolderDirInform);
            $('#folder_tree').jstree(true).settings.core.data = jsonFolderDirInform;
            $('#folder_tree').jstree(true).refresh();
          },  
        }).done(function() {
          $( this ).addClass( "done" );
      });
      console.log(jsonFolderDirInform);
      // $('#folder_tree').jstree(true).refresh();

  });
  
  $('#deletefolderBtn').on('click', function() { 
    $('#folder_tree').jstree(true).settings.core.data = jsonFolderDirInform;
    deleteNodeFromTree(jsonFolderDirInform[0],currentFolderId);
    $('#deleteFolder').modal('hide');
    $('#folder_tree').jstree(true).refresh();
    // alert("deleteFolderDir "+deleteFolderDir + currentFolderName );
    var deletedFolderName = currentFolderName;
    // alert("cur : " + currentFolderName);
    $.ajax({
          type:"POST",
          url: "{{ url('/deleteFolder') }}",
          headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
          data: {"folderName" : currentFolderName , "deleteFolderDir":deleteFolderDir ,"jsonFolderDirInform" : jsonFolderDirInform},
          success:function(data){
            // alert("success " +"'" + deletedFolderName + "'"+ " delete");
          }, 
          error: function (xhr, ajaxOptions, thrownError) {
            alert("Dossier a été supprimé ");
          }

        }).done(function() {
          $( this ).addClass( "OK" );
    });
    addFolderDir ="";
  });

  $('#selectRename').on('click', function() {
    $('#renamefolderInput').val(currentFolderName);
  });
  $('#selectDelete').on('click', function() {
    if($('#selected_folder').val()==""){
      var deleteTxt = "Voulez-vous vraiment supprimer le vide?";
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