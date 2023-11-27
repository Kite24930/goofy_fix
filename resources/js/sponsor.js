import Sortable from 'sortablejs';
import axios from "axios";

const slicks = document.getElementById('sponsors');

let sortable = new Sortable(slicks, {
    animation: 150,
});

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

document.querySelectorAll('.delete-btn').forEach(item => {
    item.addEventListener('click', event => {
        sponsorDelete(item);
    });
});

const sponsorDelete = (item) => {
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
}

document.querySelectorAll('.logo').forEach(item => {
    item.addEventListener('change', event => {
        logoUpdate(item);
    });
});

const logoUpdate = (item) => {
    const target = item.getAttribute('data-target');
    const file = item.files[0];
    const reader = new FileReader();
    reader.onload = (e) => {
        const img = document.getElementById('sponsor-logo-' + target);
        img.src = e.target.result;
        const preview = document.getElementById('preview-img-' + target);
        preview.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

document.getElementById('addBtn').addEventListener('click', () => {
    const aryMax = (a, b) => {return Math.max(a, b);};
    const target = Laravel.id_list.reduce(aryMax) + 1;
    const li = document.createElement('li');
    li.classList.add('flex', 'flex-col', 'p-4', 'bg-white', 'm-4', 'rounded-lg', 'gap-4', 'w-full', 'max-w-sm');
    const idTag = document.createElement('div');
    idTag.textContent = target;
    li.appendChild(idTag);
    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'id[]';
    idInput.value = target;
    li.appendChild(idInput);
    const logoLabel = document.createElement('label');
    logoLabel.innerHTML = 'スポンサーロゴ<br>';
    const logoImg = document.createElement('img');
    logoImg.id = 'sponsor-logo-' + target;
    logoImg.classList.add('w-auto', 'h-[100px]', 'object-contain', 'logo-img');
    logoImg.src = 'http://via.placeholder.com/150x150';
    logoLabel.appendChild(logoImg);
    const logoInput = document.createElement('input');
    logoInput.type = 'file';
    logoInput.name = 'sponsor_logo-' + target;
    logoInput.id = 'sponsor-logo-' + target;
    logoInput.classList.add('logo');
    logoInput.setAttribute('data-target', target);
    logoInput.addEventListener('change', () => {
        logoUpdate(logoInput);
    });
    logoLabel.appendChild(logoInput);
    li.appendChild(logoLabel);
    const nameLabel = document.createElement('label');
    nameLabel.innerHTML = 'スポンサー名<br>';
    const nameTextArea = document.createElement('textarea');
    nameTextArea.name = 'sponsor_name[]';
    nameTextArea.id = 'sponsor-name-' + target;
    nameTextArea.classList.add('w-full');
    nameTextArea.rows = 2;
    nameLabel.appendChild(nameTextArea);
    li.appendChild(nameLabel);
    const urlLabel = document.createElement('label');
    urlLabel.innerHTML = 'スポンサーURL<br>';
    const urlInput = document.createElement('input');
    urlInput.type = 'text';
    urlInput.name = 'sponsor_url[]';
    urlInput.id = 'sponsor-url-' + target;
    urlInput.classList.add('w-full', 'border-gray-300', 'focus:border-indigo-500', 'focus:ring-indigo-500', 'rounded-md', 'shadow-sm');
    urlLabel.appendChild(urlInput);
    li.appendChild(urlLabel);
    document.getElementById('sponsors').appendChild(li);
    Laravel.id_list.push(target);
});
