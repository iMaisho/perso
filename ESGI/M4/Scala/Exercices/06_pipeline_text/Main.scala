// 06 — Functional Pipeline: Text
//
// Consigne :
//   def textPipeline(text: String): Map[String, Int]
//   1. Découper le texte en mots (sur les espaces)
//   2. Mettre chaque mot en minuscules
//   3. Garder les mots de longueur >= 4
//   4. Compter les occurrences de chaque mot
//   Afficher une ligne "mot -> nombre" par mot, par ordre alphabétique.

object Main extends App {

  val text = "Scala is great and Scala is functional"
  textPipeline(text).toList.sortBy(_._1).foreach { case (word, count) =>
    println(s"$word -> $count")
  }

  def textPipeline(text: String): Map[String, Int] = {
    // split -> lowercase -> filter by length -> count occurrences
    text.toLowerCase().split(" ").filter(s => s.length > 3).groupBy(identity).view.mapValues(_.size).toMap
  }
}
