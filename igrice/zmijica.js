console.log("start")


const canvas = document.getElementById("canvas")
const ctx = canvas.getContext("2d")
 
document.addEventListener("keydown", pritisak)
 
let velicina = 30;
let skor = 0;
let brzina = 10
let zaustavi = false;
 
var jabuke = []
 
class Lokacija {
    constructor(x, y) {
        this.x = x;
        this.y = y;
    }
 
    dodaj(lokacija) {
        this.x += lokacija.x
        this.y += lokacija.y
        return this
    }
 
    distanca(lokacija) {
        return Math.sqrt(Math.pow(lokacija.x - this.x, 2) + Math.pow(lokacija.y - this.y, 2))
    }
 
}
 
function nactaj(lokacija) {
    ctx.fillRect(lokacija.x, lokacija.y, velicina, velicina)
}

class Zmija {
 
    constructor(lokacija) {
        this.lokacija = lokacija
        this.zmijaTelo = []
    }
 
    nacrtajZmiju() {
        ctx.fillStyle = "lime"
        if (!zaustavi) {
            this.zmijaTelo.shift()
            this.zmijaTelo.push(new Lokacija(this.lokacija.x, this.lokacija.y))
        }
        nactaj(this.lokacija)
        for (let i = 0; i < this.zmijaTelo.length; i++) {
            nactaj(this.zmijaTelo[i])
        }
        if (this.zmijaTelo.length > 1) for (let i = 0; i < this.zmijaTelo.length-2; ++i) {
            let distanca = this.lokacija.distanca(this.zmijaTelo[i]);
            if (distanca <= 5) {
                zaustavi = true;
                break;
            }
        }
    }
 
    proveriHitbox(jabuka) {
        var distanca = this.lokacija.distanca(jabuka.lokacija);
        if (distanca <= velicina) {
            this.zmijaTelo.push(this.zmijaTelo[this.zmijaTelo.length-1])
            jabuka.pojedi()
            skor++;
        }
    }
 
    pomeri(vektor) {
        if (zaustavi) return
        this.lokacija.dodaj(vektor)
        if (this.lokacija.x < 0) {
            // this.lokacija.x = canvas.width
            zaustavi = true
        } else if (this.lokacija.x > canvas.width-velicina) {
            // this.lokacija.x = 0
            zaustavi = true
        } else if (this.lokacija.y < 0) {
            // this.lokacija.y = canvas.height
            zaustavi = true
        } else if (this.lokacija.y > 600-velicina) {
            // this.lokacija.y = 0
            zaustavi = true
        }
    }
}
 
class Jabuka {
 
    constructor(lokacija) {
        this.lokacija = lokacija
        this.pojedena = false
    }
 
    nacrtaj() {
        ctx.fillStyle = "red"
        nactaj(this.lokacija)
    }
 
    pojedi() {
        this.pojedena = true
    }
 
}
 
var zmija = new Zmija(new Lokacija(400, 400));
var vektor = new Lokacija(0, brzina)
var jabuka = new Jabuka(new Lokacija(50, 50))
jabuke.push(jabuka)
 
loop()
 
function loop() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = "black"
    ctx.fillRect(0, 0, canvas.width, canvas.height)
    if (jabuka.pojedena) {
        this.jabuka = new Jabuka(new Lokacija(Math.random()*(canvas.width-velicina), Math.random()*(canvas.height-velicina)))
    }
    jabuka.nacrtaj()
    if (!zaustavi) {
        zmija.pomeri(vektor)
        zmija.proveriHitbox(jabuka)
    }
    zmija.nacrtajZmiju();
    ctx.font = "25px Arial";
    ctx.fillStyle = "white"
    ctx.fillText("Rezultat: " + skor, canvas.width-150, 40);
 
    setTimeout(loop, 20)
}
function pritisak(e) {
    if (e.keyCode == 39 && vektor.x != -brzina) {
        // desno
        vektor.x = brzina
        vektor.y = 0
    } else if (e.keyCode == 40 && vektor.y != -brzina) {
        // dole
        vektor.x = 0
        vektor.y = brzina
    } else if (e.keyCode == 37 && vektor.x != brzina) {
        //levo
        vektor.x = -brzina
        vektor.y = 0
    } else if (e.keyCode == 38 && vektor.y != brzina) {
        //gore
        vektor.x = 0
        vektor.y = -brzina
    }
}