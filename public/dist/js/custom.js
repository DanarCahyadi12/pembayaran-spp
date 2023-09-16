const btn = document.getElementById('btn-modal')
const modal= document.getElementById('modal-container')
const modalDetailSiswa = document.getElementById('modal-container-siswa')
const overlay = document.getElementsByClassName('overlay')[0]
const btnClose = document.getElementById('close-btn')
btn.addEventListener('click',function() {
    modal.style.display= 'block'
    overlay.style.display = 'block'
})


btnClose.addEventListener('click',function () {
    modal.style.display= 'none'
    overlay.style.display = 'none'
})