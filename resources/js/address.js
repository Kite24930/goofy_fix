import { Loader } from "@googlemaps/js-api-loader";

window.addEventListener('load', () => {
    const loader = new Loader({
        apiKey: 'AIzaSyApdlkvbL5e3GeRiBRcdaQU3VsBpgHWClw',
        version: 'weekly',
        libraries: ['places'],
    });
    loader.load().then(() => {
        const park = new google.maps.LatLng(34.73433753865971, 136.47260968408696);
        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: park,
            // gestureHandling: 'greedy',
        });
        const marker = new google.maps.Marker({
            position: park,
            icon: '/storage/goofy_pin.png',
        });
        marker.setMap(map);
    })
});

document.querySelectorAll('.delete-btn').forEach(btn => {
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

document.querySelectorAll('.title').forEach(title => {
    title.addEventListener('keyup', () => {
        titlePreview(title);
    });
});

const titlePreview = (e) => {
    const target = e.getAttribute('data-target');
    const preview = document.querySelector('#preview-' + target + ' span');
    preview.textContent = '[' + e.value + ']';
}

document.querySelectorAll('.text').forEach(text => {
    text.addEventListener('keyup', () => {
        textPreview(text);
    });
});

const textPreview = (e) => {
    const target = e.getAttribute('data-target');
    const preview = document.querySelector('#preview-' + target + ' div');
    preview.innerHTML = e.value.replace(/\r?\n/g, '<br>');
}

document.getElementById('addBtn').addEventListener('click', () => {
    const aryMax = (a, b) => {return Math.max(a, b);};
    const target = Laravel.id_list.reduce(aryMax) + 1;
    const container = document.createElement('div');
    container.classList.add('bg-white', 'p-4', 'rounded-xl', 'm-4', 'border', 'border-gray-200');
    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'id_list[]';
    idInput.value = target;
    container.appendChild(idInput);
    const wrapper = document.createElement('div');
    wrapper.classList.add('flex', 'justify-between', 'items-center', 'md:flex-row', 'flex-col', 'gap-4');
    const titleWrapper = document.createElement('div');
    const titleLabel = document.createElement('label');
    titleLabel.innerHTML = '項目名<br>';
    const titleInput = document.createElement('input');
    titleInput.type = 'text';
    titleInput.classList.add('title', 'border-gray-300', 'focus:border-indigo-500', 'focus:ring-indigo-500', 'rounded-md', 'shadow-sm');
    titleInput.setAttribute('data-target', target);
    titleInput.name = 'sendData[' + target + '][title]'
    titleInput.id = 'title-' + target;
    titleInput.placeholder = '項目名';
    titleInput.addEventListener('keyup', (e) => {
        titlePreview(titleInput);
    });
    titleLabel.appendChild(titleInput);
    titleWrapper.appendChild(titleLabel);
    wrapper.appendChild(titleWrapper);
    const textWrapper = document.createElement('div');
    textWrapper.classList.add('w-full', 'max-w-md');
    const textLabel = document.createElement('label');
    textLabel.innerHTML = '内容<br>';
    const textInput = document.createElement('textarea');
    textInput.classList.add('text', 'w-full');
    textInput.rows = 5;
    textInput.setAttribute('data-target', target);
    textInput.name = 'sendData[' + target + '][text]';
    textInput.id = 'text-' + target;
    textInput.addEventListener('keyup', (e) => {
        textPreview(textInput);
    });
    textLabel.appendChild(textInput);
    textWrapper.appendChild(textLabel);
    wrapper.appendChild(textWrapper);
    container.appendChild(wrapper);
    document.getElementById('addBtnArea').before(container);
    const previewContainer = document.createElement('div');
    previewContainer.id = 'preview-' + target;
    previewContainer.classList.add('my-2');
    const previewTitle = document.createElement('span');
    previewTitle.classList.add('en-text');
    const previewText = document.createElement('div');
    previewText.classList.add('ml-4', 'ja');
    previewContainer.appendChild(previewTitle);
    previewContainer.appendChild(previewText);
    document.getElementById('preview').appendChild(previewContainer);
    Laravel.id_list.push(target);
});
