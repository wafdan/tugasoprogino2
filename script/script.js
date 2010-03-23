var css = 1;

var kota = new Array();

kota[1] = new Array('Cilandak','Kebayoran Lama','Kebon Jeruk','Senen','Tebet');
kota[2] = new Array('Bandung','Bekasi','Bogor','Depok','Sukabumi');
kota[3] = new Array('Bukittinggi','Padang','Padang Panjang','Pesisir Selatan','Solok');
ListKota = new Array();

var iconYes = "images/12-em-check_12x12.png";
var iconNo = "images/12-em-cross_12x12.png";
var Alvin = "images/Alvin.jpg";
var Andika = "images/Andika.jpg";
var Bayu = "images/Bayu.jpg";

function CheckNama(){
	var nama_regex = /^[a-z ]{5,}$/i;
	var nama_text = document.getElementById('name');
	var icon = document.getElementById('name_img');
	icon.style.visibility="visible";
	if (nama_text.value != "") {
		if (nama_regex.test(nama_text.value)) {
			icon.src = iconYes;
			return true;
		}
		else {
			icon.src = iconNo;
			return false;
		}
	}
	else {
		icon.style.visibility = "hidden";
	}
}

function CheckUserName(){
	var username_regex= /^[.a-z0-9_]{5,}$/i;
	var username_text = document.getElementById('username');
	var icon = document.getElementById('username_img');
	icon.style.visibility="visible";
	if (username_text.value != "") {
		if (username_regex.test(username_text.value)) {
			icon.src = iconYes;
			return true;
		}
		else {
			icon.src = iconNo;
			return false;
		}
	}
	else {
		icon.style.visibility="hidden";
	}
}

function CheckPassword(){
	var password_regex= /.{6,}/;
	var password_text = document.getElementById('password');
	var icon = document.getElementById('password_img');
	icon.style.visibility="visible";
	if (password_text.value != "") {
		if (password_regex.test(password_text.value)) {
			icon.src = iconYes;
			return true;
		}
		else {
			icon.src = iconNo;
			return false;
		}
	}
	else {
		icon.style.visibility="hidden";
	}
}

function CheckPassword2(){
	var password_text = document.getElementById('password');
	var password2_text = document.getElementById('password2');
	var icon = document.getElementById('password2_img');
	icon.style.visibility="visible";
	if (password2_text.value != "") {
		if (password2_text.value===password_text.value) {
			icon.src = iconYes;
			return true;
		}
		else {
			icon.src = iconNo;
			return false;
		}
	}
	else {
		icon.style.visibility="hidden";
	}
}
	
function CheckPhoto(){
	var photo_regex = /((\.jpg)|(\.jpeg)|(\.png)|(\.bmp))$/i;
	var photo_text = document.getElementById('photo');
	var icon = document.getElementById('photo_img');
	icon.style.visibility="visible";
	if (photo_text.value != "") {
		if (photo_regex.test(photo_text.value)) {
			icon.src = iconYes;
			return true;
		} 
		else {
			icon.src = iconNo;
			return false;
		}
	}
	else {
		icon.style.visibility="hidden";
	}
}

function CheckProvince(){
	var province_option = document.getElementById('province');
}

function CheckPhone(){
	var phone_regex = /^\+?[0-9]{7,}$/;
	var phone_text = document.getElementById('phone');
	var icon = document.getElementById('phone_img');
	icon.style.visibility="visible";
	if (phone_text.value != "") {
		if (phone_regex.test(phone_text.value)) {
			icon.src = iconYes;
			return true;
		}
		else {
			icon.src = iconNo;
			return false;
		}
	}
	else {
		icon.style.visibility="hidden";
	}
}

function CheckBirthday(){
	var birthday_regex = /(\d{4})-(0[13578]|1[02])-(0[1-9]|[12]\d|3[01])|(\d{4})-(0[469]|11])-(0[1-9]|[12]\d|30)|(\d\d[0248][048]|\d\d[13579][26])-(02)-(0[1-9]|1\d|2\d)|(\d\d[0248][1235679]|\d\d[13579][01345789])-(02)-(0[1-9]|1\d|2[0-8])/;
	var birthday_text = document.getElementById('birthday');
	var icon = document.getElementById('birthday_img');
	icon.style.visibility="visible";
	if (birthday_text.value != "") {
		if(birthday_regex.test(birthday_text.value)) {
			icon.src = iconYes;
			return true;
		}
		else {
			icon.src = iconNo;
			return false;
		}
	}
	else {
		icon.style.visibility="hidden";
	}
}

function CheckAddress(){
	var address_regex = /.{11,}/;
	var address_text = document.getElementById('address');
	var icon = document.getElementById('address_img');
	icon.style.visibility="visible";
	if (address_text.value != "") {
		if (address_regex.test(address_text.value)) {
			icon.src = iconYes;
			return true;
		}
		else {
			icon.src = iconNo;
			return false;
		}
	}
	else {
		icon.style.visibility="hidden";
	}
}

function CheckEmail(){
	var email_regex = /^[.a-z0-9_]{5,}@(([a-z0-9])+.)+([a-z0-9]{2,4})+$/i;
	var email_text = document.getElementById('email');
	var icon = document.getElementById('email_img');
	icon.style.visibility="visible";
	if (email_text.value != "") {
		if (email_regex.test(email_text.value)) {
			icon.src = iconYes;
			return true;
		}
		else {
			icon.src = iconNo;
			return false;
		}
	}
	else {
		icon.style.visibility="hidden";
	}
}

function CheckAll() {
	return CheckAddress() && CheckPassword2() && CheckBirthday() && CheckEmail() && CheckNama() && CheckPassword() && CheckPhone() && CheckPhoto() && CheckUserName();
}

function SyncKotaText() {
	var index;
	var city_text = document.getElementById('city_text');
	if (city_text.value != "") {
		var sudah_ada = false;
		for (i = 0; i < ListKota.length; i++) {
			if (ListKota[i] == city_text.value) {
				sudah_ada = true;
				index = i;
				break;
			}
		}
		if (!sudah_ada) {
			AddKota(city_text.value);
			index = ListKota.length - 1;
		}
		selectField = document.getElementById('city');
		selectField.selectedIndex = index;
	}
}

function SyncKotaDDList() {
	var index;
	var city_text = document.getElementById('city_text');
	selectField = document.getElementById('city');
	city_text.value = selectField.options[selectField.selectedIndex].text;		
}

function AddKota(newKota) {
	ListKota.push(newKota);
	changeSelect('city', ListKota, ListKota);	
}

function setKota() {
  provinceSel = document.getElementById('province');
  ListKota = kota[provinceSel.value];
  changeSelect('city', ListKota, ListKota);
}

function changeSelect(fieldID, newOptions, newValues) {
  selectField = document.getElementById(fieldID);
  selectField.options.length = 0;
  for (i=0; i<newOptions.length; i++) {
    selectField.options[selectField.length] = new Option(newOptions[i], newValues[i]);
  }
  SyncKotaDDList();
}

var switchCSS = function(newCSS) {
    if(newCSS != css) {
        css = newCSS;
        var cssLink = document.getElementById("unique-style");
        cssLink.href = "css/style" + css + ".css";
    }
}

var switchCSSprof = function(newCSS) {
    if(newCSS != css) {
        css = newCSS;
        var cssLink = document.getElementById("unique-style");
        cssLink.href = "css/styleprofile" + css + ".css";
    }
}

function setGallery(picno) {	
	var pic = document.getElementById('galleryBig');	
	if (picno == 1) {
		pic.src = Andika;
	}
	else if (picno == 2) {
		pic.src = Bayu;
	}
	else {
		pic.src = Alvin;
	}
}

var nothingHappens = function() {
    alert("Nothing happens");
}

var submitRegistration = function() {
    if(CheckAll()) alert("Informasi valid"); else alert("Informasi tidak valid");
}

//Calendar Script

// Array dari maksimum hari dalam tiap bulan di tahun biasa dan tahun kabisat
monthMaxDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
monthMaxDaysLeap = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
hideSelectTags = [];

function getRealYear(dateObj) {
	return (dateObj.getYear() % 100) + (((dateObj.getYear() % 100) < 39) ? 2000 : 1900);
}

function getDaysPerMonth(month, year) {	
	if ((year % 4) == 0) {
		if ((year % 100) == 0 && (year % 400) != 0) {
			return monthMaxDays[month];
		}
		else {
			return monthMaxDaysLeap[month];
		}
	}
	else {
		return monthMaxDays[month];
	}
}

function createCalender(year, month, day) {
	var curDate = new Date();
	var curDay = curDate.getDate();
	var curMonth = curDate.getMonth();
	var curYear = getRealYear(curDate);

	if (!year) {
		var year = curYear;
		var month = curMonth;
	}

	var yearFound = 0;
	for (var i=0; i<document.getElementById('selectYear').options.length; i++) {
		if (document.getElementById('selectYear').options[i].value == year) {
			document.getElementById('selectYear').selectedIndex = i;
			yearFound = true;
			break;
		}
	}
	
	if (!yearFound) {
		document.getElementById('selectYear').selectedIndex = 0;
		year = document.getElementById('selectYear').options[0].value;		
	}
	
	document.getElementById('selectMonth').selectedIndex = month;

	var firstDayOfMonthObj = new Date(year, month, 1);
	var firstDayOfMonth = firstDayOfMonthObj.getDay();

	continu		= true;
	firstRow	= true;
	var x	= 0;
	var d	= 0;
	var trs = []
	var ti = 0;
	
	while (d <= getDaysPerMonth(month, year)){
		if (firstRow) {
			trs[ti] = document.createElement("TR");
			if (firstDayOfMonth > 0) {
				while (x < firstDayOfMonth) {
					trs[ti].appendChild(document.createElement("TD"));
					x++;
				}
			}
			firstRow = false;
			var d = 1;
		}
		
		if (x % 7 == 0) {
			ti++;
			trs[ti] = document.createElement("TR");
		}
		
		if (day && d == day) {
			var setID = 'calenderChoosenDay';
			var styleClass = 'choosenDay';
			var setTitle = 'this day is currently selected';
		}
		else if (d == curDay && month == curMonth && year == curYear) {
			var setID = 'calenderToDay';
			var styleClass = 'toDay';
			var setTitle = 'this day today';
		}
		else {
			var setID = false;
			var styleClass = 'normalDay';
			var setTitle = false;
		}
		
		var td = document.createElement("TD");
		td.className = styleClass;
		
		if (setID) {
			td.id = setID;
		}
		
		if (setTitle) {
			td.title = setTitle;
		}
		
		td.onmouseover = new Function('highLiteDay(this)');
		td.onmouseout = new Function('dehighLiteDay(this)');
		
		if (targetEl) {
			td.onclick = new Function('pickDate('+year+', '+month+', '+d+')');
		}
		else {
			td.style.cursor = 'default';
		}
		
		td.appendChild(document.createTextNode(d));
		trs[ti].appendChild(td);
		x++;
		d++;
	}
	return trs;
}

function showCalender(elPos, tgtEl) {
	targetEl = false;

	if (document.getElementById(tgtEl)) {
		targetEl = document.getElementById(tgtEl);
	}
	else {
		if (document.forms[0].elements[tgtEl]) {
			targetEl = document.forms[0].elements[tgtEl];
		}
	}
	
	var calTable = document.getElementById('calenderTable');

	var positions = [0,0];
	var positions = getParentOffset(elPos, positions);	
	calTable.style.left = positions[0]+'px';		
	calTable.style.top = positions[1]+'px';			

	calTable.style.display='block';

	var matchDate = new RegExp('^([0-9]{4})-([0-9]{2})-([0-9]{2})$');
	var m = matchDate.exec(targetEl.value);
	if (m == null) {
		trs = createCalender(false, false, false);
		showCalenderBody(trs);
	}
	else {
		if (m[3].substr(0, 1) == 0) {
			m[3] = m[3].substr(1, 1);
		}
		if (m[2].substr(0, 1) == 0) {
			m[2] = m[2].substr(1, 1);
		}
		m[2] = m[2] - 1;
		trs = createCalender(m[1], m[2], m[3]);
		showCalenderBody(trs);
	}

	hideSelect(document.body, 1);
}

function showCalenderBody(trs) {
	var calTBody = document.getElementById('calender');
	
	while (calTBody.childNodes[0]) {
		calTBody.removeChild(calTBody.childNodes[0]);
	}
	
	for (var i in trs) {
		calTBody.appendChild(trs[i]);
	}
}

function setYears(startY, endY) {
	
	var curDate = new Date();
	var curYear = getRealYear(curDate);
	
	if (startY) {
		startYear = curYear;
	}
	if (endY) {
		endYear = curYear;
	}
	
	document.getElementById('selectYear').options.length = 0;
	var j = 0;
	for (y=endY; y>=startY; y--) {
		document.getElementById('selectYear')[j++] = new Option(y, y);
	}
}

function hideSelect(el, superTotal) {
	if (superTotal >= 100) {
		return;
	}

	var totalChilds = el.childNodes.length;
	for (var c=0; c<totalChilds; c++) {
		var thisTag = el.childNodes[c];
		if (thisTag.tagName == 'SELECT') {
			if (thisTag.id != 'selectMonth' && thisTag.id != 'selectYear') {
				var calenderEl = document.getElementById('calenderTable');
				var positions = [0,0];
				var positions = getParentOffset(thisTag, positions);	// nieuw
				var thisLeft = positions[0];
				var thisRight = positions[0] + thisTag.offsetWidth;
				var thisTop	= positions[1];
				var thisBottom	= positions[1] + thisTag.offsetHeight;
				var calLeft	= calenderEl.offsetLeft;
				var calRight = calenderEl.offsetLeft + calenderEl.offsetWidth;
				var calTop = calenderEl.offsetTop;
				var calBottom = calenderEl.offsetTop + calenderEl.offsetHeight;

				if (((thisLeft >= calLeft && thisLeft <= calRight)||(thisRight <= calRight && thisRight >= calLeft)||(thisLeft <= calLeft && thisRight >= calRight))
					&&
					((thisTop >= calTop && thisTop <= calBottom)||(thisBottom <= calBottom && thisBottom >= calTop)||(thisTop <= calTop && thisBottom >= calBottom))) { 
					hideSelectTags[hideSelectTags.length] = thisTag;
					thisTag.style.display = 'none';
				}
			}
		}
		else if(thisTag.childNodes.length > 0) {
			hideSelect(thisTag, (superTotal+1));
		}
	}
}

function closeCalender() {
	for (var i=0; i<hideSelectTags.length; i++) {
		hideSelectTags[i].style.display = 'block';
	}
	hideSelectTags.length = 0;
	document.getElementById('calenderTable').style.display = 'none';
}

function highLiteDay(el) {
	el.className = 'hlDay';
}

function dehighLiteDay(el) {
	if (el.id == 'calenderToDay') {
		el.className = 'toDay';
	}
	else if (el.id == 'calenderChoosenDay') {
		el.className = 'choosenDay';
	}
	else {
		el.className = 'normalDay';
	}
}

function pickDate(year, month, day) {
	month++;
	day	= day < 10 ? '0'+day : day;
	month	= month < 10 ? '0'+month : month;
	
	if (!targetEl) {
		alert('target for date is not set yet');
	}
	else {
		targetEl.value = year+'-'+month+'-'+day;
		closeCalender();
		CheckBirthday();
	}
}

function getParentOffset(el, positions) {
	positions[0] += el.offsetLeft;
	positions[1] += el.offsetTop;
	
	if (el.offsetParent) {
		positions = getParentOffset(el.offsetParent, positions);
	}
	
	return positions;
}
//End Calendar Script