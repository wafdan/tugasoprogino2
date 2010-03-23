/* skrip buat popup div */

document.onclick=check;

var Ary=[];

function check(e) {
	var target = (e && e.target) || (event && event.srcElement);
	while (target.parentNode) {
		if (target.className.match('pop')||target.className.match('poplink')) return;
		target=target.parentNode;
	}
	var ary=zxcByClassName('pop')
	for (var z0=0;z0<ary.length;z0++) {
		ary[z0].style.display='none';
	}
}
function zxcByClassName(nme,el,tag){
	if (typeof(el)=='string') el=document.getElementById(el);
	el=el||document;
	for (var tag=tag||'*',reg=new RegExp('\\b'+nme+'\\b'),els=el.getElementsByTagName(tag),ary=[],z0=0; z0<els.length;z0++){
		if(reg.test(els[z0].className)) ary.push(els[z0]);
	}
	return ary;
}

function toggle(layer_ref) {
	var hza = document.getElementById(layer_ref);
	if (hza && hza.style){
		if (!hza.set){ hza.set=true;  Ary.push(hza); }
		hza.style.display = (hza.style.display == '')? 'none':'';
	}
}
