// 02 — Guess the Number (non-interactif)
//
// Consigne :
//   On rejoue une partie à partir des tentatives déjà faites par le joueur.
//   def play(secret: Int, guesses: List[Int]): List[String]
//   Pour chaque tentative N (à partir de 1) :
//     "Attempt N: X is too small!"                      si X < secret
//     "Attempt N: X is too big!"                        si X > secret
//     "Attempt N: X is correct! Found in N attempt(s)." si X == secret
//   On s'arrête dès que le secret est trouvé, les tentatives suivantes sont ignorées.
//
// Sortie attendue (secret = 42, guesses = List(50, 25, 40, 45, 42)) :
//   Attempt 1: 50 is too big!
//   Attempt 2: 25 is too small!
//   Attempt 3: 40 is too small!
//   Attempt 4: 45 is too big!
//   Attempt 5: 42 is correct! Found in 5 attempt(s).

object Main extends App {

  val secret = 42
  val guesses = List(50, 25, 40, 45, 42)

  play(secret, guesses).foreach(println)

  // Version fonctionnelle : on sélectionne les tentatives utiles, puis on transforme chacune en phrase
  def play(secret: Int, guesses: List[Int]): List[String] = {
    // span coupe la liste au premier élément égal au secret
    val (before, fromFound) = guesses.span(_ != secret)
    // on garde la bonne réponse (si elle existe) et on jette ce qui suit
    val relevant = before ++ fromFound.take(1)

    relevant.zipWithIndex.map { case (guess, index) =>
      val attempt = index + 1
      if (guess < secret) s"Attempt $attempt: $guess is too small!"
      else if (guess > secret) s"Attempt $attempt: $guess is too big!"
      else s"Attempt $attempt: $guess is correct! Found in $attempt attempt(s)."
    }
  }

  // Version récursive : on traite la tête, l'appel récursif s'occupe du reste
  def playRecursive(secret: Int, guesses: List[Int], attempt: Int = 1): List[String] =
    if (guesses.isEmpty) Nil
    else {
      val guess = guesses.head
      if (guess == secret) List(s"Attempt $attempt: $guess is correct! Found in $attempt attempt(s).")
      else {
        val hint = if (guess < secret) "too small" else "too big"
        s"Attempt $attempt: $guess is $hint!" :: playRecursive(secret, guesses.tail, attempt + 1)
      }
    }

  // Première version, impérative (var + break), gardée pour comparaison.
  // Défaut : answers :+ x recopie toute la List à chaque tour -> O(n²) au total.
  def playImperative(secret: Int, guesses: List[Int]): List[String] = {
    import scala.util.control.Breaks._

    var tries = 0
    var answers: List[String] = List()
    breakable {
      for (guess <- guesses) {
        tries = tries + 1
        if (guess == secret) {
          answers = answers :+ s"Attempt $tries: $guess is correct! Found in $tries attempt(s)."
          break()
        }
        else if (guess < secret) answers = answers :+ s"Attempt $tries: $guess is too small!"
        else answers = answers :+ s"Attempt $tries: $guess is too big!"
      }
    }
    answers
  }
}
