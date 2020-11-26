let music = document.querySelector("#music")

let img=document.querySelector(".navbar-brand>img")

    if(sessionStorage.getItem("sound")=="off"){
        music.pause()
        img.dataset.status="off"
        img.style.background="red"
        img.src="./images/svg/sound-off.svg"
    }else {
        img.src="./images/svg/sound-on.svg"
        music.play()
        img.style.background="yellow"  
        img.dataset.state="on"      
    }

document.querySelector(".navbar-brand").onclick=()=>{
    musicOnOff()
}

function musicOnOff(){
    console.log(img.dataset.state)
    if(img.dataset.state=="on"){
        img.src="./images/svg/sound-off.svg"
        music.pause()
        img.style.background="red"
        img.dataset.state="off"
    }else {
        img.src="./images/svg/sound-on.svg"
        music.play()
        img.style.background="yellow"  
        img.dataset.state="on"      
    }
    sessionStorage.setItem("sound",img.dataset.state)
}