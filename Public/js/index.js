const d = document;
d.addEventListener("DOMContentLoaded",()=>{
  d.addEventListener("change",(e)=>{
    if(e.target.matches("#options")) e.target.form.submit();
  });
  switch(location.pathname.split("/").pop()){
    case "index.php":
    case "":
      putWhateverModal(d.getElementById("modal"));
      break;
  }
});

const putWhateverModal = (modal) => {
  modal.addEventListener("show.bs.modal",(e)=>{
    d.getElementById("anchorModal").setAttribute("href","./delete.php?"+e.relatedTarget.getAttribute("data-bs-whatever"));
  });
}

