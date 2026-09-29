// 04 — List vs Vector Benchmark
//
// Consigne :
//   def timeOperation(operation: => Unit): Long
//   Exécute operation et renvoie sa durée en millisecondes.
//   Créer une List et un Vector de 100 000 zéros (List.fill(n)(0) / Vector.fill(n)(0)),
//   mesurer un ajout en tête (1 +: collection) et un ajout en fin (collection :+ 1) sur chacun.
//
// Sortie attendue (les chiffres dépendent de la machine) :
//   Prepend : List = <t> ms, Vector = <t> ms
//   Append : List = <t> ms, Vector = <t> ms
// Ce qui doit toujours être vrai : l'ajout en fin sur la List est le plus lent.

object Main extends App {

  val n = 100_000
  val list = List.fill(n)(0)
  val vector = Vector.fill(n)(0)

  val listPrepend = timeOperation(1 +: list)     // O(1) : une seule nouvelle cellule
  val vectorPrepend = timeOperation(1 +: vector) // effectivement constant

  val listAppend = timeOperation(list :+ 1)      // O(n) : recopie les 100 000 cellules
  val vectorAppend = timeOperation(vector :+ 1)  // effectivement constant

  println(s"Prepend : List = $listPrepend ms, Vector = $vectorPrepend ms")
  println(s"Append : List = $listAppend ms, Vector = $vectorAppend ms")

  // operation est un paramètre by-name (=> Unit) : l'expression n'est évaluée
  // qu'à l'endroit où on écrit `operation`, donc entre start et end.
  def timeOperation(operation: => Unit): Long = {
    val start = System.nanoTime() // monotone et précis, contrairement à currentTimeMillis
    operation
    val end = System.nanoTime()
    (end - start) / 1_000_000     // nanosecondes -> millisecondes
  }
}
