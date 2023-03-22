'use strict'


const gTouchEvs = ['touchstart', 'touchmove', 'touchend']
var gStartPos

function onInit() {
    gCanvas = document.querySelector('#meme-canvas')
    gCtx = gCanvas.getContext('2d')
    renderGallery()
    renderCanvas()
    renderKeyWords()
    addListeners()
    renderStickers()
}

function addListeners() {
    addMouseListeners()
    addTouchListeners()
    window.addEventListener('resize', () => {
        // resizeCanvas()
        renderCanvas()
    })
}

function addMouseListeners() {
    gCanvas.addEventListener('mousemove', onMove)
    gCanvas.addEventListener('mousedown', onDown)
    gCanvas.addEventListener('mouseup', onUp)
}

function addTouchListeners() {
    gCanvas.addEventListener('touchmove', onMove)
    gCanvas.addEventListener('touchstart', onDown)
    gCanvas.addEventListener('touchend', onUp)
}


function onDown(ev) {
    ev.preventDefault()
    const pos = getEvPos(ev)
    if (!isLineClicked(pos)) return
    setLineDragg(true)
    gStartPos = pos
    gCanvas.style.cursor = 'grabbing'
}


function onMove(ev) {
    const line = getLine()
    if (!line.isDragged) return
    const pos = getEvPos(ev)
    const dx = pos.x - gStartPos.x
    const dy = pos.y - gStartPos.y
    gStartPos = pos
    moveLine(dx, dy)
    renderCanvas()
}

function onUp() {
    setLineDragg(false)
    gCanvas.style.cursor = 'grab'

}


function getEvPos(ev) {
    var pos = {
        x: ev.offsetX,
        y: ev.offsetY,
    };
    if (gTouchEvs.includes(ev.type)) {
        ev.preventDefault()
        ev = ev.changedTouches[0]
        pos = {
            x: ev.pageX - ev.target.offsetLeft - ev.target.clientLeft,
            y: ev.pageY - ev.target.offsetTop - ev.target.clientTop,
        };
    }
    return pos
}



function renderGallery() {
    const images = getImgs()

    let strHtmls = images.map(function (img) {
        return `  
        <img class="meme-image" src="${img.url}" id="${img.id}" onclick="onCreateMeme('${img.id}')">
       `
    })
    document.querySelector('.img-container').innerHTML = strHtmls.join('')
}


function onMoveToGalery() {
    document.querySelector('.about-page').classList.add('hidden')
    document.querySelector('.search-sec').style.display = 'flex'
    document.querySelector('.img-container').style.display = 'grid'
    document.querySelector('.editor-container').style.display = 'none'
    document.querySelector('.save-meme-container').classList.add('hidden')
    renderGallery()
}


function onMoveToAboutPage() {
    document.querySelector('.search-sec').style.display = 'none'
    document.querySelector('.img-container').style.display = 'none'
    document.querySelector('.editor-container').style.display = 'none'
    document.querySelector('.about-page').classList.remove('hidden')
    document.querySelector('.save-meme-container').classList.add('hidden')

}


function onMoveToMemePage() {
    document.querySelector('.search-sec').style.display = 'none'
    document.querySelector('.img-container').style.display = 'none'
    document.querySelector('.editor-container').style.display = 'none'
    document.querySelector('.about-page').classList.add('hidden')
    document.querySelector('.save-meme-container').classList.remove('hidden')

}


function renderStickers() {
    const stikers = getStickers()
    console.log(stikers)
    let stickerHtml = stikers.map(function (sticker) {
        return `
        <img class="sticker-image" src="${sticker.url}" id="${sticker.id}" onclick="onOpenModal()">
       `
    })
    document.querySelector('.stickers-container').innerHTML = stickerHtml.join('')
}


//opens a modal once a stiker is clicked
function onOpenModal() {
    var modal = document.getElementById('myModal')
    modal.style.display = 'block'

    var span = document.getElementsByClassName('close')[0]
    span.onclick = function () {
        modal.style.display = 'none'
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none'
        }
    }
}



//need to fix
function onCenterSticker(stickerId) {
    getStickerById(stickerId)
    console.log(stickerId)
    renderCanvas()
    // gCtx.drawImage(elSticker, sticker.positionX, sticker.positionY)

}


//delete the input once I click enter
document.querySelector('#text').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        document.querySelector('.userTxt').value = ''
    }
})


//once a picture is clicked - our editor area appears 
function setPage() {
    document.querySelector('.img-container').style.display = 'none'
    document.querySelector('.canvas-editors').style.display = 'block'
    document.querySelector('.search-sec').style.display = 'none'
    document.querySelector('.editor-container ').style.display = 'flex'
}

//need to fix
//To keep track of the link we are on
const activePage = window.location.pathname
const navLinks = document.querySelectorAll('a').forEach(link => {
    if (link.href.includes(`${activePage}`)) {
        link.classList.add('active')
    }
})



function onSetLang(lang) {
    setLang(lang)
    if (lang === 'he') document.body.classList.add('rtl')
    else document.body.classList.remove('rtl')
    doTrans()
}


function toggleMenu() {
    document.body.classList.toggle('menu-open')
}

//once the upload btn is clicked - input area is shown
function onDisplayInputFile() {
    document.querySelector('.file-input').style.display = 'block'
}

function onclickFilter(theme) {
    onFilterMemes(theme)
    renderKeyWords()
}

//filter by box filter & keyword 
function onFilterMemes(theme) {
    let strHtml = ``
    const imgs = getImgs()
    const keyWords = getKeyWords()
    console.log(keyWords)
    const keyWordIdx = getKeywordId(theme)
    console.log(keyWordIdx)
    if (keyWords[keyWordIdx].category === theme) modifyKeyWordSize(keyWordIdx)
    let newImgs = imgs.filter((img) => {
        const keyWords = img.keyWords
        return keyWords.find(keyword => keyword.startsWith(theme.toLowerCase()))
    })
    newImgs.forEach(img => {
        strHtml += `<img class="meme-image" src="${img.url}" id="${img.id}" onclick="onCreateMeme('${img.id}')">`
    })
    document.querySelector('.img-container').innerHTML = strHtml
}


//render Keywords
function renderKeyWords() {
    const keyWords = getKeyWords()
    let btnHtml = ''
    keyWords.map(function (keyWord) {
        btnHtml += `<button data-trans=${keyWord.category} class="filter-btn" style="font-size: ${keyWord.fontSize + 10}px;" onclick="onclickFilter('${keyWord.category}')">${keyWord.category}</button>`
    })
    document.querySelector('.search-words').innerHTML = btnHtml
    doTrans()
}



//download canvas
function downloadImg(elLink) {
    var imgContent = gCanvas.toDataURL('image/jpeg')
    elLink.href = imgContent
}


//sahre to fc
function shareToExternalSorce() {
    const facebookIcon = document.querySelector('.fa-facebook').style.display = 'none'
    const imgDataUrl = gCanvas.toDataURL("image/jpeg")
    function onSuccess(uploadedImgUrl) {
        const encodedUploadedImgUrl = encodeURIComponent(uploadedImgUrl)
        document.querySelector('.share-container').innerHTML = `
        <a class="btn" href="https://www.facebook.com/sharer/sharer.php?u=${encodedUploadedImgUrl}&t=${encodedUploadedImgUrl}" title="Share on Facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=${uploadedImgUrl}&t=${uploadedImgUrl}'); return false;">
        Click to share 
        </a>`
    }
    doUploadImg(imgDataUrl, onSuccess)
}




