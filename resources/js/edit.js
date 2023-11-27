import './index.js';
import Editor from "@toast-ui/editor";

const viewer = new Editor.factory({
    el: document.getElementById('foodTruckViewer'),
    viewer: true,
    initialValue: Laravel.food_truck.food_truck_text,
});
