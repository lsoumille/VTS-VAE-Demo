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
		})
		.error(function(){
			alert("Error, Decrypted text was not generated");
		});
		return false;
	};