var url = 'chat/chatController.php';

function initAjax() {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	return xmlhttp;
}

function sendChat() {
	if(!document.getElementById('chatmessage').value) {
		return;
	}
	
	xmlhttp = initAjax();	
	
	var chatObj = {
		action: 'send',
		data: {
			sender: document.getElementById('chatsender').value,
			recver: document.getElementById('chatrecver').value,
			message: document.getElementById('chatmessage').value
		}
	}
	
	postdata = 'json=' + JSON.stringify(chatObj);
	document.getElementById('chatmessage').value = "";
	
	xmlhttp.open("POST", url, true);
	
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", postdata.length);
	xmlhttp.setRequestHeader("Connection", "close");
	
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			response = xmlhttp.responseText;
			responseJSON = eval('(' + response + ')');
			document.getElementById('chatbox').innerHTML += "--\n<b>You:</b> " + responseJSON.ack;
		}
	}
	
	xmlhttp.send(postdata);
}

function chatPoll() {
	xmlhttp = initAjax();
	
	var chatObj = {
		action: 'poll',
		data: {
			sender: document.getElementById('chatsender').value,
			recver: document.getElementById('chatrecver').value
		}
	}
	
	postdata = 'json=' + JSON.stringify(chatObj);
	
	xmlhttp.open("POST", url, true);
	
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", postdata.length);
	xmlhttp.setRequestHeader("Connection", "close");
	
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			response = xmlhttp.responseText;
			responseJSON = eval('(' + response + ')');
			
			for(var n in responseJSON['messages']) {
				document.getElementById('chatbox').innerHTML += "--\n<b>Friend:</b> " + responseJSON['messages'][n]['message'];
			}
			
			document.getElementById('onlineusers').innerHTML = '';
			for(var n in responseJSON['users']) {
				document.getElementById('onlineusers').innerHTML += responseJSON['users'][n]['id'] + '; ';
			}
		}
	}
	
	xmlhttp.send(postdata);
}

function startPoll() {
	chatPoll();
	loop = setTimeout("startPoll()", 2000);
}

function checkEnter(e) {
	// look for window.event in case event isn't passed in
	if (window.event) {
		e = window.event;
	}
	
	if (e.keyCode == 13) {
			document.getElementById('chatsend').click();
	}
}