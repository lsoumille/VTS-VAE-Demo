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
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			window.location.replace("http://localhost:8081/appli/databaseview.php");	
		})
		.error(function(){
			alert("Error, User was not created");
		});
		return false;
	};

	function OnsubmitTok(data){
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			$('#detokInput').val(result);
			$('#tokInput').val("");
			reloadTransfoDB();
		})
		.error(function(){
			alert("Error, Token was not generated");
		});
		return false;
	};

	function OnsubmitDetok(data){
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			$('#tokInput').val(result);
			$('#detokInput').val("");
			reloadTransfoDB();	
		})
		.error(function(){
			alert("Error, Data was not generated");
		});
		return false;
	};

	function OnsubmitEncrypt(data){
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			$('#decryptInput').val(result);
			$('#encryptInput').val("");
			reloadTransfoDB();	
		})
		.error(function(){
			alert("Error, Encrypted text was not generated");
		});
		return false;
	};

	function OnsubmitDecrypt(data){
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			$('#encryptInput').val(result);
			$('#decryptInput').val("");
			reloadTransfoDB();
		})
		.error(function(){
			alert("Error, Decrypted text was not generated");
		});
		return false;
	};

	function OnsubmitSign(data){
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			$('#signToVerifyInput').val($('#signInput').val())
			$('#verifyInput').val(result);
			reloadTransfoDB();
		})
		.error(function(){
			alert("Error, Signature was not generated");
		});
		return false;
	};

	function OnsubmitVerify(data){
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
		})
		.error(function(){
			alert("Error, Verifying process is down");
		});
		return false;
	};

	function OnsubmitDigest(data){
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
		})
		.done(function(result){
			$('#digestInput').val("");
			$('#resultDigest').text(result);
			reloadTransfoDB();	
		})
		.error(function(){
			alert("Error, Decrypted text was not generated");
		});
		return false;
	};

	function reloadTransfoDB() {
		document.getElementById('transfoDB').contentWindow.location.reload();
	}