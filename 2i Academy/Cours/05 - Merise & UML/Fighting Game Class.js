class Character{
    constructor(healthPoints, attackDmg, position){
        this.healthPoints = healthPoints;
        this.attackDmg = attackDmg;
        this.position = position;
        this.isParring = false;
    };

    attack(target){
        if (this.position == target.position && target.isParring == false){
            target.loseHealth(this.attackDmg);
        }
    };

    loseHealth(amount){
        this.healthPoints -= amount;
    };

    defend(){
        this.isParring = true;
    };

};