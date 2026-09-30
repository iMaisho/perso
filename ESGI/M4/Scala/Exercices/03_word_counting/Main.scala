// 03 — Word Counting
//
// Consigne :
//   def wordCount(words: List[String]): Map[String, Int]
//   Associe chaque mot distinct à son nombre d'occurrences.
//   Afficher une ligne "mot -> nombre" par mot, par ordre alphabétique
//   (l'ordre d'affichage d'une Map n'est pas garanti).

object Main extends App {

  val words = List("A", "B", "A", "C", "B", "A")

  wordCount(words).toList.sortBy(_._1).foreach { case (word, count) =>
    println(s"$word -> $count")
  }

  def wordCount(words: List[String]): Map[String, Int] =
    words.groupBy(identity).view.mapValues(_.size).toMap
}
