//var div = $ ('#enemypokemon');

var mouseClickCapture = function()
{
  let xhr = new XMLHttpRequest();
  let xhr2 = new XMLHttpRequest();
  let xhr3 = new XMLHttpRequest();
  xhr.open("POST", "script_capture2.php", false);
  xhr.addEventListener('readystatechange', function()
  {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
    {
      div.innerHTML = xhr.responseText;
    }
  });
  xhr.send();

  xhr2.open("POST", "script_capture3.php", false);
  xhr2.addEventListener('readystatechange', function()
  {
    if (xhr2.readyState === XMLHttpRequest.DONE && xhr2.status === 200)
    {
      div2.innerHTML = xhr2.responseText;
      canCreateEvent();
    }
  });
  xhr2.send();

  let div3 = document.querySelector('p#places');
  xhr3.open("POST", "script_capture10.php", false);
  xhr3.addEventListener('readystatechange', function()
  {
    if (xhr3.readyState === XMLHttpRequest.DONE && xhr3.status === 200)
    {
      div3.innerHTML = xhr3.responseText;
      canCreateEvent4();
    }
  });
  xhr3.send();
  jaugePvEnemy();
};

var mouseClickAttaquer = function()
{
  var capa1 = document.getElementById("capacites1");
  var capa2 = document.getElementById("capacites2");
  var capa3 = document.getElementById("capacites3");
  var capa4 = document.getElementById("capacites4");
  if(capa1.innerHTML != "")
  {
    capa1.style.visibility = "visible";
  }
  if(capa2.innerHTML != "")
  {
    capa2.style.visibility = "visible";

  }
  if(capa3.innerHTML != "")
  {
    capa3.style.visibility = "visible";
  }
  if(capa4.innerHTML != "")
  {
    capa4.style.visibility = "visible";
  }
  var bouton1 = document.getElementById("attaquer");
  var bouton2 = document.getElementById("fuir");
  var bouton3 = document.getElementById("sac");
  var bouton4 = document.getElementById("capturer");
  bouton1.style.visibility = "hidden";
  bouton2.style.visibility = "hidden";
  bouton3.style.visibility = "hidden";
  bouton4.style.visibility = "hidden";

  document.getElementById("refresh").style.visibility = "visible";
};


var canCreateEvent = function()
{
  var div2 = document.querySelector('p#balls');
  var value = Number(div2.innerHTML);
  var canCreateEvent = false;
  if (!isNaN(value)){
    var noBalls = value <= 0;
    if(noBalls)
    {
      var capturer = document.getElementById("capturer");
      capturer.style.backgroundColor= "black";
      capturer.innerHTML = "PLUS DE POKEBALL";
      capturer.removeEventListener("click", mouseClickCapture);
    }
    else{
      canCreateEvent = true;
    }
  }
  return canCreateEvent;
};

var canCreateEvent2 = function()
{
    var div2 = document.querySelector('div#pvMy');
    var value = Number(div2.innerHTML);
    var canCreateEvent = false;
    if (!isNaN(value)){
      var noPV = value <= 0;
      if(noPV)
      {
        var attaquer = document.getElementById("attaquer");
        attaquer.style.backgroundColor= "black";
        attaquer.innerHTML = "POKEMON K.O";
        attaquer.removeEventListener("click", mouseClickAttaquer);
        var soin = document.getElementById("sac");
        soin.style.backgroundColor= "black";
        soin.innerHTML = "POKEMON K.O";
        soin.removeEventListener("click", mouseClickSoin);
      }
      else{
        canCreateEvent = true;
      }
    }
    return canCreateEvent;
  };

var canCreateEvent3 = function()
{
  var div2 = document.querySelector('p#potions');
  var value = Number(div2.innerHTML);
  var canCreateEvent = false;
  if (!isNaN(value)){
    var noPot = value <= 0;
    if(noPot)
    {
      var soin = document.getElementById("sac");
      soin.style.backgroundColor= "black";
      soin.innerHTML = "PLUS DE POTION";
      soin.removeEventListener("click", mouseClickSoin);
    }
    else
    {
      canCreateEvent = true;
    }
  }
  return canCreateEvent;
};

var canCreateEvent4 = function()
{
  var div2 = document.querySelector('p#places');
  var value = Number(div2.innerHTML);
  var canCreateEvent = false;
  if (!isNaN(value)){
    var noPlace = value >= 20;
    if(noPlace)
    {
      var capturer = document.getElementById("capturer");
      capturer.style.backgroundColor= "black";
      capturer.innerHTML = "LE PC EST REMPLI";
      capturer.removeEventListener("click", mouseClickCapture);
    }
    else{
      canCreateEvent = true;
    }
  }
  return canCreateEvent;
};

var mouseClickFuir = function()
{
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "script_capture.php", false);
  xhr.addEventListener('readystatechange', function()
  {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
    {
        div.innerHTML = xhr.responseText;
    }
  });
  xhr.send();
  jaugePvEnemy();
  };

var mouseClickSoin = function()
{
  let xhr = new XMLHttpRequest();
  let potion = document.querySelector('p#potions');
  xhr.open("POST", "script_capture9.php", false);
  xhr.addEventListener('readystatechange', function()
  {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
    {
        potion.innerHTML = xhr.responseText;
        canCreateEvent3();
    }
  });
  xhr.send();

  let xhr4 = new XMLHttpRequest();
  let div7 = document.querySelector('div#pvMy');
  xhr4.open("GET", "script_capture6.php", false);
  xhr4.addEventListener('readystatechange', function()
  {
    if(xhr4.readyState === XMLHttpRequest.DONE && xhr4.status === 200)
    {
      div7.innerHTML = xhr4.responseText;
    }
  });
  xhr4.send();

  jaugePvMy();
};

var getPvMaxMyPokemon = function()
{
      let xhr = new XMLHttpRequest();
      let pvmaxmy;
      xhr.open("POST", "pv_max_my_pokemon.php", false);
      xhr.addEventListener('readystatechange', function()
      {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
        {
           pvmaxmy = Number(xhr.responseText);
        }
      });
      xhr.send();
      //console.log(pvmaxmy);
      return pvmaxmy;
    }
var getPvMaxEnemyPokemon = function()
{
    let pvmaxenemy;
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "pv_max_enemy_pokemon.php", false);
      xhr.addEventListener('readystatechange', function()
      {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
        {
           pvmaxenemy = Number(xhr.responseText);
        }
      });
      xhr.send();

      return pvmaxenemy;
    }

var capacite = function()
{
  let xhr2 = new XMLHttpRequest();
  let div5 = document.querySelector('div#pvEnemy.pv');
  xhr2.open("GET", "script_capture4.php", false);
  xhr2.addEventListener('readystatechange', function()
  {
    if(xhr2.readyState === XMLHttpRequest.DONE && xhr2.status === 200)
    {
      div5.innerHTML = xhr2.responseText;
    }
  });
  xhr2.send();
  let div6 = document.querySelector('div#pvMy');
  let xhr4 = new XMLHttpRequest();
  let div7 = document.querySelector('div#mypkn');
  xhr4.open("GET", "script_capture7.php", false);
  xhr4.addEventListener('readystatechange', function()
  {
    if(xhr4.readyState === XMLHttpRequest.DONE && xhr4.status === 200)
    {
      div7.innerHTML = xhr4.responseText;
    }
  });
  xhr4.send();
  let xhr5 = new XMLHttpRequest();
  xhr5.open("POST", "script_capture8.php", false);
  let div8 = document.querySelector('p#pieces');
  xhr5.addEventListener('readystatechange', function()
  {
    if (xhr5.readyState === XMLHttpRequest.DONE && xhr5.status === 200)
    {
      div8.innerHTML = xhr5.responseText;
    }
  });
  xhr5.send();

  if(Number(div5.innerHTML) == 0)
  {
    mouseClickFuir();
  }
  //console.log(div7.firstElementChild.firstElementChild.nextElementSibling.innerHTML);
  if(Number(div7.firstElementChild.firstElementChild.nextElementSibling.innerHTML) == 0)
  {
    redirection();
  }
  //var pvnowmy = document.querySelector('div#pvMy');
  //console.log(pvmaxmy);
  jaugePvMy();
  jaugePvEnemy();
};

var mouseClickCapacite1 = function()
{
      document.getElementById("fenetre").style.visibility = "visible";
      let data = "capacites=" + 1;
      let xhr = new XMLHttpRequest();
      let div4 = document.querySelector('div#fenetre');
      xhr.open("POST", "script_capture5.php", false);
      xhr.addEventListener('readystatechange', function()
      {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
        {
           div4.innerHTML = xhr.responseText;
        }
         });

      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send(data);
      capacite();
};

var mouseClickCapacite2 = function()
{
      document.getElementById("fenetre").style.visibility = "visible";
      let data = "capacites=" + 2;
      let xhr = new XMLHttpRequest();
      let div4 = document.querySelector('div#fenetre');
      xhr.open("POST", "script_capture5.php", false);
      xhr.addEventListener('readystatechange', function()
      {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
        {
           div4.innerHTML = xhr.responseText;
        }
         });

      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send(data);

      capacite();
    };

var mouseClickCapacite3 = function()
{
      document.getElementById("fenetre").style.visibility = "visible";
      let data = "capacites=" + 3;
      let xhr = new XMLHttpRequest();
      let div4 = document.querySelector('div#fenetre');
      xhr.open("POST", "script_capture5.php", false);
      xhr.addEventListener('readystatechange', function()
      {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
        {
           div4.innerHTML = xhr.responseText;
        }
      });
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.send(data);
      capacite();
    };

var mouseClickCapacite4 = function()
{
      document.getElementById("fenetre").style.visibility = "visible";
      let data = "capacites=" + 4;
      let xhr = new XMLHttpRequest();
      let div4 = document.querySelector('div#fenetre');
      xhr.open("POST", "script_capture5.php", false);
      xhr.addEventListener('readystatechange', function()
      {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
        {
           div4.innerHTML = xhr.responseText;
        }
      });

      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send(data);
      capacite();
    };

var jaugePvMy = function()
{
  let div6 = document.querySelector('div#pvMy');
  let pvmaxmy = getPvMaxMyPokemon();
  let pourcentage = Number(div6.innerHTML) * 100 / pvmaxmy;
  if(pourcentage <= 15)
  {
    document.querySelector('div#jaugeMy').className = "couleurRouge";
  }
  else if(pourcentage <= 50)
  {
    document.querySelector('div#jaugeMy').className = "couleurJaune";
  }
  else
  {
    document.querySelector('div#jaugeMy').className = "couleurVerte";
  }
  //console.log(pourcentage);
  document.querySelector('div#jaugeMy').style.width = pourcentage+"%";
};

var jaugePvEnemy = function()
{
  let pvmaxenemy = getPvMaxEnemyPokemon();
  let div7 = document.querySelector('div#pvEnemy');
  let pourcentage2 = Number(div7.innerHTML) * 100 / pvmaxenemy;
  if(pourcentage2 <= 15)
  {
    document.querySelector('div#jaugeEnemy').className = "couleurRouge";
  }
  else if(pourcentage2 <= 50)
  {
    document.querySelector('div#jaugeEnemy').className = "couleurJaune";
  }
  else
  {
    document.querySelector('div#jaugeEnemy').className = "couleurVerte";
  }
  document.querySelector('div#jaugeEnemy').style.width = pourcentage2+"%";
};

var redirection = function()
{
  document.location.href="capture.php";
};

var div = document.querySelector('div#enemypokemon');
var div2 = document.querySelector('p#balls');
document.getElementById("fuir").addEventListener("click", mouseClickFuir);

if(canCreateEvent())
{
  document.getElementById("capturer").addEventListener("click", mouseClickCapture);
}
if(canCreateEvent2())
{
  document.getElementById("attaquer").addEventListener("click", mouseClickAttaquer);
}

if(canCreateEvent3())
{
  document.getElementById("sac").addEventListener("click", mouseClickSoin);
}

if(canCreateEvent4())
{
  document.getElementById("capturer").addEventListener("click", mouseClickCapture);
}

document.getElementById("capacites1").addEventListener("click", mouseClickCapacite1);

document.getElementById("capacites2").addEventListener("click", mouseClickCapacite2);

document.getElementById("capacites3").addEventListener("click", mouseClickCapacite3);

document.getElementById("capacites4").addEventListener("click", mouseClickCapacite4);

document.getElementById("refresh").addEventListener("click", redirection);
