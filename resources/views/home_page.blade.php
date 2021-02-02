@extends('home')
@section('main_area')
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<style>
#dashboradTab > li {
	background-color: #ffc10780 !important;
		border: medium none;
		border-radius: 0;
		color:#fff;
}
.modal-roni{width:95%!important;padding:2rem!important}.modal-roni-button{width:100px!important}
#newTaskFiled > .row {
	padding-bottom:10px;
}
.datepicker {
	font-size: 0.875em;
}
.datepicker_2 {
	font-size: 0.875em;
}
/* solution 2: the original datepicker use 20px so replace with the following:*/

.datepicker td, .datepicker th {
	width: 1.5em;
	height: 1.5em;
}
.datepicker_2 td, .datepicker th {
	width: 1.5em;
	height: 1.5em;
}
.taskIconStatus{
	border:1px solid gray;
	border-radius: 100%;
    width: 45px;
    height: 45px;
    position: relative;
	margin:3px;
}
.taskIconStatus_disable{
	border:1px solid gray;
	background-color:#ffffff;
	border-radius: 100%;
    width: 45px;
    height: 45px;
    position: relative;
	margin:3px;
}
.taskIconStatus:hover{
	background-color:yellow;
}


</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></head>
<div class="container mt-3">
  <!-- <h2>Toggleable Tabs</h2> -->
  <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal"  data-target="#createTask">Ajouter un projet</button>
  <br>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" id="dashboradTab" style="width: 100%;">

    <li style="width:50%;text-align:center" class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#menu1">Tâche en cours</a>
    </li>
    <li style="width:50%;text-align:center" class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Tâche terminées</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">

	<div id="menu1" class="container tab-pane  active"><br>
		<table class="table table-striped" id="toDoList">
			<thead>
				<tr>
					<th>Nom du projet</th>
					<th>No ticket</th>
					<th>Date 01</th>
					<th>Date 02</th>
					<th>Dossier utilisé</th>
					<th>Auteur</th>
					<th>Statut</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
					// var_dump(count($taskList));
					for($t = 0 ; $t < count($taskList); $t++)
					{
						echo "<tr>";
							echo "<td>".$taskList[$t]['task_name']."</td>";
							echo "<td>".$taskList[$t]['task_ticket']."</td>";
							echo "<td>".$taskList[$t]['start_date']."</td>";
							echo "<td>".$taskList[$t]['end_date']."</td>";
							echo "<td>".$taskList[$t]['folder_dir']."</td>";
							echo "<td>".$taskList[$t]['author']."</td>";
							echo "<td>".$taskList[$t]['status']."</td>";
							if( $taskList[$t]['author'] == $currentUser  ||  $currentUser_role === 1)
							{
								echo "<td>".
									'<div class="row">'.
										'<div class = "taskIconStatus">'.
											'<i  class="fa fa-edit" style="font-size:40px;color:blue;position:absolute;right: 0px; bottom: 0px;" onclick="getTaskId('.$t.')" data-toggle="modal"  data-target="#editTask"></i>'.
										"</div>".
										'<div class = "taskIconStatus">'.
											'<i  class="fa fa-remove" style="font-size:40px;color:red;position:absolute;right: 6px; bottom: 3px;" onclick="getTaskId('.$t.')" data-toggle="modal"  data-target="#removeTask"></i>'.
										'</div>'.
										'<div class = "taskIconStatus">'.
											'<i  class="fa fa-check" style="font-size:40px;color:green;position:absolute;right: 0px; bottom: 0px;" onclick="getTaskId('.$t.')" data-toggle="modal"  data-target="#finishTask"></i>'.
										'</div>'.
									'</div>'.
								"</td>";
							}
							else
							{
								echo "<td>".
								'<div class="row ">'.
									'<div class = "taskIconStatus_disable" >'.
										'<i  class="fa fa-edit" style="font-size:40px;color:#506cbb;position:absolute;right: 0px; bottom: 0px;" ></i>'.
									"</div>".
									'<div class = "taskIconStatus_disable">'.
										'<i  class="fa fa-remove" style="font-size:40px;color:#ff00008f;position:absolute;right: 6px; bottom: 3px;"></i>'.
									'</div>'.
									'<div class = "taskIconStatus_disable">'.
										'<i  class="fa fa-check" style="font-size:40px;color:#0080008f;position:absolute;right: 0px; bottom: 0px;"></i>'.
									'</div>'.
								'</div>'.
								"</td>";
							}
							echo "</tr>";

					}					
				?>
			</tbody>
		</table>
    </div>
    <div id="menu2" class="container tab-pane fade"><br>
		<table class="table table-striped" id="finshList">
			<thead>
				<tr>
					<th>Nom du projet</th>
					<th>No ticket</th>
					<th>Date 01</th>
					<th>Date 02</th>
					<th>Dossier utilisé</th>
					<th>Auteur</th>
					<th>Statut</th>
				</tr>
			</thead>
			<tbody>
				<?php
					// var_dump(count($finishedtaskList));
					for($t = 0 ; $t < count($finishedtaskList); $t++)
					{
						echo "<tr>";
							echo "<td>".$finishedtaskList[$t]['task_name']."</td>";
							echo "<td>".$finishedtaskList[$t]['task_ticket']."</td>";
							echo "<td>".$finishedtaskList[$t]['start_date']."</td>";
							echo "<td>".$finishedtaskList[$t]['end_date']."</td>";
							echo "<td>".$finishedtaskList[$t]['folder_dir']."</td>";
							echo "<td>".$finishedtaskList[$t]['author']."</td>";
							echo "<td>".$finishedtaskList[$t]['status']."</td>";
						echo "</tr>";
					}				
				?>
			</tbody>
		</table>
		
    </div>
  </div>
	<form  class="modal fade" action="{{route('create-new-task')}}" id="createTask" role="dialog" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content modal-roni">
				<p class="h3 text-left" style="margin-bottom:20px;">
					Ajouter un projet
				</p>
				<div class="well" id="newTaskFiled">
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-3">
							Nom du projet
						</div>
						<div class="col-md-8">
							<input type="text" class="form-control" placeholder="Nom du projet" id ="task_name" aria-label="Large" name="task_name" value="" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-3">
						No ticket
						</div>
						<div class="col-md-8">
							<input type="text" class="form-control" placeholder="No ticket" id ="task_ticket"  name ="task_ticket" aria-label="Large" value="" required>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-3">
							Date 01
						</div>
						<div class="col-md-8">
							<!-- <input type="text" class="form-control" placeholder="Nom du projet" id ="startDate" aria-label="Large" value="Nom du projet"> -->
							<input data-date-format="dd/mm/yyyy" id="datepicker" name="datepicker">
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>

						<div class="col-md-3">
							Date 02
						</div>
						<div class="col-md-8">
							<!-- <input type="text" class="form-control" placeholder="Nom du projet" id ="endDate" aria-label="Large" value="Nom du projet"> -->
							<input data-date-format="dd/mm/yyyy" id="datepicker_2" name="datepicker_2">
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-3">
						Dossier utilisé
						</div>
						<div class="col-md-8">
							<input type="text" class="form-control" placeholder="Dossier utilisé" id ="folder_dir"  name ="folder_dir" aria-label="Large" value="" required>
						</div>
					</div>
				</div>
				<div style="margin-top:20px">
					<button type="submit" class="btn btn-primary modal-roni-button float-right" id ="addfolderBtn" >Valider</button>
					<button type="button" class="btn btn-link float-right" data-dismiss="modal" aria-label="Close">Annuler</button>
				</div>
			</div>
		</div>
	</form >
	
	<!-- action="{{route('create-new-task')}}" -->
	<form  class="modal fade" action="{{route('edit-task')}}"  id="editTask" role="dialog" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content modal-roni">
				<p class="h3 text-left" style="margin-bottom:20px;">
					Ajouter un projet
				</p>
				<div class="well" id="newTaskFiled">
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-3">
							Nom du projet
						</div>
						<div class="col-md-8">
							<input type="text" class="form-control" placeholder="Nom du projet" id ="task_name_edit" aria-label="Large" name="task_name_edit" value="" required>
							<input type="hidden" class="form-control"  id ="task_id_edit"  name ="task_id_edit" aria-label="Large" value="" >
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-3">
						No ticket
						</div>
						<div class="col-md-8">
							<input type="text" class="form-control" placeholder="No ticket" id ="task_ticket_edit"  name ="task_ticket_edit" aria-label="Large" value="" required>
						</div>
					</div>
				
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-3">
							Date 01
						</div>
						<div class="col-md-8">
							<input data-date-format="dd/mm/yyyy" id="datepicker_3" name="datepicker_3">
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>

						<div class="col-md-3">
							Date 02
						</div>
						<div class="col-md-8">
							<input data-date-format="dd/mm/yyyy" id="datepicker_4" name="datepicker_4">
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-3">
						Dossier utilisé
						</div>
						<div class="col-md-8">
							<input type="text" class="form-control" placeholder="Dossier utilisé" id ="folder_dir_edit"  name ="folder_dir_edit" aria-label="Large" value="" required>
						</div>
					</div>
				</div>
				<div style="margin-top:20px">
					<button type="submit" class="btn btn-primary modal-roni-button float-right" id ="addfolderBtn" >Valider</button>
					<button type="button" class="btn btn-link float-right" data-dismiss="modal" aria-label="Close">Annuler</button>
				</div>
			</div>
		</div>
	</form >
 
	<form  class="modal fade" action="{{route('remove-task')}}"  id="removeTask" role="dialog" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content modal-roni">
				<p class="h4 text-left" id="staticBackdropLabel">
					Are you sure you want to delete the task?
				</p>
				<input type="hidden" class="form-control"  id ="task_id_remove"  name ="task_id_remove" aria-label="Large" value="" >
				<div style="margin-top:20px">
					<button type="submit" class="btn btn-primary modal-roni-button float-right" id ="addfolderBtn">Valider</button>
					<button type="button" class="btn btn-link float-right" data-dismiss="modal" aria-label="Close">Annuler</button>
				</div>
			</div>
		</div>
	</form >
	
	<form  class="modal fade" action="{{route('finish-task')}}"  id="finishTask" role="dialog" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content modal-roni">
				<p class="h4 text-left" id="staticBackdropLabel">
					Are you sure the task is finished?
				</p>
				<input type="hidden" class="form-control"  id ="task_id_finish"  name ="task_id_finish" aria-label="Large" value="" >
				<div style="margin-top:20px">
					<button type="submit" class="btn btn-primary modal-roni-button float-right" id ="addfolderBtn_S">Valider</button>
					<button type="button" class="btn btn-link float-right" data-dismiss="modal" aria-label="Close">Annuler</button>
				</div>
			</div>
		</div>
	</form >

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.fr.min.js


" charset="UTF-8"></script>

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
<script>
	jQuery(document).ready(function($){
		$('#toDoList').DataTable({
			language: {
			lengthMenu: "T'en veux _MENU_ par page",
			info: "c'est la page _PAGE_ sur _PAGES_",
			search: "toute recherche",
			paginate: {
				first:      "Premier",
				last:       "Précédent",
				next:       "Suivant",
				previous:   "Dernier"
			}
			}
		});
		$('#finshList').DataTable({
			language: {
			lengthMenu: "T'en veux _MENU_ par page",
			info: "c'est la page _PAGE_ sur _PAGES_",
			search: "toute recherche",
			paginate: {
				first:      "Premier",
				last:       "Précédent",
				next:       "Suivant",
				previous:   "Dernier"
				}
			}
		});
	});
</script>
<script type="text/javascript">
	var taskListInform = <?php echo json_encode($taskList); ?>;
	var choosedTaskId = null ;
  $('#datepicker').datepicker({
		language:  'fr',
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
	});
	$('#datepicker').datepicker("setDate", new Date());
	$('#datepicker_2').datepicker({
		language:  'fr',
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
	$('#datepicker_2').datepicker("setDate", new Date());
	

	$('#datepicker_3').datepicker({
		language:  'fr',
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
	$('#datepicker_3').datepicker("setDate", new Date());

	$('#datepicker_4').datepicker({
		language:  'fr',
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
	$('#datepicker_4').datepicker("setDate", new Date());
	function getTaskId(taskIndex)
	{
		// datepicker_3
		// task_ticket_edit       
		
		$('#task_name_edit').val(taskListInform[taskIndex]["task_name"]);
		$('#task_id_edit').val(taskListInform[taskIndex]["id"]);
		$('#task_id_finish').val(taskListInform[taskIndex]["id"]);
		$('#task_id_remove').val(taskListInform[taskIndex]["id"]);
		$('#task_ticket_edit').val(taskListInform[taskIndex]["task_ticket"]);
		$('#folder_dir_edit').val(taskListInform[taskIndex]["folder_dir"]);
		$('#datepicker_3').val(taskListInform[taskIndex]["start_date"]);
		$('#datepicker_4').val(taskListInform[taskIndex]["end_date"]);
		console.log(taskListInform);
	}
</script>
@endsection
