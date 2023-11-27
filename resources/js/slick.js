import Sortable from 'sortablejs';
import axios from 'axios';

const slicks = document.getElementById('slicks');

let sortable = new Sortable(slicks, {
    animation: 150,
});


document.getElementById('sorting').addEventListener('click', () => {
    let sort = [];
    document.querySelectorAll('#slicks .slick-img').forEach((item) => {
        sort.push(item.getAttribute('data-order'));
    });
    axios.post('/api/top_img/sort', {sort: sort}).then((response) => {
        if (response.data.success) {
            window.alert('並び替えが完了しました。');
            window.location.reload();
        } else {
            window.alert('並び替えに失敗しました。');
        }
    }).catch((error) => {
        window.alert('並び替えに失敗しました。');
        console.log(error);
    });
});

document.querySelectorAll('.delete-btn').forEach((item) => {
    item.addEventListener('click', () => {
        const target = item.getAttribute('data-target');
        axios.delete('/api/top_img/' + target)
            .then((response) => {
                if (response.data.success) {
                    window.alert('削除しました。');
                    window.location.reload();
                } else {
                    window.alert('削除に失敗しました。' + response.data.message);
                }
            }).catch((error) => {
                window.alert('削除に失敗しました。');
                console.log(error);
            });
    });
});

document.getElementById('add_file').addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (!file) {
        console.log('ファイルが選択されていません。');
        return;
    }
    const reader = new FileReader();
    reader.onload = (e) => {
        const img = document.getElementById('add_file_preview');
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
});
