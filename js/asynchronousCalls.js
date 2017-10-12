$(document).ready(Onready);
	function Onready(){
		$.ajaxSetup({ cache: false});
		$('#formTok').submit(OnsubmitTok);
		$('#formDetok').submit(OnsubmitDetok);
		$('#formEncrypt').submit(OnsubmitEncrypt);
		$('#formDecrypt').submit(OnsubmitDecrypt);
		$('#formSign').submit(OnsubmitSign);
		$('#formVerify').submit(OnsubmitVerify);
		$('#formDigest').submit(OnsubmitDigest);
		$('#userForm').submit(OnsubmitUser);
		$('#tokInput').val("");
		$('#detokInput').val("");
		$('#decryptInput').val("");
		$('#encryptInput').val("");
		$('#signToVerifyInput').val("");
		$('#signInput').val("");
		$('#verifyInput').val("");
		$('#digestInput').val("");
	};

	function OnsubmitUser(data){
		stopPropagation(data);
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data:  new FormData(this),
			contentType: false,
    	    processData:false,
    	    success: function(result){
				window.location.replace("http://localhost:8081/appli/databaseview.php");
			},
			error: function(){

			}
		})
		/*.done(function(result){
			window.location.replace("http://localhost:8081/appli/databaseview.php");	
			console.log(result);
		})*/;
		return false;
	};

	function OnsubmitTok(data){
		stopPropagation(data);
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			$('#detokInput').val(result);
			$('#tokInput').val("");
			reloadTransfoDB();
		});
		return false;
	};

	function OnsubmitDetok(data){
		stopPropagation(data);
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			$('#tokInput').val(result);
			$('#detokInput').val("");
			reloadTransfoDB();	
		});
		return false;
	};

	function OnsubmitEncrypt(data){
		stopPropagation(data);
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			$('#decryptInput').val(result);
			$('#encryptInput').val("");
			reloadTransfoDB();	
		});
		return false;
	};

	function OnsubmitDecrypt(data){
		stopPropagation(data);
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			$('#encryptInput').val(result);
			$('#decryptInput').val("");
			reloadTransfoDB();
		});
		return false;
	};

	function OnsubmitSign(data){
		stopPropagation(data);
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			$('#signToVerifyInput').val($('#signInput').val())
			$('#verifyInput').val(result);
			reloadTransfoDB();
		});
		return false;
	};

	function OnsubmitVerify(data){
		stopPropagation(data);
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			$('#signInput').val($('#signToVerifyInput').val());
			$('#signToVerifyInput').val("");
			$('#verifyInput').val("");
			$('#resultSig').text("Result : " + result);
			reloadTransfoDB();
		});
		return false;
	};

	function OnsubmitDigest(data){
		stopPropagation(data);
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			$('#digestInput').val("");
			$('#resultDigest').text(result);
			reloadTransfoDB();	
		});
		return false;
	};

	function reloadTransfoDB() {
		document.getElementById('transfoDB').contentWindow.location.reload();
	}

	function stopPropagation(data) {
		data.preventDefault();
		//data.stopImmediatePropagation();
	}