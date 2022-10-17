const asideBar=document.querySelector("#asideBar");
const mainBar=document.querySelector("#mainBar");
const btnHideShowAside=document.querySelector("#btnHideShowAside");
btnHideShowAside.addEventListener("click",()=>{
  asideBar.classList.toggle("d-none");
  mainBar.classList.toggle("col-lg-12");
  btnHideShowAside.classList.toggle("border border-success");
})