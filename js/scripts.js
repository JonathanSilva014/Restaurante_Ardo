function bigImg(imagem)
{
    mainImage = document.getElementById("pratoPrincipal");
    mainImage.src = imagem.src;
}

function reserva()
{
    popup = document.getElementById("ReservaPopup");
    popup.style.display = "block";
}

function openForm(id) 
{
    document.getElementById(id).style.display = "block";
}

function openReservaForm() 
{
    document.getElementById("ReservaOverlay").style.display = "block";
}

function openAutenticacaoForm() 
{
    document.getElementById("AutenticacaoOverlay").style.display = "block";
}
  
function closeForm(id) 
{
    document.getElementById(id).style.display = "none";
}

