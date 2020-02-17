

var mouseClickCapacite1 = function()
{
  let data = "capacites=" + 1;
  let xhr = new XMLHttpRequest();
  let div4 = document.querySelector('div#fenetre');
  xhr.open("POST", "script_capture5.php", true);
  xhr.addEventListener('readystatechange', function()
  {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
    {
       div4.innerHTML = xhr.responseText;
    }
     });

  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(data);
};

var mouseClickCapacite2 = function()
{
  let data = "capacites=" + 2;
  let xhr = new XMLHttpRequest();
  let div4 = document.querySelector('div#fenetre');
  xhr.open("POST", "script_capture5.php", true);
  xhr.addEventListener('readystatechange', function()
  {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
    {
       div4.innerHTML = xhr.responseText;
    }
     });

  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(data);
};

var mouseClickCapacite3 = function()
{
  let data = "capacites=" + 3;
  let xhr = new XMLHttpRequest();
  let div4 = document.querySelector('div#fenetre');
  xhr.open("POST", "script_capture5.php", true);
  xhr.addEventListener('readystatechange', function()
  {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
    {
       div4.innerHTML = xhr.responseText;
    }
     });

  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(data);
};

var mouseClickCapacite4 = function()
{
  let data = "capacites=" + 4;
  let xhr = new XMLHttpRequest();
  let div4 = document.querySelector('div#fenetre');
  xhr.open("POST", "script_capture5.php", true);
  xhr.addEventListener('readystatechange', function()
  {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
    {
       div4.innerHTML = xhr.responseText;
    }
     });

  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(data);
};



document.getElementById("capacites1").addEventListener("click", mouseClickCapacite1);

document.getElementById("capacites2").addEventListener("click", mouseClickCapacite2);

document.getElementById("capacites3").addEventListener("click", mouseClickCapacite3);

document.getElementById("capacites4").addEventListener("click", mouseClickCapacite4);
