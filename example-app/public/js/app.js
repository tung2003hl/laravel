const btn = document.querySelectorAll("button")
console.log(btn)
btn.forEach(function(button,index){
button.addEventListener("click",function(event){{
    var btnItem = event.target
    var product = btnItem.parentElement
    var productImg = product.querySelector("img ")
    console.log(btn)
}})
})