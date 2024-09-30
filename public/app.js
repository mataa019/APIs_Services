const apiUrl = 'http://localhost/todo-app/api';

async function fetchTodos() {
    const response = await fetch(`${apiUrl}/read.php`);
    const data = await response.json();
    const todoList = document.getElementById('todo-list');
    todoList.innerHTML = '';
    data.records.forEach(todo => {
        const li = document.createElement('li');
        li.innerHTML = `
            <span>${todo.title}: ${todo.description}</span>
            <button onclick="editTodo(${todo.id}, '${todo.title}', '${todo.description}')">Edit</button>
            <button onclick="deleteTodo(${todo.id})">Delete</button>
        `;
        todoList.appendChild(li);
    });
}

async function createTodo() {
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;

    const response = await fetch(`${apiUrl}/create.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ title, description })
    });

    if (response.ok) {
        fetchTodos();
        clearForm();
    } else {
        alert('Failed to create to-do item');
    }
}

async function updateTodo() {
    const id = document.getElementById('todo-id').value;
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;

    const response = await fetch(`${apiUrl}/update.php`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id, title, description })
    });

    if (response.ok) {
        fetchTodos();
        clearForm();
        document.getElementById('todo-id').value = '';
        document.querySelector('button[onclick="createTodo()"]').style.display = 'inline-block';
        document.querySelector('button[onclick="updateTodo()"]').style.display = 'none';
    } else {
        alert('Failed to update to-do item');
    }
}

async function deleteTodo(id) {
    const response = await fetch(`${apiUrl}/delete.php`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id })
    });

    if (response.ok) {
        fetchTodos();
    } else {
        alert('Failed to delete to-do item');
    }
}

function editTodo(id, title, description) {
    document.getElementById('todo-id').value = id;
    document.getElementById('title').value = title;
    document.getElementById('description').value = description;
    document.querySelector('button[onclick="createTodo()"]').style.display = 'none';
    document.querySelector('button[onclick="updateTodo()"]').style.display = 'inline-block';
}

function clearForm() {
    document.getElementById('title').value = '';
    document.getElementById('description').value = '';
}

document.addEventListener('DOMContentLoaded', () => {
    fetchTodos();
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.id = 'todo-id';
    document.querySelector('.form-container').appendChild(hiddenInput);
    const updateButton = document.createElement('button');
    updateButton.textContent = 'Update To-Do';
    updateButton.style.display = 'none';
    updateButton.setAttribute('onclick', 'updateTodo()');
    document.querySelector('.form-container').appendChild(updateButton);
});