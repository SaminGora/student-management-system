const profile=document.getElementById('profile');
const dropdown=document.getElementById('dropdown-block');
  
profile.addEventListener('click',function(){
    if (dropdown.style.display ==="block") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "block";
    }
});
document.addEventListener('click', (e) => {
  if (e.target !== profile && !dropdown.contains(e.target)) {
    dropdown.style.display = "none";
  }
});
//cross
const cross = document.getElementById('cross-icon');
const sidebar = document.getElementById('sidebar');
const menu=document.getElementById('menu-icon');
cross.addEventListener('click', function () {
   sidebar.style.display="none";
}); 
menu.addEventListener('click', function () {
     sidebar.style.display="block";
});

const hw = document.getElementById('homework');
const hwtoggle = document.getElementById('homework-toggle');

hw.addEventListener('click', function (e) {
   
    e.preventDefault(); // stop "#" link reload
    if (hwtoggle.style.display ==="block") {
        hwtoggle.style.display = "none";
    } else {
        hwtoggle.style.display = "block";
    }
});