document.querySelectorAll('.title').forEach(title => {
    title.addEventListener('keyup', (e) => {
        titlePreview(title);
    });
});

const titlePreview = (e) => {
    const target = e.getAttribute('data-target');
    const preview = document.querySelector('#preview-title-' + target);
    preview.textContent = e.value;
}

document.querySelectorAll('.content').forEach(content => {
    content.addEventListener('keyup', (e) => {
        contentPreview(content);
    });
});

const contentPreview = (e) => {
    const target = e.getAttribute('data-target');
    const preview = document.querySelector('#preview-content-' + target);
    preview.textContent = e.value;
}

document.querySelectorAll('.price').forEach(price => {
    price.addEventListener('keyup', (e) => {
        pricePreview(price);
    });
});

const pricePreview = (e) => {
    const target = e.getAttribute('data-target');
    const preview = document.querySelector('#preview-price-' + target);
    preview.textContent = '¥' + Number(e.value).toLocaleString();
}

document.getElementById('contentAddBtn').addEventListener('click', (e) => {
    const aryMax = (a, b) => {return Math.max(a, b);};
    const target = Laravel.content_id_list.reduce(aryMax) + 1;
    const wrapper = document.createElement('div');
    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'id[]';
    idInput.value = target;
    wrapper.appendChild(idInput);
    wrapper.innerHTML += target;
    const titleInput = document.createElement('input');
    titleInput.type = 'text';
    titleInput.classList.add('title', 'border-gray-300', 'focus:border-indigo-500', 'focus:ring-indigo-500', 'rounded-md', 'shadow-sm');
    titleInput.name = 'price_title[' + target + ']';
    titleInput.classList.add('title');
    titleInput.addEventListener('keyup', (e) => {
        titlePreview(titleInput);
    });
    wrapper.appendChild(titleInput);
    e.target.before(wrapper);
});

document.querySelectorAll('.content-delete').forEach(btn => {
    btn.addEventListener('click', (e) => {
        if (window.confirm('削除しますか？')) {
            const form = document.createElement('form');
            form.action = btn.getAttribute('data-url');
            form.method = 'POST';
            document.body.appendChild(form);
            form.addEventListener('formdata', (e) => {
                let fd = e.formData;
                fd.set('_token', btn.getAttribute('data-csrf'));
            });
            form.submit();
        }
    });
});

document.getElementById('priceAddBtn').addEventListener('click', (e) => {
    const aryMax = (a, b) => {return Math.max(a, b);};
    const target = Laravel.price_id_list.reduce(aryMax) + 1;
    const wrapper = document.createElement('div');
    wrapper.classList.add('m-2', 'p-2', 'border', 'rounded-lg', 'flex', 'md:flex-row', 'flex-col', 'items-start', 'justify-center', 'gap-4');
    const firstWrapper = document.createElement('div');
    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'id[]';
    idInput.value = target;
    firstWrapper.appendChild(idInput);
    firstWrapper.innerHTML += target;
    const contentSelect = document.createElement('select');
    contentSelect.name = 'content_id[' + target + ']';
    contentSelect.classList.add('w-32');
    const hiddenOption = document.createElement('option');
    hiddenOption.classList.add('hidden');
    hiddenOption.innerHTML = '項目を選択してください';
    contentSelect.appendChild(hiddenOption);
    Laravel.price_contents.forEach(content => {
        const option = document.createElement('option');
        option.value = content.id;
        option.innerHTML = content.price_title;
        contentSelect.appendChild(option);
    });
    firstWrapper.appendChild(contentSelect);
    wrapper.appendChild(firstWrapper);
    const secondWrapper = document.createElement('div');
    const contentInput = document.createElement('input');
    contentInput.type = 'text';
    contentInput.name = 'price_content[' + target + ']';
    contentInput.classList.add('title', 'border-gray-300', 'focus:border-indigo-500', 'focus:ring-indigo-500', 'rounded-md', 'shadow-sm');
    contentInput.placeholder = '料金項目名';
    secondWrapper.appendChild(contentInput);
    const priceInput = document.createElement('input');
    priceInput.type = 'number';
    priceInput.name = 'price[' + target + ']';
    priceInput.classList.add('price', 'border-gray-300', 'focus:border-indigo-500', 'focus:ring-indigo-500', 'rounded-md', 'shadow-sm', 'w-32');
    priceInput.placeholder = '料金';
    secondWrapper.appendChild(priceInput);
    wrapper.appendChild(secondWrapper);
    e.target.before(wrapper);
});

document.querySelectorAll('.price-delete').forEach(btn => {
    btn.addEventListener('click', (e) => {
        if (window.confirm('削除しますか？')) {
            const form = document.createElement('form');
            form.action = btn.getAttribute('data-url');
            form.method = 'POST';
            document.body.appendChild(form);
            form.addEventListener('formdata', (e) => {
                let fd = e.formData;
                fd.set('_token', btn.getAttribute('data-csrf'));
            });
            form.submit();
        }
    });
});
