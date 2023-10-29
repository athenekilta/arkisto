'use strict' // but don't use semicolons lol

window.onload = () => {
  const leaves = [1, 2, 3, 4]
    .map(i => document.getElementById(`leaves-${i}`))
  document.body.onscroll = () => {
    // approximate values, should be good enough
    const height = document.body.scrollHeight - window.innerHeight
    const position = window.scrollY
    const fa = 6
    const fb = 5
    const fc = 5
    leaves[0].style.top = `${15 - position / height * fa}rem`
    leaves[1].style.top = `${25 - position / height * fb}rem`
    leaves[2].style.top = `${15 - position / height * fa}rem`
    leaves[3].style.top = `${25 - position / height * fb}rem`
    leaves[0].style.left = `${-24 - position / height * fa/fc}rem`
    leaves[1].style.left = `${-24 - position / height * fb/fc}rem`
    leaves[2].style.right = `${-24 - position / height * fa/fc}rem`
    leaves[3].style.right = `${-24 - position / height * fb/fc}rem`
    // leaves.forEach(l => l.style.opacity = (1 - position / height) / 2)
  }
}
