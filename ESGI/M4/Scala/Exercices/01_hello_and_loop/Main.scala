// 01 — Hello and Loop
//
// Consigne :
//   - Déclarer une val name: String
//   - Afficher "Hello, <name>!" avec l'interpolation s"..."
//   - Afficher les nombres de 1 à 10, un par ligne, avec une boucle for

object Main extends App {

  val name: String = "Antonin"
  println(s"Hello $name !")

  for (i <- 1 to 10) println(i)
}
