document.querySelectorAll('.gallery img').forEach(img=>(
    img.onclick = () => {
        document.querySelector('.pop-up').style.display ='block';
        document.querySelector('.pop-up img').src = img.getAttribute('src');
    }
));

document.querySelector('.pop-up span').onclick = () => {
    document.querySelector('.pop-up').style.display ='none';
}

const openPopUps = document.querySelectorAll('.open_pop_up');
    const popUp = document.getElementById('pop_up');
    const closePopUp = document.getElementById('pop_up_close');

    openPopUps.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            popUp.classList.add('active');
        });
    });

    closePopUp.addEventListener('click', () => {
        popUp.classList.remove('active');
    });