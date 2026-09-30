// 04 — List vs Vector Benchmark
//
// Consigne :
//   def timeOperation(operation: => Unit): Long
//   Exécute operation et renvoie sa durée en millisecondes.
//   Créer une List et un Vector remplis de zéros (List.fill(n)(0) / Vector.fill(n)(0)),
//   mesurer un ajout en tête (1 +: collection) et un ajout en fin (collection :+ 1) sur chacun.
//   Afficher : Prepend : List = <t> ms, Vector = <t> ms Append : List = <t> ms, Vector = <t> ms
//   Ce qui doit toujours être vrai : l'ajout en fin sur la List est le plus lent.

object Main extends App {

  val n = 100000
  val list = List.fill(n)(0)
  val vector = Vector.fill(n)(0)

  // time a prepend (1 +: collection) on each collection

  val vector_prepend_duration = timeOperation(1 +: vector)
  val list_prepend_duration = timeOperation(1 +: list)

  // time an append (collection :+ 1) on each collection
  val vector_append_duration = timeOperation(vector :+ 0)
  val list_append_duration = timeOperation(list :+ 0)

  // println the two results, matching the format in the description
  println(s"Prepend : List = $list_prepend_duration ms, Vector = $vector_prepend_duration ms Append : List = $list_append_duration ms, Vector = $vector_append_duration ms")

  def timeOperation(operation: => Unit): Long = {

    val processStart:Long = System.currentTimeMillis()
    operation
    val processEnd:Long = System.currentTimeMillis()
    val elapsed:Long = processEnd - processStart
    elapsed
  }
}
