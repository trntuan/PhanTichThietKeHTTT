function customSelect(classStr, group) {
    let selectForm = document.querySelector(`.${classStr} > select`)
    if (selectForm) {
        let dropdownContent = document.querySelector(`.${classStr} > .dropdown-menu > .dropdown-content`)
        let btn = document.querySelector(`.${classStr} > button`)
        let btnContent = document.querySelector(`.${classStr} > button > .btn-desc`)

        if (group == false) {

            let optionItem = [...selectForm.children]
            let ulDropdow = dropdownContent.appendChild(document.createElement("ul"))
            optionItem.forEach((item) => {
                let liDropdown = ulDropdow.appendChild(document.createElement("li"))
                liDropdown.textContent = item.textContent
            })

            let ul = [...dropdownContent.children]
            ul.forEach((item) => {
                item.childNodes.forEach((li) => {
                    li.addEventListener("click", () => {
                        if (li.classList.value === "") {

                            ul.forEach((ul) => {
                                ul.childNodes.forEach((i) => {
                                    i.classList.remove("active")
                                })
                            })
                            li.classList.add("active")
                            btnContent.textContent = li.textContent
                            btn.classList.remove("active")
                            document.querySelector(`.${classStr} > .dropdown-menu`).classList.remove("active")
                            optionItem.forEach((item) => {
                                
                                if (item.textContent === btnContent.textContent)
                                    item.setAttribute("selected", true)
                                else item.removeAttribute("selected")
                            })
                        }
                    })
                })
            })
            optionItem.forEach((item)=>{
                if(item.hasAttribute("selected"))
                    {
                        btnContent.textContent = item.textContent;
                    }
            })
        }
        else {
            let groupOption = [...selectForm.children]
            groupOption.forEach((e) => {
                let ulDropdow = dropdownContent.appendChild(document.createElement("ul"))
                let liDropdown = ulDropdow.appendChild(document.createElement("li"))
                liDropdown.textContent = e.getAttribute("label")
                liDropdown.classList.add("dropdown-header")
                let optionItem = [...e.children]
                optionItem.forEach((item) => {
                    let liDropdown = ulDropdow.appendChild(document.createElement("li"))
                    liDropdown.textContent = item.textContent
                })
            })

            let ul = [...dropdownContent.children]
            ul.forEach((item) => {
                item.childNodes.forEach((li) => {
                    li.addEventListener("click", () => {
                        if (li.classList.value === "") {
                            ul.forEach((ul) => {
                                ul.childNodes.forEach((i) => {
                                    i.classList.remove("active")
                                })
                            })
                            li.classList.add("active")
                            btnContent.textContent = li.textContent
                            btn.classList.remove("active")
                            document.querySelector(`.${classStr} > .dropdown-menu`).classList.remove("active")
                            groupOption.forEach((e) => {
                                let optionItem = [...e.children]
                                optionItem.forEach((item) => {
                                    if (item.textContent === btnContent.textContent)
                                        item.setAttribute("selected", true)
                                    else item.removeAttribute("selected")
                                })
                            })
                        }
                    })
                })
            })
        }
        function removeAccents(str) {
            return str.normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/đ/g, 'd').replace(/Đ/g, 'D');
        }
        btn.addEventListener("click", () => {
            btn.classList.toggle("active")
            document.querySelector(`.${classStr} > .dropdown-menu`).classList.toggle("active")
        })
        const search = document.querySelector(`.${classStr} > .dropdown-menu > .bs-searchbox > input`)
        let ul = [...dropdownContent.children]
        search.addEventListener("input", (e) => {
            let filter = e.target.value.toLowerCase()
            ul.forEach((item) => {
                item.childNodes.forEach((li) => {
                    if (li.classList.value === "") {
                        if (removeAccents(li.textContent.toLowerCase()).indexOf(removeAccents(filter)) > -1) {
                            li.style.display = ""
                        }
                        else {
                            li.style.display = "none"
                        }
                    }
                })
            })
        })
        window.addEventListener("click", function (e) {
            if (!document.querySelector(`.${classStr}`).contains(e.target)) {
                btn.classList.remove("active")
                document.querySelector(`.${classStr} > .dropdown-menu`).classList.remove("active")
            }
        })
    }
}

customSelect("select", false)



const baitapBtn = document.querySelectorAll(".exercise-title")
const baitap = document.querySelectorAll(".exercise-item")
if(baitapBtn)
{
    baitapBtn.forEach((item, index)=>{
        item.addEventListener("click", ()=>{
            baitap[index].classList.toggle("active")
        })
    })
    
}

const inputCount = document.querySelector(".input-count.only")
if(inputCount)
{
    const btnDecr = document.querySelector(".btn-decr")
    const btnIncr = document.querySelector(".btn-incr")

    btnDecr.addEventListener("click", ()=>{
        if(inputCount.value == 1)
        {
            inputCount.value = 1
        }
        else inputCount.value--
    })
    btnIncr.addEventListener("click", ()=>{
        inputCount.value++
    })
}

const moneyType = document.querySelectorAll(".money")
if(moneyType)
{
    console.log(moneyType)
    moneyType.forEach((item)=>{
        item.textContent = Number(Number(item.textContent).toFixed(1)).toLocaleString()
    })
}


const checkAll = document.querySelector(".check-all")
if(checkAll)
{
    checkAll.addEventListener("click", ()=>{
        checkboxes = document.querySelectorAll('.check-hd');
        checkboxes.forEach((item)=>{
            item.checked = checkAll.checked;
        })
    })
}

const conformRemove = document.querySelector(".button-defaut")
if(conformRemove)
{
    conformRemove.addEventListener("click", (e)=>{
        e.preventDefault()
        document.querySelector("body").insertAdjacentHTML("beforeend", `<form action="" method="post" class="remove-confirm">
        <h3>Bạn có muốn xóa không</h3>
        <button type="submit" name="cancel" class="btn-cancel">Hủy</button>
        <button type="submit" name="ok" class="btn-ok">OK</button>
        <i class="fa-solid fa-x icon-close"></i>
    </form>`)
    
    
        const btnClose = document.querySelector(".remove-confirm > .icon-close")
        if(btnClose)
        {
            btnClose.addEventListener("click", ()=>{
                document.querySelector("body").removeChild(document.querySelector(".remove-confirm"))
            })
        }

        const btnCancel = document.querySelector(".remove-confirm > .btn-cancel")
        if(btnCancel)
        {
            btnCancel.addEventListener("click", (e)=>{
                e.preventDefault()
                document.querySelector("body").removeChild(document.querySelector(".remove-confirm"))
            })
        }

    
    })
    
}

