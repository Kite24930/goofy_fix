import Sortable from 'sortablejs';

const slicks = document.getElementById('menus');

let sortable = new Sortable(slicks, {
    animation: 150,
});

document.querySelectorAll('.food-img').forEach((item) => {
    item.addEventListener('change', (e) => {
        imgPreview(item);
    });
});

const imgPreview = (el) => {
    const file = el.files[0];
    if (!file) {
        console.log('ファイルが選択されていません。');
        return;
    }
    const reader = new FileReader();
    reader.onload = (e) => {
        const target = el.getAttribute('data-target');
        const img = document.getElementById('preview-' + target);
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

document.getElementById('addBtn').addEventListener('click', () => {
    const aryMax = (a, b) => {return Math.max(a, b);};
    const target = Laravel.id_list.reduce(aryMax) + 1;
    const wrapper = document.createElement('li');
    wrapper.classList.add('md:max-w-sm', 'max-w-[50vw]');
    const idTag = document.createElement('div');
    idTag.textContent = target;
    wrapper.appendChild(idTag);
    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'id[]';
    idInput.value = target;
    wrapper.appendChild(idInput);
    const img = document.createElement('img');
    img.id = 'preview-' + target;
    img.src = 'http://via.placeholder.com/350x350';
    img.classList.add('preview-' + target);
    wrapper.appendChild(img);
    const input = document.createElement('input');
    input.type = 'file';
    input.name = 'food_img-' + target;
    input.classList.add('food-img');
    input.setAttribute('data-target', target);
    input.accept = 'image/jpeg, image/png';
    input.addEventListener('change', () => {
        imgPreview(input);
    });
    wrapper.appendChild(input);
    Laravel.id_list.push(target);
    document.getElementById('menus').appendChild(wrapper);
})

document.querySelectorAll('.delete-btn').forEach((item) => {
    item.addEventListener('click', () => {
        if (window.confirm('本当に削除しますか？')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = item.getAttribute('data-url');
            document.body.appendChild(form);
            form.addEventListener('formdata', (e) => {
                let fd = e.formData;
                fd.set('_token', item.getAttribute('data-csrf'));
            });
            form.submit();
        }
    });
});
