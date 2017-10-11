$(document).ready(Onready);
function Onready(){
		$.ajaxSetup({ cache: false});
		$('#userForm').submit(OnsubmitUser);
	};

	function OnsubmitUser(data){
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			window.location.replace("http://localhost:8081/appli/databaseview.php");	
		});
		return false;
	};