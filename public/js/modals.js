let blackAlpha = document.getElementById("blackAlpha")
let addUserModal = document.getElementById("addUserModal")
let addClientModal = document.getElementById("addClientModal")
let openAddUserModalBtn = document.getElementById("openAddUserModalBtn");
let openAddClientModalBtn = document.getElementById("openAddClientModalBtn");

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