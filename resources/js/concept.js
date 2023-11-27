document.querySelectorAll('.input-img').forEach((input) => {
    input.addEventListener('change', () => {
        const img = input.files[0];
        const target = input.getAttribute('data-target');
        const targetImg = document.getElementById('preview-img-' + target);
        const previewImgs = document.querySelectorAll('.concept-' + target + ' img');
        const reader = new FileReader();
        reader.onload = (e) => {
            targetImg.src = e.target.result;
            previewImgs.forEach((previewImg) => {
                previewImg.src = e.target.result;
            });
        }
        reader.readAsDataURL(img);
    });
});

document.querySelectorAll('.input-title').forEach((input) => {
    input.addEventListener('keyup', () => {
        const target = input.getAttribute('data-target');
        const previewTitle = document.querySelector('.concept-' + target + ' .title');
        previewTitle.innerHTML = input.value.replace(/\r?\n/g, '<br>');
    });
});

document.querySelectorAll('.input-text').forEach((input) => {
    input.addEventListener('keyup', () => {
        const target = input.getAttribute('data-target');
        const previewText = document.querySelector('.concept-' + target + ' .text');
        previewText.innerHTML = input.value.replace(/\r?\n/g, '<br>');
    });
});

document.getElementById('addBtn').addEventListener('click', () => {
    const add = document.getElementById('add');
    add.classList.remove('hidden');
    add.classList.add('flex');
});

document.querySelectorAll('.deleteBtn').forEach((btn) => {
    btn.addEventListener('click', () => {
        if (window.confirm('削除しますか？')) {
            const target = btn.getAttribute('data-target');
            const deleteForm = document.getElementById('delete-' + target);
            deleteForm.submit();
        }
    });
});
