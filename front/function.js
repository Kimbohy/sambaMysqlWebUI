// Lister utilisateur

async function users() {
    let list = await fetch('api/userList.php')
    let userList =await list.json()

    console.log(userList)

    const mainContent = document.querySelector('#mainContent') 
    let li = ``
    userList.users.forEach(element => {
        li += `
            <li>
                <p>${element.login}</p>
                <form action="deleteUser.php" method="post">
                <input id="cache"type="hidden" name="username" value="${element.login}">
                <button type="submit"><img src="./img/trash.png" alt=""></button>
                </form>
            </li>
        `
    });
    mainContent.innerHTML = `
        <ul id="userList">
            <li id="ajout">
                <img onclick='add()' src="./img/plus.svg" alt="">
            </li>
            ${li}
        </ul>
    `
}

async function log() {
    let admin = await fetch('./data/user.json');
    let adminInfo = await admin.json();
    console.log(adminInfo);
    document.getElementById("logName").textContent=adminInfo.userName;
}

const content = document.getElementById('add');
const add = () => {
    content.innerHTML = `
        <form id="ajouter" action="ajouterUser.php" method="post">
        <p>close</p>
        <input type="text" name="username" placeholder="username" required>
        <input type="text" name="password" placeholder="password" required>
        <button type="submit">AJOUTER</button>
    </form>
    `;
    document.querySelector("p").addEventListener("click", () => close());
}

const close = () => {
    content.innerHTML=``;
    console.log("close");
}

fetch('api/userAdd.php', {
    method: 'POST',
    headers: {
              'Content-Type': 'application/json' // Set the content type
    },
    body: JSON.stringify({ login: 'John Doe', password: 'johndoe@example.com' })
})
.then (response => response.json)
.then (data => {
    console.log(data)
})
