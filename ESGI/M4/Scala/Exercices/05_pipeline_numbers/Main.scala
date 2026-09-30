// 05 — Functional Pipeline: Numbers
//
// Consigne :
//   def processNumbers(nums: List[Int]): Int
//   1. Garder uniquement les nombres pairs
//   2. Multiplier chacun par 3
//   3. Renvoyer la somme
//   Exemple : List(1, 2, 3, 4, 5, 6) -> 36   (2*3 + 4*3 + 6*3 = 6 + 12 + 18)

object Main extends App {

  val nums = List(1, 2, 3, 4, 5, 6)
  println(processNumbers(nums))

  def processNumbers(nums: List[Int]): Int = {
    // filter -> map -> sum, chained
    nums.filter(_ % 2 == 0).map(x => x*3).sum
  }
}
