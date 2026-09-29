// 06 — Functional Pipeline: Text
//
// Consigne :
//   def textPipeline(text: String): Map[String, Int]
//   1. Découper le texte en mots (sur les espaces blancs)
//   2. Mettre chaque mot en minuscules
//   3. Garder les mots de longueur >= 4
//   4. Compter les occurrences de chaque mot
//   Afficher une ligne "mot -> nombre" par mot, par ordre alphabétique.
//
// Sortie attendue (text = "Scala is great and Scala is functional") :
//   functional -> 1
//   great -> 1
//   scala -> 2

object Main extends App {

  val text = "Scala is great and Scala is functional"

  textPipeline(text).toList.sortBy(_._1).foreach { case (word, count) =>
    println(s"$word -> $count")
  }

  def textPipeline(text: String): Map[String, Int] =
    text
      .split("\\s+")          // regex : un ou plusieurs caractères blancs
      .map(_.toLowerCase)
      .filter(_.length >= 4)
      .groupBy(identity)      // même fin de pipeline que l'exercice 03
      .view.mapValues(_.length)
      .toMap
}
