// Eventos
window.addEventListener("load", getLoad);

var btn = document.getElementById("btnResize");
btn.addEventListener("click", function(){
    alert("clicking button");    
    document.body.style.height = document.getElementById("txtAlto").value + "px";
    document.body.style.width = document.getElementById("txtAncho").value + "px";
    alert("xy (" + document.body.style.height + ", " + document.body.style.width + ")");    
    getSize();
});

window.addEventListener("resize", getSize);

// Funciones
function getLoad(){    
    // Pasar valores a cajas de texto
    document.getElementById("txtAlto").value = document.body.scrollHeight;
    document.getElementById("txtAncho").value = document.body.scrollWidth;

    document.getElementById("div-container").style.height = document.body.scrollHeight;

    getSize();
}

function getHeight(){    
    alert("altura: " + document.body.style.height);
    document.getElementById("div-container").style.height = document.body.style.height;
}

function getSize(){
    alert("geting size");
    var wb = window.innerWidth;
    var hb = window.innerHeight;

    var ww = document.body.scrollWidth;
    var hw = document.body.scrollHeight;

    document.getElementById("browser_size").innerHTML = "Browser width (in pixels): " + wb + ", height: " + hb + ".";
    document.getElementById("window_size").innerHTML = "Canvas width (in pixels): " + ww + ", height: " + hw + ".";

    getHeight();

}

