// 05 — Functional Pipeline: Numbers
//
// Consigne :
//   def processNumbers(nums: List[Int]): Int
//   1. Garder uniquement les nombres pairs
//   2. Multiplier chacun par 3
//   3. Renvoyer la somme
//
// Sortie attendue (nums = List(1, 2, 3, 4, 5, 6)) :
//   36    (2*3 + 4*3 + 6*3 = 6 + 12 + 18)

object Main extends App {

  val nums = List(1, 2, 3, 4, 5, 6)
  println(processNumbers(nums))

  def processNumbers(nums: List[Int]): Int =
    nums
      .filter(_ % 2 == 0) // List(2, 4, 6)
      .map(_ * 3)         // List(6, 12, 18)
      .sum                // 36 (et 0 sur une liste vide, contrairement à reduce)
}
