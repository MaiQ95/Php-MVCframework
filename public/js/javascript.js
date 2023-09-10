'use strict'
//window.alert("sometext");
const body = document.querySelector('body');
//Change theme button
const themeButton = document.querySelector('.changeTheme');
// Change page themeButton
const navLink = document.querySelector('.nav-link');

//ok
const handleDarkMode = () => {
  if(body.getAttribute('data-mode') === 'light'){
    body.setAttribute('data-mode', 'dark');
    localStorage.setItem('theme', 'dark');
    sessionStorage.setItem('theme', 'dark');
  }else{
    body.setAttribute('data-mode', 'light');
    localStorage.setItem('theme', 'light');
    sessionStorage.setItem('theme', 'light');
  }
}
//ok
themeButton.addEventListener('click', handleDarkMode);

// Check Local storage for theme
if (sessionStorage.getItem('theme') != null) {
  const setTheme = sessionStorage.getItem('theme');
  body.setAttribute('data-mode', setTheme);
  localStorage.setItem('theme', setTheme);
} else if (localStorage.getItem('theme') != null) {
  const currentTheme = localStorage.getItem('theme');
  sessionStorage.setItem('theme', currentTheme);
  body.setAttribute('data-mode', currentTheme);
} else {
  body.setAttribute('data-mode', 'dark');
}
//Navbar show (.collapse:not(.show))
const toggleMenu = () => {
  const menu = document.querySelector('.navbar-collapse');

  if (menu.classList.contains("collapse")) {
    menu.classList.remove("collapse");
  } else {
    menu.classList.add("collapse");
  }
}
const hamburgerButton = document.querySelector('.navbar-toggler');
hamburgerButton.addEventListener('click', toggleMenu);

// Filter Table
function myFunction() {
  // Declare variables
  let input = document.querySelector('.search-textarea');
  let filter = input.value.toUpperCase();
  const table = document.querySelector('table');
  const tr = table.getElementsByTagName("tr");
  let txtValue;
  let txtValue2;
  let i;

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    let td = tr[i].getElementsByTagName("td")[0];
    let th = tr[i].getElementsByTagName("th")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
    if (th) {
      txtValue2 = th.textContent || th.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
      tr[i].style.display = "";
    } else {
        tr[i].style.display = "none";
      }
    }
  }
}}


// Sort table
function table_sort() {
  const styleSheet = document.createElement('style')
  styleSheet.innerHTML = `
        .order-inactive span {
            visibility:hidden;
        }
        .order-inactive:hover span {
            visibility:visible;
        }
        .order-active span {
            visibility: visible;
        }
    `
  document.head.appendChild(styleSheet)

  document.querySelectorAll('th.order').forEach(th_elem => {
    let asc = true
    const span_elem = document.createElement('span')
    span_elem.style = "font-size:0.8rem; margin-left:0.5rem"
    span_elem.innerHTML = "▼"
    th_elem.appendChild(span_elem)
    th_elem.classList.add('order-inactive')

    const index = Array.from(th_elem.parentNode.children).indexOf(th_elem)
    th_elem.addEventListener('click', (e) => {
      document.querySelectorAll('th.order').forEach(elem => {
        elem.classList.remove('order-active')
        elem.classList.add('order-inactive')
      })
      th_elem.classList.remove('order-inactive')
      th_elem.classList.add('order-active')

      if (!asc) {
        th_elem.querySelector('span').innerHTML = '▲'
      } else {
        th_elem.querySelector('span').innerHTML = '▼'
      }
      const arr = Array.from(th_elem.closest("table").querySelectorAll('tbody tr'))
      arr.sort((a, b) => {
        const a_val = a.children[index].innerText
        const b_val = b.children[index].innerText
        return (asc) ? a_val.localeCompare(b_val) : b_val.localeCompare(a_val)
      })
      arr.forEach(elem => {
        th_elem.closest("table").querySelector("tbody").appendChild(elem)
      })
      asc = !asc
    })
  })
}
table_sort()

// Drag'n drop





// // gdzie szukam
// const phrase = searchMain;
// //czego szukam (od 1 pojawienia się do ostatniego)
// const searchFrom = searchMain.indexOf(searchTextArea)
// const searchTo = searchMain.lastIndexOf(searchTextArea)
// if (searchFrom === -1) {
//   //Gdy nie znajdę wyniku - komunikat pod tekstem
//   return "Brak wyników";
// }else {
//   //funkcja -> przechodź na pozycje zaczynając od:
//   //for(i=searchFrom, i<=searchTo, i++)
// }
//
// const searchBodyElements = () => {
//   const searchTextArea = document.querySelector('.search-textarea');
//   let searchText = searchTextArea.innerHTML;
//
//   alert(searchTextArea.value);
// }
