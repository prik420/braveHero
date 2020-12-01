<?php

class Character
{
    //Initializing the parent class
    public $name;
    protected $life;
    protected $power;
    protected $defense;
    protected $speedAttack;
    protected $luck;

    public function __construct($name)
    {
        $this->name = $name;
        $this->life = rand(55, 80);
        echo "$this->name has left $this->life points of life.\n";
        $this->power = rand(50, 80);
        echo "$this->name has left $this->power points of power.\n";
        $this->defense = rand(35, 55);
        echo "$this->name has left $this->defense points of defense.\n";
        $this->speedAttack = rand(40, 60);
        echo "$this->name has left $this->speedAttack points of speed attack.\n";
        $this->luck = ((rand(25, 40) / 100) * 100);
        echo "$this->name has a change of $this->luck% to get lucky.\n";
        echo "\r";
    }

    //Creating getters and setters and checking the conditions for being in range
    /**
     * @return int
     */
    public function getLife()
    {
        return $this->life;
    }

    /**
     * @param int $life
     */
    public function setLife($life)
    {
        $this->life = $life;
    }

    /**
     * @return int
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param int $power
     */
    public function setPower($power)
    {
        $this->power = $power;
    }

    /**
     * @return int
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * @param int $defense
     */
    public function setDefense($defense)
    {
        $this->defense = $defense;
    }

    /**
     * @return int
     */
    public function getSpeedAttack()
    {
        return $this->speedAttack;
    }

    /**
     * @param int $speedAttack
     */
    public function setSpeedAttack($speedAttack)
    {
        $this->speedAttack = $speedAttack;
    }

    /**
     * @return float|int
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * @param float|int $luck
     */
    public function setLuck($luck)
    {
        $this->luck = $luck;
    }


    public function getLucky()
    {
        return $this->luck > rand(0, 100);

    }


    public function stillHasLife()
    {

        return $this->life > 0;

    }

    //Creating the isAttacking method to return opponent`s remaining life after the attack
    public function isAttacking($opponent)
    {
        $damage = $this->getPower() - $opponent->getDefense();

        if ($damage < 0){
            echo "Damage too weak, it will damage $opponent->name with 0\n";
            return $opponent->getLife();
        }

        elseif ($damage >= 100) {

            echo "Damage is too strong, it will kill $opponent->name surely\n";
            return $opponent->getLife() - 100;

        }
        else{

            echo "Damage $damage will apply to $opponent->name\n";
            return $opponent->getLife() - $damage;
        }

    }

}

//Inherit form parent class
class Hero extends Character
{

    protected $inAttack;

    public function __construct($name)
    {

        $this->name = $name;
        $this->life = rand(65, 90);
        echo "$this->name has left $this->life points of life.\n";
        $this->power = rand(60, 70);
        echo "$this->name has left $this->power points of power.\n";
        $this->defense = rand(40, 50);
        echo "$this->name has left $this->defense points of defense.\n";
        $this->speedAttack = rand(40, 50);
        echo "$this->name has left $this->speedAttack points of speed attack.\n";
        $this->luck = ((rand(10, 30) / 100) * 100);
        echo "$this->name has a change of $this->luck% to get lucky.\n";
        $this->inAttack = 0;
    }

    /**
     * @return int
     */
    public function getInAttack()
    {
        return $this->inAttack;
    }

    /**
     * @param int $inAttack
     */
    public function setInAttack($inAttack)
    {
        $this->inAttack = $inAttack;
    }


    //Creating the special power for attacking
    public function powerOfDragon($opponentDefense, $opponentLife)
    {
        $damage = $this->getPower() * 2 - $opponentDefense;
        if($damage <= 0){

            echo "This time i`ll hit you with double of my power, however you`ll get 0 damage points\n";
            return $opponentLife;
        }

        elseif ($damage >= 100) {

            echo "This time i`ll hit you with double of my power, it`s too much for you ? Just 100 points\n";
            return $opponentLife - 100;

        }else{

            echo "This time i`ll hit you with double of my power, meaning $damage points\n";
            return $opponentLife - $damage;
        }

    }

    //Generating the chance of getting special power
    public function chanceOfLuck($number)
    {

        return $number > rand(0, 100);

    }


    //Creating the special power for defending
    public function enchantedShield($attackPower)
    {
        $damage = $attackPower / 2 - $this->getDefense();

        if($damage <= 0){

            echo "This time i`ll split your power attack in half, damaging me with 0 points\n";
            return $this->getLife();

        }
        elseif ($damage >= 100) {

            echo "This time i`ll split your power attack in half, but you hit me hard. 100 points it`s too much\n";
            return $this->getLife() - 100;

        }else{

            echo "This time i`ll split your power attack in half, damaging me with just $damage points\n";
            return $this->getLife() - $damage;
        }

    }


}

//Creating the instances of classes
$myHero = new Hero('Carl');
$theBeast = new Character('Beast');

//Initiate the counting of rounds from 1
$numberOfRounds = 1;

//Let the user choose the number of rounds he would like
$numberOfRoundsToPlay = readline("How many rounds would you like?\n");

//Finding who is sett to start
if ($myHero->getSpeedAttack() > $theBeast->getSpeedAttack() || ($myHero->getSpeedAttack() == $theBeast->getSpeedAttack() && $myHero->getLuck() > $theBeast->getLuck()))
    $myHero->setInAttack(1);
else
    $myHero->setInAttack(0);

//Looping to every round
while($numberOfRounds <= $numberOfRoundsToPlay){

    //Verifying if characters are still alive and announce the winner if it`s not the case
    if(!$theBeast->stillHasLife()){

        echo "$myHero->name has won";
        $numberOfRounds = $numberOfRoundsToPlay;
        break;

    } elseif (!$myHero->stillHasLife()){

        echo "$theBeast->name has won";
        $numberOfRounds = $numberOfRoundsToPlay;
        break;

    } else{

        //If they are still alive will continue fighting
        echo "Round no $numberOfRounds is starting.\n";
        switch ($myHero->getInAttack()){
            case 0:
                echo "$theBeast->name is attacking.\n";
                //Checking if is lucky enough to avoid the hit
                if($myHero->getLucky())
                    echo "$myHero->name is getting lucky, no damage\n";

                //Also checking the possibility of having the enchanted Shield
                elseif ($myHero->chanceOfLuck(10)){

                    echo "No luck, but still i get the shield\n";
                    $myHero->setLife(($myHero->enchantedShield($theBeast->getPower())));
                    echo "Now $myHero->name has ";
                    echo $myHero->getLife();
                    echo " points of life \n";

                }else{

                    //If there`s none, apply the damage to the defender
                    $myHero-> setLife($theBeast->isAttacking($myHero));
                    if(!$myHero->stillHasLife())
                        echo "$myHero->name is death\n";
                    else{
                        echo "Now $myHero->name has ";
                        echo $myHero->getLife();
                        echo " points of life \n";
                    }

                }
                //Switching the roles then break
                $myHero->setInAttack(1);
                break;

            case 1:
                //Same with case 1, but here we verified if there`s a chance of having the power of dragon
                echo "$myHero->name is attacking.\n";
                if($theBeast->getLucky())
                    echo "$theBeast->name is getting lucky, no damage\n";
                elseif ($myHero->chanceOfLuck(10)){

                    echo "I have a special power. Now i will double my attacking power\n";
                    $theBeast->setLife($myHero->powerOfDragon($theBeast->getLife(),$theBeast->getDefense()));
                    if($theBeast->stillHasLife()){

                        echo "Now $theBeast->name has ";
                        echo $theBeast->getLife();
                        echo " points of life \n";

                    }else
                        echo "$theBeast->name is death\n";

                }else{
                    $theBeast->setLife($myHero->isAttacking($theBeast));
                    if(!$theBeast->stillHasLife())
                        echo "$theBeast->name is death\n";

                    else{
                        echo "Now $theBeast->name has ";
                        echo $theBeast->getLife();
                        echo " points of life \n";
                    }

                }
                $myHero->setInAttack(0);
                break;
        }
    }

    //Here is verified if there are rounds to play, and if not, which is the winner
    if($numberOfRounds == $numberOfRoundsToPlay){
        $numberOfRounds =+ $numberOfRoundsToPlay;
        $remainLife = $myHero->getLife() - $theBeast->getLife();
        echo "Maximum number of rounds was reached\n";
        if($remainLife > 0)
            echo "$myHero->name has won.";
        elseif($remainLife < 0){
            echo "$theBeast->name has won.";
        }else
            echo "It`s draw";
    }

    //Increasing the numberOfRounds played
    $numberOfRounds ++;

}
