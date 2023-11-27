document.querySelectorAll('.input').forEach((item) => {
    item.addEventListener('keyup', (e) => {
        const preview = document.getElementById(item.getAttribute('data-preview'));
        preview.innerHTML = item.value.replace(/\n/g, '<br>')
    });
});
