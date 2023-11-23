// const allTitleCard = document.querySelectorAll('.title')

// allTitleCard.forEach(element => {
//   console.log(element.innerText);
// });

// const limitText = (teks) => {
//   if (teks.length <= 30) {
//     return teks; 
//   } else {
//     return teks.slice(0, 30) + '...';
//   }
// }


const urlName = location.pathname
const getId = (id) => document.getElementById(id)

const activeClass = (id) => {
  id.classList.remove('hover:bg-gray-600')
  id.classList.add('bg-tailor-100', 'hover:bg-tailor-200')
}

window.addEventListener('load', () => {
  urlName === '/' ? activeClass(getId('beranda')) : null
  urlName === '/rumah-jahit' || urlName.split('/')[1] === 'rumah-jahit' ? activeClass(getId('rumahJahit')) : null
  urlName === '/tentang-kami' ? activeClass(getId('tentangKami')) : null
  urlName === '/bergabung' ? activeClass(getId('bergabung')) : null
})
