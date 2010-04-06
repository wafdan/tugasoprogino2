var myUserID;
var ajaxURL = 'chat2/chatController.php';
var pollInterval = 2000;

/* --- Chat window management functions */

function toggleElement(id) {
	x = document.getElementById(id).style;
	
	if(x.display == 'none') {
		x.display = 'block';
	} else {
		x.display = 'none';
	}
}

function popChatWindow(id) {
	if(document.getElementById('chatBox_' + id)) {
		// kalau div {ID} sudah ada
		document.getElementById('chatBox_' + id).style.display = 'block';
		document.getElementById('chatInterface_' + id).style.display = 'block';
		document.getElementById('chatText_' + id).scrollTop = document.getElementById('chatText_' + id).scrollHeight;
		//document.getElementById('chatMessage_' + id).focus();
	} else {
		// kalau belum ada
		addChatWindow(id);
		//document.getElementById('chatMessage_' + id).focus();
	}
}

function addChatWindow(id) {
	var newChatBox = document.createElement('div');
	newChatBox.setAttribute('class', 'chatBox');
	newChatBox.setAttribute('id', 'chatBox_' + id);
	
	var newChatMate = document.createElement('div');
	newChatMate.setAttribute('class', 'chatMate');
	newChatMate.setAttribute('id', 'chatMate_' + id);
	newChatMate.setAttribute('onClick', "toggleElement('chatInterface_" + id + "')");
	newChatMate.innerHTML = '<a>' + document.getElementById('userID_' + id).innerHTML + '</a>';
	
	var newChatClose = document.createElement('div');
	newChatClose.setAttribute('class', 'chatClose');
	newChatClose.setAttribute('id', 'chatClose_' + id);
	newChatClose.setAttribute('onClick', 'removeChatWindow("' + id + '")');
	newChatClose.innerHTML = '<a>X</a>';
	
	var newChatInterface = document.createElement('div');
	newChatInterface.setAttribute('class', 'chatInterface');
	newChatInterface.setAttribute('id', 'chatInterface_' + id);
	
	var newChatText = document.createElement('div');
	newChatText.setAttribute('class', 'chatText');
	newChatText.setAttribute('id', 'chatText_' + id);
	
	var newChatMessage = document.createElement('input');
	newChatMessage.setAttribute('type', 'text');
	newChatMessage.setAttribute('class', 'chatMessage');
	newChatMessage.setAttribute('id', 'chatMessage_' + id);
	newChatMessage.setAttribute('onKeyPress', 'chatMessageKeyPress(event, "' + id + '")');
	
	newChatInterface.appendChild(newChatText);
	newChatInterface.appendChild(newChatMessage);
	
	newChatBox.appendChild(newChatMate);
	newChatBox.appendChild(newChatClose);
	newChatBox.appendChild(newChatInterface);
	
	document.getElementById('chatBoxes').appendChild(newChatBox);
}

function updateChatWindow(id, content, type) {
	// type:
	//   0: from me
	//   1: from friend
	//   2: system message
	
	switch(type) {
		case 0:
			from = 'Me:';
			break;
		case 1:
			from = document.getElementById('userID_' + id).innerHTML + ':';
			break;
		case 2:
			from = '[SYSTEM]';
			break;
	}
	
	x = document.getElementById('chatText_' + id);
	x.innerHTML += '<u>' + from + '</u> ' + content + "<br />";
	x.scrollTop = x.scrollHeight;
}

function removeChatWindow(id) {
	document.getElementById('chatBox_' + id).style.display = 'none';
}

function updateContactList(contactData) {
	parentElement = document.getElementById('contactList');
	temp = document.createElement('ul');
	
	oldList = parentElement.innerHTML;
	
	for(var n in contactData) {
		newListItem = document.createElement('li');
		newListItem.setAttribute('id', 'userID_' + contactData[n]['id']);
		newListItem.setAttribute('onClick', 'popChatWindow("' + contactData[n]['id'] + '")');
		newListItem.innerHTML = contactData[n]['name'];
		
		temp.appendChild(newListItem);
	}
	
	newList = temp.innerHTML;
	
	if(oldList != newList) {
		if(newList != '') {
			parentElement.innerHTML = newList;
			document.getElementById('chatStatus').innerHTML = 'Chat <b>(' + contactData.length + ')</b>';
		} else {
			parentElement.innerHTML = '<ul><li>No users connected</li></ul>';
			document.getElementById('chatStatus').innerHTML = 'No users connected.';
		}
	}
}

/* --- End of chat window management functions */


/* --- Misc. functions */

function getCookie(check_name) {
	// http://techpatterns.com/downloads/javascript_cookies.php
	// first we'll split this cookie up into name/value pairs
	// note: document.cookie only returns name=value, not the other components
	var a_all_cookies = document.cookie.split( ';' );
	var a_temp_cookie = '';
	var cookie_name = '';
	var cookie_value = '';
	var b_cookie_found = false; // set boolean t/f default f

	for ( i = 0; i < a_all_cookies.length; i++ ) {
		// now we'll split apart each name=value pair
		a_temp_cookie = a_all_cookies[i].split( '=' );

		// and trim left/right whitespace while we're at it
		cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');

		// if the extracted name matches passed check_name
		if ( cookie_name == check_name ) {
			b_cookie_found = true;
			// we need to handle case where cookie has no value but exists (no = sign, that is):
			if ( a_temp_cookie.length > 1 ) {
				cookie_value = unescape( a_temp_cookie[1].replace(/^\s+|\s+$/g, '') );
			}
			// note that in cases where cookie is initialized but no value, null is returned
			return cookie_value;
			break;
		}
		a_temp_cookie = null;
		cookie_name = '';
	}
	if ( !b_cookie_found ) {
		return null;
	}
}

function getMyUserID() {
	return getCookie('myUserID');
}

function chatMessageKeyPress(e, receiver) {
	// look for window.event in case event isn't passed in
	if (window.event) {
		e = window.event;
	}
	
	if (e.keyCode == 13 && document.getElementById('chatMessage_' + receiver) != '') {
		sendChat(receiver);
	}
}

function startPoll() {
	chatPoll();
	loop = setTimeout("startPoll()", pollInterval);
}

/* --- End if misc. functions */


/* --- AJAX functions */

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

/* -- End of AJAX functions */


/* --- Chat client-server communication functions */

function sendChat(receiver) {
	if(!document.getElementById('chatMessage_' + receiver).value) {
		return;
	}
	
	xmlhttp = initAjax();	
	
	var chatObj = {
		action: 'send',
		data: {
			sender: getMyUserID(),
			recver: receiver,
			message: document.getElementById('chatMessage_' + receiver).value
		}
	}
	
	postdata = 'json=' + JSON.stringify(chatObj);
	document.getElementById('chatMessage_' + receiver).value = "";
	
	xmlhttp.open("POST", ajaxURL, true);
	
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", postdata.length);
	xmlhttp.setRequestHeader("Connection", "close");
	
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			response = xmlhttp.responseText;
			responseJSON = eval('(' + response + ')');
			//document.getElementById('chatText_' + receiver).innerHTML += "--\n<b>You:</b> " + responseJSON.ack;
			updateChatWindow(receiver, responseJSON.ack, 0);
		}
	}
	
	xmlhttp.send(postdata);
}

function chatPoll() {
	xmlhttp = initAjax();
	
	var chatObj = {
		action: 'poll',
		data: {
			sender: getMyUserID(),
			recver: 0
		}
	}
	
	jsondata = JSON.stringify(chatObj);
	postdata = 'json=' + jsondata;
	
	xmlhttp.open("POST", ajaxURL, true);
	
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", postdata.length);
	//xmlhttp.setRequestHeader("Connection", "close");
	
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			response = xmlhttp.responseText;
			responseJSON = eval('(' + response + ')');
			
			for(var n in responseJSON['messages']) {
				//document.getElementById('chatbox').innerHTML += "--\n<b>Friend:</b> " + responseJSON['messages'][n]['message'];
				popChatWindow(responseJSON['messages'][n]['from']);
				updateChatWindow(responseJSON['messages'][n]['from'], responseJSON['messages'][n]['message'], 1);
			}
			
			document.getElementById('myID').innerHTML = 'My ID: <b>' + getMyUserID() + '</b>';
			
			updateContactList(responseJSON['users']);
		}
	}
	
	xmlhttp.send(postdata);
}

/* --- End of chat client-server communication functions */
