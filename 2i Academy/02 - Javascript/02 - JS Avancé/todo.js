document.addEventListener("DOMContentLoaded", () => {
    const $taskForm = document.getElementById("taskForm");
    const URL = "http://localhost:3000/tasks/"

    $taskForm.addEventListener("submit", async (ev) => {
        ev.preventDefault();
        const data = new FormData(ev.target);
        const newTask = { taskName: data.get("taskName"), done: false };
        if (newTask.taskName.trim() !== "") {
            const response = await fetch(URL, {
                method: "POST",
                body: JSON.stringify(newTask),
            });
            const result = await response.json();
            console.log(result)

        };
    });

    async function getTasks () {
        const response = await fetch(URL)
        if (response.ok) {
            const data = await response.json();
            displayTasks(data);
            editTask();
        }
        else {
            console.log("Erreur " + response.status);
        }
    }


    function displayTasks (table) {
        for (i = 0; i < table.length; i++) {
            const task = table[i];
            const name = task.taskName;
            const id = task.id;
            const done = task.done;

            const newDiv = document.createElement("div");
            newDiv.setAttribute("id", id);
            newDiv.setAttribute("class", "taskDiv");
            newDiv.style.display = "grid";
            newDiv.style.gridTemplateColumns = "1fr 10fr 1fr 1fr"
            newDiv.style.width = "60%";
            newDiv.style.backgroundColor = "#b3dfe3"
            newDiv.style.height = "30px"
            newDiv.style.border = "1px #639296 solid"
            console.log(newDiv);

            const newCheckbox = document.createElement("input");
            newCheckbox.setAttribute("type", "checkbox");
            newCheckbox.setAttribute("dataId", newDiv.id);

            const newName = document.createElement("span");
            newName.innerText = name;
            newName.setAttribute("dataId", newDiv.id);


            const newDelete = document.createElement("button");
            newDelete.setAttribute("class", "deleteBtn")
            newDelete.innerText = "Delete";
            newDelete.style.backgroundColor = "#920804"
            newDelete.setAttribute("dataId", newDiv.id);


            const newEdit = document.createElement("button");
            newEdit.setAttribute("class", "editBtn")
            newEdit.innerText = "Edit";
            newEdit.style.backgroundColor = "#d49536"
            newEdit.setAttribute("dataId", newDiv.id);


            newDiv.appendChild(newCheckbox);
            newDiv.appendChild(newName);
            newDiv.appendChild(newEdit);
            newDiv.appendChild(newDelete);


            document.body.appendChild(newDiv);
        }
    };



    function editTask () {
        const body = document.querySelector("body")
        body.onclick = async function (event) {
            console.log("Classes = " + event.target.className)
            if (event.target.className === "deleteBtn") {
                console.log(event.target.outerHTML);
                await fetch(URL + event.target.getAttribute("dataId"), {
                    method: "DELETE",
                });
            }
            else if (event.target.className === "editBtn") {
                const editName = prompt("Changer de nom :");
                const response = await fetch(URL + event.target.getAttribute("dataId"), {
                    method: "PATCH",
                    body: JSON.stringify({ taskName: editName }),
                    headers: {
                        "Content-type": "application/json; charset=UTF-8",
                    }
                });
                const result = await response.json();
            };
        };

    };
    getTasks();
});


