var url = 'discussionhandler.php';

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

function gotoTopicListPage(cinstid, page) {
	if(page < 1) {
		return;
	}
	
	xmlhttp = initAjax();
	
	count = 10;
	offset = (page-1) * count;
	
	postdata = 'action=gettopiclist&cinstid=' + cinstid + '&count=' + count + '&offset=' + offset;
	
	xmlhttp.open("POST", url, true);
	
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", postdata.length);
	
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			response = xmlhttp.responseText;
			responseJSON = eval('(' + response + ')');
			updateTopicList(cinstid, page, responseJSON);
		}
	}
	
	xmlhttp.send(postdata);
}

function gotoTopicPostPage(topicid, page) {
	if(page < 1) {
		return;
	}
	
	xmlhttp = initAjax();
	
	count = 10;
	offset = (page-1) * count;
	
	postdata = 'action=gettopicpost&topicid=' + topicid + '&count=' + count + '&offset=' + offset;
	
	xmlhttp.open("POST", url, true);
	
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", postdata.length);
	
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			response = xmlhttp.responseText;
			responseJSON = eval('(' + response + ')');
			updateTopicPost(topicid, page, responseJSON['post']);
		}
	}
	
	xmlhttp.send(postdata);
}

function updateTopicList(cinstid, page, topicsData) {
	if(topicsData.length == 0) {
		return;
	}
	
	content = '<table>';
	
	for(var n in topicsData) {
		content += '<tr>';
        content += '<td><a href="discussion.php?courseinstanceid=' + cinstid + '&viewtopic=' + topicsData[n]['id'] + '">' + topicsData[n]['title'] + '</td>';
        content += '<td><a href="profile.php?id=' + topicsData[n]['userid'] + '">' + topicsData[n]['username'] + '</a></td>';
        content += '<td>' + topicsData[n]['time'] + '</td>';
        content += '</tr>';
	}
	
	content += '</table>';
	
	document.getElementById('topicList').innerHTML = content;
	
	document.getElementById('page').innerHTML = page;
	document.getElementById('prevPage').setAttribute('onclick', 'gotoTopicListPage(' + cinstid + ', ' + (page-1) + ')');
	document.getElementById('nextPage').setAttribute('onclick', 'gotoTopicListPage(' + cinstid + ', ' + (page+1) + ')');
}

function updateTopicPost(topicid, page, postsData) {
	if(!postsData) {
		return;
	}
	
	content = '<table>';
	
	for(var n in postsData) {
		content += '<tr>';
		content += '<td>' + postsData[n]['username'] + '</td>';
		content += '<td>' + postsData[n]['content'] + '</td>';
		content += '<td>' + postsData[n]['time'] + '</td>';
		content += '</tr>';
	}
	
	content += '</table>';
	
	document.getElementById('topicDetail').innerHTML = content;
	document.getElementById('page').innerHTML = page;
	document.getElementById('prevPage').setAttribute('onclick', 'gotoTopicPostPage(' + topicid + ', ' + (page-1) + ')');
	document.getElementById('nextPage').setAttribute('onclick', 'gotoTopicPostPage(' + topicid + ', ' + (page+1) + ')');
}