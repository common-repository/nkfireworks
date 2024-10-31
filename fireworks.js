// Definitions
nkf.posx = new Array();
nkf.posy = new Array();
//speedx = Math.random() * nkf.maxstepx;
nkf.speedy = new Array();
nkf.active = new Array();
nkf.actives = nkf.rockets;
nkf.state = new Array();
nkf.delay = new Array();

nkf.maxwidth = window.innerWidth;
nkf.maxheight = window.innerHeight;
if (!nkf.maxwidth) {
	nkf.maxwidth = document.documentElement.clientWidth;
	nkf.maxheight = document.documentElement.clientHeight;
}
if (!nkf.maxwidth) {
	nkf.maxwidth = document.body.clientWidth;
	nkf.maxheight = document.body.clientHeight;
}

// Create some position + movement data
for (i = 0; i < nkf.rockets; i++) {
	// starting position
	nkf.posy[i] = nkf.maxheight + nkf.flakesize;
	nkf.posx[i] = nkf.maxwidth / nkf.rockets * i;
	// movement
	nkf.speedy[i] = 15 + Math.random() * (nkf.maxstepy);
	nkf.active[i] = true;
	// state (grounded, rocket, explosion)
	nkf.state[i] = 'grounded';
	// delay
	nkf.delay[i] = Math.random() * 100;
}

if (window.onload) {
	nkf.oldonload = window.onload;
}
window.onload=function(){
	currentTime = new Date();
	nkf.endtime = currentTime.getTime() + nkf.maxtime;
	// http://www.javascriptkit.com/javatutors/navigator.shtml
	if(navigator) {
		if(navigator.userAgent) {
			if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)){
				var ieversion=new Number(RegExp.$1) 
			}
		}
	}
	for (i = 0; i < nkf.rockets; i++) {
		if (ieversion && ieversion==6) {
			// ie sucks
			document.getElementById('nkf' + i).style.position='absolute';
		}
	}
	fireworks(nkf);
	if (nkf.oldonload) {
		nkf.oldonload();
	}
}

function fireworks(nkf) {
	currentTime = new Date();
	for (i = 0; i < nkf.rockets; i++) {
		if (nkf.active[i] === true) {
			// Explosion
			if (nkf.state[i] == 'explosion') {
				nkf.delay[i]--;
				if (nkf.delay[i] <= 0) {
					document.getElementById('nkf' + i).style.visibility='hidden';
					nkf.delay[i] = Math.random() * 50;
					nkf.state[i] = 'grounded';
					nkf.posy[i] = nkf.maxheight + nkf.flakesize;
					nkf.posx[i] = Math.random() * nkf.maxwidth;
					document.getElementById('nkf' + i).style.top=nkf.posy[i] + "px";
					//document.getElementById('nkf' + i).style.top="800";
					document.getElementById('nkf' + i).src=nkf.picsurl + 'rocket.gif';
				}
			}
			// Rocket
			else if (nkf.state[i] == 'rocket') {
				nkf.posy[i] = nkf.posy[i] - nkf.speedy[i];
				document.getElementById('nkf' + i).style.top=nkf.posy[i] + "px";
				document.getElementById('nkf' + i).style.left=nkf.posx[i] + "px";
				if (nkf.posy[i] < nkf.maxheight / 3) {
					if (Math.random() * 100 > 90 || nkf.posy[i] < 100) {
						document.getElementById('nkf' + i).style.visibility='hidden';
						nkf.delay[i] = 30;
						nkf.state[i] = 'explosion';
						document.getElementById('nkf' + i).style.top=nkf.posy[i] - nkf.flakesize / 2 +  "px";
						document.getElementById('nkf' + i).style.left=nkf.posx[i] - nkf.flakesize / 2 + "px";
						document.getElementById('nkf' + i).src=nkf.picsurl + 'fire' + Math.round(Math.random() * 2) + '.gif?rnd=' + Math.round(Math.random() * nkf.rockets); // FIXME
						document.getElementById('nkf' + i).style.visibility='visible';
					}
				}
			}
			// Grounded
			else if (nkf.state[i] == 'grounded') {
				nkf.delay[i]--;
				if (nkf.delay[i] <= 0) {
					nkf.state[i] = 'rocket';
					document.getElementById('nkf' + i).style.visibility='visible';
				}
				if (currentTime.getTime() > nkf.endtime) {
					nkf.active[i] = false;
					//document.getElementById('nkfireworks' + i).style.top=-nkf.flakesize;
					nkf.actives--;
				}
			}
		}
	}
	if (nkf.actives > 0) {
		window.setTimeout("fireworks(nkf)", nkf.timeout);
	}
}
