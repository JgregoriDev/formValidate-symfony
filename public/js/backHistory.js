let bBack=document.querySelector("#bback");
console.log(bBack);
function volver() {
  history.back();
}
bBack.addEventListener("click",volver);