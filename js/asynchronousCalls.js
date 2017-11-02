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
    	    	console.log(result);
				window.location.replace("http://localhost:8081/appli/databaseview.php");
			},
			error: function(){

			}
		})
		return false;
	};

	function OnsubmitTok(data){
		stopPropagation(data);
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data:  new FormData(this),
			contentType: false,
    	    processData:false,
    	    success: function(result){
    	    	$('#detokInput').val(result);
				$('#tokInput').val("");
				reloadTransfoDB();
			},
			error: function(){

			}
		})
		return false;
	};

	function OnsubmitDetok(data){
		stopPropagation(data);
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data:  new FormData(this),
			contentType: false,
    	    processData:false,
    	    success: function(result){
    	    	$('#tokInput').val(result);
				$('#detokInput').val("");
				reloadTransfoDB();	
			},
			error: function(){

			}
		})
		return false;
	};

	function OnsubmitEncrypt(data){
		stopPropagation(data);
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data:  new FormData(this),
			contentType: false,
    	    processData:false,
    	    success: function(result){
    	    	$('#decryptInput').val(result);
				$('#encryptInput').val("");
				reloadTransfoDB();	
			},
			error: function(){

			}
		})
		return false;
	};

	function OnsubmitDecrypt(data){
		stopPropagation(data);
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data:  new FormData(this),
			contentType: false,
    	    processData:false,
    	    success: function(result){
    	    	$('#encryptInput').val(result);
				$('#decryptInput').val("");
				reloadTransfoDB();
			},
			error: function(){

			}
		})
		return false;
	};

	function OnsubmitSign(data){
		stopPropagation(data);
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data:  new FormData(this),
			contentType: false,
    	    processData:false,
    	    success: function(result){
    	    	$('#signToVerifyInput').val($('#signInput').val())
				$('#verifyInput').val(result);
				reloadTransfoDB();
			},
			error: function(){

			}
		})
		return false;
	};

	function OnsubmitVerify(data){
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data:  new FormData(this),
			contentType: false,
    	    processData:false,
    	    success: function(result){
    	    	$('#signInput').val($('#signToVerifyInput').val());
				$('#signToVerifyInput').val("");
				$('#verifyInput').val("");
				$('#resultSig').text("Result : " + result);
				reloadTransfoDB();
			},
			error: function(){

			}
		})
		return false;
	};

	function OnsubmitDigest(data){
		stopPropagation(data);
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data:  new FormData(this),
			contentType: false,
    	    processData:false,
    	    success: function(result){
    	    	$('#digestInput').val("");
				$('#resultDigest').text(result);
				reloadTransfoDB();
			},
			error: function(){

			}
		})
		return false;
	};

	function reloadTransfoDB() {
		document.getElementById('transfoDB').contentWindow.location.reload();
	}

	function stopPropagation(data) {
		data.preventDefault();
		//data.stopImmediatePropagation();
	}