function toggleSidenav() {
    const sidenav = document.getElementById('sidenav');
    const main = document.querySelector('.main');
    const toggleBtn = document.querySelector('.fas.fa-bars'); // Define the toggleBtn

    if (sidenav.classList.contains('sidenav-minimized')) {
        sidenav.classList.remove('sidenav-minimized');
        sidenav.style.width = '250px';
        main.style.marginLeft = '250px';
        toggleBtn.style.right = '10px';
    } else {
        sidenav.classList.add('sidenav-minimized');
        sidenav.style.width = '50px';
        main.style.marginLeft = '50px';
    }
}


  function setActive(link) {
    const links = document.querySelectorAll('.sidenav li a');
    links.forEach((item) => {
      item.parentElement.classList.remove('active');
    });
    link.parentElement.classList.add('active');
  }