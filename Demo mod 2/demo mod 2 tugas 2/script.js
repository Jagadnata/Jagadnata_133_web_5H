let todoList = [];
let editIndex = -1;

const addBtn = document.getElementById('add-btn');
const todoInput = document.getElementById('todo-input');
const todoListElement = document.getElementById('todo-list');

// Function to render the to-do list
function renderList() {
    todoListElement.innerHTML = '';
    todoList.forEach((todo, index) => {
        const listItem = document.createElement('li');
        listItem.className = 'todo-item';

        const todoText = document.createElement('span');
        todoText.className = 'todo-text';
        todoText.textContent = todo;
        listItem.appendChild(todoText);

        const editButton = document.createElement('button');
        editButton.className = 'edit-btn';
        editButton.textContent = 'Edit';
        editButton.addEventListener('click', () => editTask(index));
        listItem.appendChild(editButton);

        const deleteButton = document.createElement('button');
        deleteButton.className = 'delete-btn';
        deleteButton.textContent = 'Delete';
        deleteButton.addEventListener('click', () => deleteTask(index));
        listItem.appendChild(deleteButton);

        todoListElement.appendChild(listItem);
    });
}

// Function to add or edit a task
function addOrEditTask() {
    const task = todoInput.value.trim();
    if (task === '') {
        alert('Task cannot be empty');
        return;
    }

    if (editIndex === -1) {
        // Add new task
        todoList.push(task);
    } else {
        // Edit existing task
        todoList[editIndex] = task;
        editIndex = -1;
    }

    todoInput.value = '';
    renderList();
}

// Function to delete a task
function deleteTask(index) {
    todoList.splice(index, 1);
    renderList();
}

// Function to edit a task
function editTask(index) {
    todoInput.value = todoList[index];
    editIndex = index;
}

// Event listener for the "Add" button
addBtn.addEventListener('click', addOrEditTask);

// Render the list on page load
renderList();
