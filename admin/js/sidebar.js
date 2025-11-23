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

//students toggle
const sts = document.getElementById('student');
const ststoggle = document.getElementById('sts-toggle');

sts.addEventListener('click', function (e) {
    e.preventDefault(); // stop "#" link reload
    if (ststoggle.style.display ==="block") {
        ststoggle.style.display = "none";
    } else {
        ststoggle.style.display = "block";
    }
});

const teacher = document.getElementById('teacher');
const teachertoggle = document.getElementById('teacher-toggle');

teacher.addEventListener('click', function (e) {
   
    e.preventDefault(); // stop "#" link reload
    if (teachertoggle.style.display ==="block") {
        teachertoggle.style.display = "none";
    } else {
        teachertoggle.style.display = "block";
    }
});
const notice = document.getElementById('notice');
const noticetoggle = document.getElementById('notice-toggle');

notice.addEventListener('click', function (e) {
   
    e.preventDefault(); // stop "#" link reload
    if (noticetoggle.style.display === "block") {
        noticetoggle.style.display = "none";
    } else {
        noticetoggle.style.display = "block";
    }
});
const fee=document.getElementById('fee');
const fee_toggle=document.getElementById('fee-toggle');

fee.addEventListener('click',function(e){
     e.preventDefault(); // stop "#" link reload
    if (fee_toggle.style.display === "block") {
        fee_toggle.style.display = "none";
    } else {
        fee_toggle.style.display = "block";
    }
});

const cross = document.getElementById('cross-icon');
const sidebar = document.getElementById('sidebar');
const menu=document.getElementById('menu-icon');
cross.addEventListener('click', function () {
   sidebar.style.display="none";
}); 
menu.addEventListener('click', function () {
     sidebar.style.display="block";
});

