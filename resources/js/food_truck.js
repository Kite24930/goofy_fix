import Editor from "@toast-ui/editor";
import colorSyntax from '@toast-ui/editor-plugin-color-syntax';
import tableMergedCellPlugin from "@toast-ui/editor-plugin-table-merged-cell";
import '@toast-ui/editor/dist/i18n/ja-jp';

const colorPresets = {
    preset: [
        '#000000', '#ff0000', '#ff6600', '#ff0099', '#ff99cc', '#00ff00', '#006633', '#ccff66', '#0000ff', '#0099ff', '#9900cc', '#cc66ff'
    ]
};

const editor = new Editor({
    el: document.getElementById('editor'),
    initialEditType: 'wysiwyg',
    height: '300px',
    language: 'ja',
    toolbarItems: [
        ['heading', 'bold', 'italic', 'strike', 'hr'],
        ['ul', 'ol'],
        ['table', 'image', 'link'],
    ],
    plugins: [[colorSyntax, colorPresets], tableMergedCellPlugin],
    initialValue: Laravel.food_truck.food_truck_text,
    events: {
        change: () => {
            document.getElementById('food_truck_text').value = editor.getMarkdown();
            viewer.setMarkdown(editor.getMarkdown());
        }
    }
});

const viewer = new Editor.factory({
    el: document.getElementById('viewer'),
    viewer: true,
    initialValue: Laravel.food_truck.food_truck_text,
});

document.getElementById('food_truck_img').addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (!file) {
        console.log('ファイルが選択されていません。');
        return;
    }
    const reader = new FileReader();
    reader.onload = (e) => {
        const img = document.getElementById('food_truck-img');
        img.src = e.target.result;
        const preview = document.getElementById('preview_img');
        preview.src = e.target.result;
    };
    reader.readAsDataURL(file);
});
