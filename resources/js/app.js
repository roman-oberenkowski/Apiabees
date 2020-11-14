require('./bootstrap');

console.log(1)
const removeFlash = ({ target }) => target.closest('.flash').remove();

document.querySelectorAll(".close-flash").forEach(elem => elem.addEventListener('click', removeFlash))
