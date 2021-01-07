@extends('home')
@section('main_area')
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
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nom du projet</th>
					<th>No ticket</th>
					<th>Date 01</th>
					<th>Date 02</th>
					<th>Statut</th>
					<th>Auteur</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Test</td>
					<td>1</td>
					<td>02/01/2021</td>
					<td>15/01/2021</td>
					<th>En cours</th>
					<td>John</td>
					<th>
						<div class="row">
							<div class = "taskIconStatus">
								<i  class='fa fa-edit' style='font-size:40px;color:blue;position:absolute;right: 0px; bottom: 0px;'  data-toggle="modal"  data-target="#editTask"></i>
							</div>
							<div class = "taskIconStatus">
								<i  class="fa fa-remove" style="font-size:40px;color:red;position:absolute;right: 6px; bottom: 3px;" data-toggle="modal"  data-target="#removeTask"></i>
							</div>
							<div class = "taskIconStatus">
								<i  class='fa fa-check' style='font-size:40px;color:green;position:absolute;right: 0px; bottom: 0px;'data-toggle="modal"  data-target="#finishTask"></i>
							</div>
						</div>
					</th>
				</tr>
				<tr>
					<td>Test</td>
					<td>1</td>
					<td>02/01/2021</td>
					<td>15/01/2021</td>
					<th>En cours</th>
					<td>John</td>
					<th>
						<i class='fa fa-edit' style='font-size:40px;color:blue'></i>
						<i class="fa fa-remove" style="font-size:40px;color:red"></i>
						<i class='fa fa-check' style='font-size:40px;color:green'></i>
					</th>
				</tr>
				<tr>
					<td>Test</td>
					<td>1</td>
					<td>02/01/2021</td>
					<td>15/01/2021</td>
					<th>En cours</th>
					<td>John</td>
					<th>
						<i class='fa fa-edit' style='font-size:40px;color:blue'></i>
						<i class="fa fa-remove" style="font-size:40px;color:red"></i>
						<i class='fa fa-check' style='font-size:40px;color:green'></i>
					</th>
				</tr>
			</tbody>
		</table>
    </div>
    <div id="menu2" class="container tab-pane fade"><br>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nom du projet</th>
					<th>No ticket</th>
					<th>Date 01</th>
					<th>Date 02</th>
					<th>Statut</th>
					<th>Auteur</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Test</td>
					<td>1</td>
					<td>02/01/2021</td>
					<td>15/01/2021</td>
					<th>En cours</th>
					<td>John</td>
				</tr>
				<tr>
					<td>Test</td>
					<td>1</td>
					<td>02/01/2021</td>
					<td>15/01/2021</td>
					<th>En cours</th>
					<td>John</td>
				</tr>
				<tr>
					<td>Test</td>
					<td>1</td>
					<td>02/01/2021</td>
					<td>15/01/2021</td>
					<th>En cours</th>
					<td>John</td>
				</tr>
			</tbody>
		</table>
    </div>
  </div>
	<div class="modal fade" id="createTask" role="dialog">
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
							<input type="text" class="form-control" placeholder="Nom du projet" id ="newTaskName" aria-label="Large" value="" require>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-3">
						No ticket
						</div>
						<div class="col-md-8">
							<input type="text" class="form-control" placeholder="No ticket" id ="ticketId" aria-label="Large" value="" require>
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
							<input data-date-format="mm/dd/yyyy" id="datepicker">
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
							<input data-date-format="mm/dd/yyyy" id="datepicker_2">
						</div>
					</div>
				</div>
				<div style="margin-top:20px">
					<button type="button" class="btn btn-primary modal-roni-button float-right" id ="addfolderBtn">Valider</button>
					<button type="button" class="btn btn-link float-right" data-dismiss="modal" aria-label="Close">Annuler</button>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="editTask" role="dialog">
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
							<input type="text" class="form-control" placeholder="Nom du projet" id ="newTaskName" aria-label="Large" value="Projet exemple 01">
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-3">
						No ticket
						</div>
						<div class="col-md-8">
							<input type="text" class="form-control" placeholder="No ticket" id ="ticketId" aria-label="Large" value="12345">
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
							<input data-date-format="mm/dd/yyyy" id="datepicker" value="02/01/2021">
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
							<input data-date-format="mm/dd/yyyy" id="datepicker_2" value="15/01/2021">
						</div>
					</div>
				</div>
				<div style="margin-top:20px">
					<button type="button" class="btn btn-primary modal-roni-button float-right" id ="addfolderBtn">Valider</button>
					<button type="button" class="btn btn-link float-right" data-dismiss="modal" aria-label="Close">Annuler</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="removeTask" role="dialog">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content modal-roni">
				<p class="h4 text-left" id="staticBackdropLabel">
					Are you sure you want to delete the task?
				</p>
				<div style="margin-top:20px">
					<button type="button" class="btn btn-primary modal-roni-button float-right" id ="addfolderBtn">Valider</button>
					<button type="button" class="btn btn-link float-right" data-dismiss="modal" aria-label="Close">Annuler</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="finishTask" role="dialog">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content modal-roni">
				<p class="h4 text-left" id="staticBackdropLabel">
					Are you sure the task is finished?
				</p>
				<div style="margin-top:20px">
					<button type="button" class="btn btn-primary modal-roni-button float-right" id ="addfolderBtn">Valider</button>
					<button type="button" class="btn btn-link float-right" data-dismiss="modal" aria-label="Close">Annuler</button>
				</div>
			</div>
		</div>
	</div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
  $('#datepicker').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
	$('#datepicker').datepicker("setDate", new Date());
	$('#datepicker_2').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker_2').datepicker("setDate", new Date());
</script>
@endsection
