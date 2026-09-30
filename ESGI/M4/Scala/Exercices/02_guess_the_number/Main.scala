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
//   Appeler play avec secret = 42 et guesses = List(50, 25, 40, 45, 42) et afficher chaque ligne.

object Main extends App {
  import scala.util.control.Breaks._

  val secret = 42
  val guesses = List(50, 25, 40, 45, 42)

  play(secret, guesses).foreach(println)

  def play(secret: Int, guesses: List[Int]): List[String] = {

    var tries = 0
    var answers:List[String] = List()
    breakable{
      for (guess <- guesses){
      tries = tries + 1
      if (guess == secret){
        val string = s"Attempt $tries: $guess is correct! Found in $tries attempt(s)."
        answers = answers :+ string
        break()
      }
      else if (guess < secret){
        val string = s"Attempt $tries: $guess is too small!"
        answers = answers :+ string
      }
      else{
        val string = s"Attempt $tries: $guess is too big!"
        answers = answers :+ string
      }
      }
    }
    answers
  }
}
