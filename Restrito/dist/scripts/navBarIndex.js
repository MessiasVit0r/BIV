document.querySelectorAll('.navigate-home').forEach(element =>{
    element.addEventListener('click', ()=>{
        window.location.href = 'index.php'
    })
})
document.querySelectorAll('#navigate-acoes').forEach(element =>{
    element.addEventListener('click', ()=>{
        window.location.href = './dist/pages/acoes.php'
    })
})
document.querySelectorAll('#navigate-creditos').forEach(element =>{
    element.addEventListener('click', ()=>{
        window.location.href = './dist/pages/creditos.php'
    })
})
document.getElementById('navigate-historico').addEventListener('click', ()=>{
    window.location.href = './dist/pages/historico.php'
})
document.getElementById('logout').addEventListener('click', ()=>{
    window.location.href = './dist/pages/logout.php'
})