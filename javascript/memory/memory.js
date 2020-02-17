var Memory = {
    images : document.images,                                               //Récupération des images
    nb : 0,                                                                 //Nombre d'ampoule allumée (défini plus loin)
    leftTime : 10,                                                          //Temps restant = 10 au début
    timer : null,


    /*La fonction Jouer est lancée quand l'utilisateur clique sur le bouton Commencer
      Elle définie le nombre d'ampoule allumée, 
                   le temps restant (10), 
                   intègre le temps restant dans la div temps,
                   appelle la foncyion Decouvrir,
                   et la fonction Couvrir*/
    Jouer: function() {
        
        //document.getElementById("but").disabled = true;
        // Initialisation des messages (cachés par défaut) grâce à la fonction "Message"
		this.Message("gagne", false);
		this.Message("perdu", false);
        this.Message("temps", false);
        
        this.nb = 0;
        for (let amp of this.images){
            amp.state = (Math.random() > 0.5) ? true:false;
            if (amp.state) {
                this.nb++;
            }
        }
        this.leftTime = 10;

        document.getElementById("temps").innerText = this.leftTime;
        this.Decouvrir();
        window.setTimeout( ()=> this.Couvrir(),1000);
        // window.clearInterval(this.timer);
    },

    Couvrir: function() {
        for (let amp of this.images) {
            amp.src="off.png";
            amp.onclick = ()=>{
                if (amp.state) {
                    amp.src = "on.png";
                    amp.onclick = null;
                    this.nb--;
                    if (!this.nb) {
                        this.Fin("gagne");
                    } 
                } else {
                    this.Fin("perdu");
                }
            };
        }

        this.Message("temps", true);

        this.timer = window.setInterval(()=> {
            this.leftTime--;
            document.getElementById("temps").innerText = this.leftTime;
            if (this.leftTime == 0) {
                this.Fin("perdu");
            }
        },1000
        );
    },

    /*La fonction Fin es*/
    Fin: function(id) {
        this.Message(id,true);
        for(let amp of this.images) {
            amp.onclick = null;
        }
        window.clearInterval(this.timer); //arrêter le timer
        //document.getElementById("but").disabled = false;

    }, 
    
    Decouvrir: function() {
        for (let amp of this.images) {
            amp.src = (amp.state)? "on.png":"off.png";
        }
    },

    Message : function(id, etat) {
        document.getElementById(id).style.display = (etat)? "block":"none";
    }
}