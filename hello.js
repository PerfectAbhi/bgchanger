    function addcolor(colorname) {
        const color = document.querySelector('.colorscontainer');
        const creteelement = document.createElement('span')
        const child = color.appendChild(creteelement)
        child.className = "button"
        child.innerHTML = `${colorname}`
        child.style.backgroundColor = `${colorname}`
        child.addEventListener("click", (c) => {
            document.querySelector('body').style.backgroundColor = `${colorname}`
        })

    }

    const input = document.querySelector('input')
    const button = document.querySelector('button')
    button.addEventListener("click", (e) => {
        addcolor(`${input.value}`);
    })


    const colors = document.querySelectorAll('.button');
    Array.from(colors).forEach((color) => {
        const colorname = color.innerHTML;
        color.style.backgroundColor = `${colorname}`;
        color.addEventListener("click", (e) => {
            document.querySelector('body').style.backgroundColor = `${color.innerHTML}`
        })
    })












