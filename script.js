const editButtons = document.querySelectorAll('.edit_note');
const closeButton = document.querySelector('#close');

const updcont = document.querySelector('#editArea');
const updid = document.querySelector('#editArea input[name="id"]');
const title = document.querySelector('#editArea input[name="title"]');
const content = document.querySelector('#editArea textarea');


function editNote(event) {
    event.preventDefault();
    if (updcont.style.display == 'none') {
        updcont.style.display = 'flex';
    } else {
        updcont.style.display = 'none';
    };
    updid.value = event.currentTarget.parentNode.querySelector('input').value;
    title.value = event.currentTarget.parentNode.querySelector('.note_title').innerHTML;
    content.value = event.currentTarget.parentNode.querySelector('.note_content').innerHTML;
};

function close() {
    close.preventDefault();
    updcont.style.display = 'none';
};

closeButton.addEventListener("click", close);

for (let editButton of editButtons) {
    editButton.addEventListener("click", editNote);
};