let blackAlpha = document.getElementById("blackAlpha")
let addUserModal = document.getElementById("addUserModal")
let addClientModal = document.getElementById("addClientModal")
let addTaskModal = document.getElementById("addTaskModal")
let editUserModal = document.getElementById("editUserModal")
let ediClientModal = document.getElementById("ediClientModal")
let openTaskModal = document.getElementById("openTaskModal")
let openAddUserModalBtn = document.getElementById("openAddUserModalBtn")
let openAddClientModalBtn = document.getElementById("openAddClientModalBtn")
let openEditUserModalBtn = document.getElementById("openEditUserModalBtn")
let openEditClientModalBtn = document.getElementById("openEditClientModalBtn")

blackAlpha.addEventListener("click", () => {
    if (addUserModal) {
        addUserModal.classList.remove("show")
    }
    if (addClientModal) {
        addClientModal.classList.remove("show")
    }
    if (blackAlpha) {
        blackAlpha.classList.remove("show")
    }
    if (addTaskModal) {
        addTaskModal.classList.remove("show")
    }
    if (editUserModal) {
        editUserModal.classList.remove("show")
    }
    if (editClientModal) {
        editClientModal.classList.remove("show")
    }
});

if(openAddUserModalBtn) {
    openAddUserModalBtn.addEventListener("click", () => {
        blackAlpha.classList.add("show")
        addUserModal.classList.add("show")
    })
}

if(openAddClientModalBtn) {
    openAddClientModalBtn.addEventListener("click", () => {
        blackAlpha.classList.add("show")
        addClientModal.classList.add("show")
    })
}

if(openTaskModal) {
    openTaskModal.addEventListener("click", () => {
        blackAlpha.classList.add("show")
        addTaskModal.classList.add("show")
    })
}

if(openEditUserModalBtn) {
    openEditUserModalBtn.addEventListener("click", () => {
        blackAlpha.classList.add("show")
        editUserModal.classList.add("show")
    })
}

if(openEditClientModalBtn) {
    openEditClientModalBtn.addEventListener("click", () => {
        blackAlpha.classList.add("show")
        editClientModal.classList.add("show")
    })
}