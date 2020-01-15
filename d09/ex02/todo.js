window.onload = function () {
    var cookies = document.cookie.split(';');
    var tasks = null;
    for (var i = 0; i < cookies.length; i++) {
        var parts = cookies[i].split('=');
        if (parts[0] === 'tasks') {
            tasks = parts[1];
            break;
        }
    }
    if (tasks !== null) {
        var res = JSON.parse(tasks);
        for (var item of res)
            addElem(item);
    }
    document.querySelector('button[name=Create]').addEventListener('click', newElem);
};

window.onunload = function () {
    var divs = document.querySelectorAll('#ft_list div');
    var tasks = [];
    for (var item of divs)
        tasks.unshift(item.innerText);
    var expire = new Date();
    expire.setHours(expire.getHours() + 24);
    document.cookie = "tasks=" + JSON.stringify(tasks) + ";expires=" + expire.toUTCString() + ";";
};

function newElem() {
    var task = prompt('New');
    if (task !== null && task.length !== 0)
        addElem(task);
}

function addElem(task) {
    var newDiv = document.createElement('div');
    newDiv.setAttribute('class', 'todo');
    newDiv.textContent = task;
    newDiv.addEventListener('click', () => {
        if (confirm('Remove that TO DO?'))
            newDiv.remove();
    });
    document.querySelector('button[name=Create]').after(newDiv);
}
