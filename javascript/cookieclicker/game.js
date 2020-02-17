var CookieClicker = {

	cookie:null,
	nbClick:0,
	memee:null,
	button:null,
	leftime:0,
	timer:null,
	click:false,

	game: function() {
		this.click = true;
		this.nbClick = 0;
		document.getElementsByTagName('span').item(0).innerHTML = this.nbClick;			
		this.decompte();
		document.getElementsByTagName('img').item(0).onclick = function() {
			CookieClicker.increment();
		};
	},

	increment: function() {
		if(this.click) {
			this.nbClick++;
			document.getElementsByTagName('span').item(0).innerHTML = this.nbClick;			
		}

	},

	start:function() {
		this.memee = document.getElementsByTagName('p').item(0);
		this.button = document.getElementsByTagName('button').item(0);
		this.button.onclick = function() {
			CookieClicker.memee.style.display = "block";
			CookieClicker.button.style.display = "none";
			CookieClicker.game();
		}

	},

	decompte:function() {
		this.leftime = 16;
		this.timer = window.setInterval(() => {
			this.leftime--;
			this.memee.getElementsByTagName('span').item(0).innerHTML = this.leftime + " seconds left";
			if(this.leftime == 3) {
				this.memee.getElementsByTagName('span').item(0).style.color = "red";
			}

			if(this.leftime == 1) {
				this.memee.getElementsByTagName('span').item(0).innerHTML = this.leftime + " second left";	
			}

			if(this.leftime == 0) {
				this.memee.getElementsByTagName('span').item(0).innerHTML = this.leftime + " second left";	
				console.log("perdu");
				window.clearInterval(this.timer);
				this.memee.style.display = "none";
				this.button.style.display = "block";
				this.click = false;
			}
		}, 1000);
	}

};

this.CookieClicker.start();