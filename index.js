AOS.init();
// Counter function
function runCounter(counter) {
  if (counter.classList.contains("counted")) return;
  let target = +counter.dataset.target;
  let count = 0;

  const update = () => {
    count += Math.ceil(target / 100);
    if (count > target) count = target;
    counter.innerText = count + "+";
    if (count < target) setTimeout(update, 80);
  };

  update();
  counter.classList.add("counted");
}
// Detect when the counter comes into view
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      runCounter(entry.target);
    }
  });
}, { threshold: 0.5 });

// Watch all counters
document.querySelectorAll(".counter").forEach(counter => {
  observer.observe(counter);
});
//
  const toggle=document.getElementById('toggle');
  const input=document.getElementById('password');

  toggle.addEventListener('click',function(){
    if(input.type==='password'){
    input.type='text';
    toggle.classList.replace('bi-eye','bi-eye-slash');
     }else{
    input.type='password';
    toggle.classList.replace('bi-eye-slash','bi-eye');
     }
  });
document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("loginForm");
    const loginError = document.getElementById("loginError");
    const loginBtn = document.getElementById("loginbtn");
    const loginContainer = document.getElementById("loginform");
    const closeBtn = document.querySelector(".close-icon");

    // Open popup
    loginBtn.addEventListener("click", function() {
        loginContainer.style.display = "block";
    });

    // Close popup
    closeBtn.addEventListener("click", function() {
        loginContainer.style.display = "none";
        loginError.textContent = "";
    });

    // Validate before submitting
    // loginForm.addEventListener("submit", function(e) {
    //     const username = loginForm.username.value.trim();
    //     const password = loginForm.pass.value.trim();

    //     if (username === "" || password === "") {
    //         e.preventDefault(); // prevent form submission
    //         if(username === "" && password === ""){
    //             loginError.textContent = "Username and password are required";
    //         } else if(username === ""){
    //             loginError.textContent = "Username is required";
    //         } else {
    //             loginError.textContent = "Password is required";
    //         }
    //         loginContainer.style.display = "block"; // keep popup visible
    //     }
    // });
});
