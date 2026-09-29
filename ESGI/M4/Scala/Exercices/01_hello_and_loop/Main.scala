// 01 — Hello and Loop
//
// Consigne :
//   - Déclarer une val name: String
//   - Afficher "Hello, <name>!" avec l'interpolation s"..."
//   - Afficher les nombres de 1 à 10, un par ligne, avec une boucle for
//
// Sortie attendue (name = "Antonin") :
//   Hello, Antonin!
//   1
//   ...
//   10

object Main extends App {

  val name: String = "Antonin"

  println(s"Hello, $name!")

  // 1 to 10 inclut 10 (1 until 10 s'arrêterait à 9)
  for (i <- 1 to 10) println(i)
}
