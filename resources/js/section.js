import axios from "axios";
import Sortable from 'sortablejs';

const publishToggle = document.getElementById("publish-toggle");
publishToggle.addEventListener("change", () => {
    let data = {
        publish: 0,
        csrf_token: publishToggle.getAttribute("data-csrf")
    }
    if (publishToggle.checked) {
        data.publish = 1;
    }
    const url = publishToggle.getAttribute("data-url");
    axios.post(url, data)
        .then(response => {
            console.log(response.data);
            if (response.data.success) {
                window.alert(response.data.success);
                window.location.reload();
            } else {
                window.alert(response.data.error);
            }
        })
        .catch(error => {
            console.log(error);
        });
});

document.querySelectorAll('.section-title').forEach(input => {
    input.addEventListener('keyup', () => {
        const target = input.getAttribute('data-target');
        const targetTitle = document.getElementById('preview-title-' + target);
        if (targetTitle) targetTitle.textContent = input.value;
        sectionTitle.textContent = input.value.replace(/\r?\n/g, '<br>');
    });
});

document.querySelectorAll('.section-img').forEach(input => {
    input.addEventListener('change', () => {
        const img = input.files[0];
        const target = input.getAttribute('data-target');
        const targetImg = document.getElementById('preview-img-' + target);
        const sectionImg = document.getElementById('section-img-' + target);
        const reader = new FileReader();
        reader.onload = (e) => {
            if (targetImg) targetImg.src = e.target.result;
            sectionImg.src = e.target.result;
        }
        reader.readAsDataURL(img);
    });
});

document.getElementById('addBtn').addEventListener('click', (e) => {
    document.getElementById('addForm').classList.remove('hidden');
    e.target.classList.add('hidden');
});

document.querySelectorAll('.section-delete').forEach(btn => {
    btn.addEventListener('click', () => {
        if (window.confirm('本当に削除しますか？')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = btn.getAttribute('data-url');
            document.body.appendChild(form);
            form.addEventListener('formdata', (e) => {
                let fd = e.formData;
                fd.set('_token', btn.getAttribute('data-csrf'));
            });
            form.submit();
        }
    });
});

const slicks = document.getElementById('items');

let sortable = new Sortable(slicks, {
    animation: 150,
});

document.querySelectorAll('.item-img').forEach(input => {
    input.addEventListener('change', () => {
        imgPreview(input);
    });
});

const imgPreview = (e) => {
    const target = e.getAttribute('data-target');
    const img = document.getElementById('item-img-' + target);
    const preview = document.getElementById('preview-item-' + target);
    const reader = new FileReader();
    reader.onload = (e) => {
        img.src = e.target.result;
        if (preview) preview.src = e.target.result;
    }
    reader.readAsDataURL(e.files[0]);
}

document.querySelectorAll('.item-content').forEach(input => {
    input.addEventListener('keyup', () => {
        contentPreview(input);
    });
});

const contentPreview = (e) => {
    const target = e.getAttribute('data-target');
    const preview = document.getElementById('preview-content-' + target);
    preview.textContent = e.value;
}

document.querySelectorAll('.item-delete').forEach((item) => {
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

document.getElementById('itemAddBtn').addEventListener('click', () => {
    const aryMax = (a, b) => {return Math.max(a, b);};
    const target = Laravel.id_list.reduce(aryMax) + 1;
    const wrapper = document.createElement('li');
    wrapper.classList.add('p-4', 'bg-white', 'border', 'border-gray-500', 'rounded', 'flex', 'flex-col', 'items-center');
    wrapper.setAttribute('data-order', target);
    const idTag = document.createElement('div');
    idTag.textContent = target;
    wrapper.appendChild(idTag);
    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'id[]';
    idInput.value = target;
    wrapper.appendChild(idInput);
    const select = document.createElement('select');
    select.name = 'section_id[' + target + ']';
    const option1 = document.createElement('option');
    option1.classList.add('hidden');
    option1.textContent = 'セクションを選択してください。';
    select.appendChild(option1);
    Laravel.sections.forEach((section) => {
        const option = document.createElement('option');
        option.value = section.id;
        option.textContent = section.section_title;
        select.appendChild(option);
    });
    wrapper.appendChild(select);
    const imgWrapper = document.createElement('div');
    imgWrapper.classList.add('square', 'relative', 'w-1/2', 'max-w-sm');
    const img = document.createElement('img');
    img.id = 'item-img-' + target;
    img.src = 'http://via.placeholder.com/350x350';
    img.classList.add('absolute', 'top-0', 'bottom-0', 'start-0', 'end-0', 'm-auto', 'w-[90%]', 'h-[90%]');
    imgWrapper.appendChild(img);
    wrapper.appendChild(imgWrapper);
    const imgInput = document.createElement('input');
    imgInput.type = 'file';
    imgInput.name = 'section_img-' + target;
    imgInput.accept = 'image/jpeg, image/png';
    imgInput.setAttribute('data-target', target);
    imgInput.addEventListener('change', () => {
        imgPreview(imgInput);
    });
    wrapper.appendChild(imgInput);
    const contentWrapper = document.createElement('div');
    const contentLabel = document.createElement('label');
    contentLabel.textContent = 'アイテム名：';
    const contentInput = document.createElement('input');
    contentInput.type = 'text';
    contentInput.name = 'section_content[' + target + ']';
    contentInput.classList.add('border-gray-300', 'focus:border-indigo-500', 'focus:ring-indigo-500', 'rounded-md', 'shadow-sm');
    contentInput.addEventListener('keyup', () => {
        contentPreview(contentInput);
    });
    contentLabel.appendChild(contentInput);
    contentWrapper.appendChild(contentLabel);
    wrapper.appendChild(contentWrapper);
    document.getElementById('items').appendChild(wrapper);
    Laravel.id_list.push(target);
});
