const myForm = document.querySelector('form');
myForm.addEventListener('submit', function (e) {
    // e.preventDefault();
    elementsForm = myForm.elements;
    for (let item of elementsForm) {
        if (!item.validity.valid) {
            e.preventDefault();
            item.classList.remove('is-valid');
            item.classList.add('is-invalid');
        }
        else {

            item.classList.remove('is-invalid');
            item.classList.add('is-valid');
        }
    }
});