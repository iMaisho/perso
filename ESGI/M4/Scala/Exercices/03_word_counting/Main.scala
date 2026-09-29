// 03 — Word Counting
//
// Consigne :
//   def wordCount(words: List[String]): Map[String, Int]
//   Associe chaque mot distinct à son nombre d'occurrences.
//   Afficher une ligne "mot -> nombre" par mot, par ordre alphabétique
//   (l'ordre d'affichage d'une Map n'est pas garanti).
//
// Sortie attendue (words = List("A", "B", "A", "C", "B", "A")) :
//   A -> 3
//   B -> 2
//   C -> 1

object Main extends App {

  val words = List("A", "B", "A", "C", "B", "A")

  // toList : Map -> List[(String, Int)], sortBy(_._1) : tri sur le mot
  wordCount(words).toList.sortBy(_._1).foreach { case (word, count) =>
    println(s"$word -> $count")
  }

  def wordCount(words: List[String]): Map[String, Int] =
    words
      .groupBy(identity)      // Map("A" -> List("A", "A", "A"), "B" -> List("B", "B"), ...)
      .view.mapValues(_.size) // chaque groupe -> sa taille (mapValues seul est déprécié en 2.13)
      .toMap

  // Alternative en une passe (Scala 2.13+) :
  // words.groupMapReduce(identity)(_ => 1)(_ + _)
}
