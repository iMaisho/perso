
// Utilisation de this dans le contexte d'une fonction classique.
const person = {
    name: "Antonin MINGAM",
    greet: function () {
        console.log(`Hello ${this.name}`)
        console.log(this)
    }
}

person.greet();

// Renvoie :
// Hello Antonin MINGAM
// { name: 'Antonin MINGAM', greet: ƒ }

// Dans ce cas, la fonction ne fonctionne pas, ${this.name} est undefined
const person2 = {
    name: "John Doe",
    greet: () => {
        console.log(`Hello ${this.name}`)
        console.log(this)
    }
}

person2.greet();

// Renvoie:
// Hello undefined
// { }


// MakeGreet est une fabrique de fonction.
function MakeGreet (greetingWord) {
    return function (name) {
        console.log(greetingWord + " " + name);
    }
}

// greetInFrench est un produit de cette fabrique, qui permet de répondre à un besoin particulier
const greetInFrench = MakeGreet("Bonjour");

greetInFrench("Maurice");
//Renvoie "Bonjour Maurice"

