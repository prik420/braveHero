<?php


class Beast
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
        $this->life = rand(0, 100);
        echo "$this->name has left $this->life points of life.\n";
        $this->power = rand(9, 100);
        echo "$this->name has left $this->power points of power.\n";
        $this->defense = rand(9, 100);
        echo "$this->name has left $this->defense points of defense.\n";
        $this->speedAttack = rand(9, 100);
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
    protected function setLife($life)
    {
        if($life <= 0)
            $this->life = 0;
        elseif($life >= 100)
            $this->life = 100;
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
    protected function setPower($power)
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
    protected function setDefense($defense)
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
    protected function setSpeedAttack($speedAttack)
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
    protected function setLuck($luck)
    {
        $this->luck = $luck;
    }


    public function getLucky($luck)
    {
        return $luck > rand(0, 100);

    }


    public function stillHasLife()
    {

        return $this->getLife() > 0;

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
            return 0;

        }
        else{

            echo "Damage $damage will apply to $opponent->name\n";
            $opponent->setLife($opponent->getLife() - $damage);
            return $opponent->getLife();
        }

    }

}

//Inherit form parent class
class Hero extends Beast
{

    protected $inAttack;

    public function __construct($name)
    {

        $this->name = $name;
        $this->life = rand(0, 100);
        echo "$this->name has left $this->life points of life.\n";
        $this->power = rand(9, 100);
        echo "$this->name has left $this->power points of power.\n";
        $this->defense = rand(9, 100);
        echo "$this->name has left $this->defense points of defense.\n";
        $this->speedAttack = rand(9, 100);
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
    public function powerOfDragon($opponent)
    {
        $damage = $this->getPower() * 2 - $opponent->getDefense();
        if ($damage <= 0) {

            echo "This time i`ll hit you with double of my power, however you`ll get 0 damage points\n";
            return $opponent->getLife();
        } elseif ($damage >= 100) {

            echo "This time i`ll hit you with double of my power, it`s too much for you ? Just 100 points\n";
            $opponent->setLife(0);
            return 0;

        } else {

            echo "This time i`ll hit you with double of my power, meaning $damage points\n";
            $opponent->setLife($opponent->getLife() - $damage);
            return $opponent->getLife();
        }

    }

    //Generating the chance of getting special power
    public function chanceOfLuck($number)
    {

        return $number > rand(0, 100);

    }


    //Creating the special power for defending
    public function enchantedShield($opponent)
    {
        $damage = $opponent->getPower() / 2 - $this->getDefense();

        if ($damage <= 0 ) {

            echo "This time i`ll split your power attack in half, damaging me with 0 points\n";
            $this->setLife($this->getLife());
            return $this->getLife();

        } elseif ($damage >= 100 ) {

            echo "This time i`ll split your power attack in half, but you hit me hard. 100 points it`s too much\n";
            $this->setLife(0);
            return 0;

        } else {

            echo "This time i`ll split your power attack in half, damaging me with just $damage points\n";
            $this->setLife($this->getLife() - $damage);
            return $this->getLife();
        }

    }



    public function play($opponent, $chanceOfShield, $chanceOfPower){

        //Switching the roles then break
        switch ($this->getInAttack()) {
            case 0:
                echo "$opponent->name is attacking.\n";
                //Checking if is lucky enough to avoid the hit
                if ($this->getLucky())
                    echo "$this->name is getting lucky, no damage\n";

                //Also checking the possibility of having the enchanted Shield
                elseif ($this->chanceOfLuck($chanceOfShield)) {

                    echo "No luck, but still i get the shield\n";
                    $this->setLife(($this->enchantedShield($opponent)));

                } else {

                    //If there`s none, apply the normal damage
                    $this->setLife($opponent->isAttacking($this));
                    if ($this->stillHasLife()){
                        echo "Now $this->name has ";
                        echo $this->getLife();
                        echo " points of life \n";
                    } else
                        echo "$this->name is death\n";
                }
                $this->setInAttack(1);
                break;

            case 1:
                echo "$this->name is attacking.\n";

                //Checking if the opponent is lucky enough to avoid the hit
                if ($opponent->getLucky($opponent->getLuck()))
                    echo "$opponent->name is getting lucky, no damage\n";

                //Checking if $this is lucky enough to double up the attack power
                elseif ($this->chanceOfLuck($chanceOfPower)) {

                    echo "I have a special power. Now i will double my attacking power\n";
                    $opponent->setLife($this->powerOfDragon($opponent));

                } else {

                    //If there`s none, apply the normal damage
                    $opponent->setLife($this->isAttacking($opponent));
                    if ($opponent->stillHasLife()){
                        echo "Now $opponent->name has ";
                        echo $opponent->getLife();
                        echo " points of life \n";
                    } else
                        echo "$opponent->name is death\n";
                }
                $this->setInAttack(0);
                break;

        }


    }

    //Finding who is starting
    public function whoStarts($opponent)
    {

        if ($this->getSpeedAttack() > $opponent->getSpeedAttack() || ($this->getSpeedAttack() == $opponent->getSpeedAttack() && $this->getLuck() > $opponent->getLuck()))
            $this->setInAttack(1);
        else
            $this->setInAttack(0);

    }

    //Verify if the characters have reached the max no of rounds
    public function itIsDone($numberOfRounds, $numberOfRoundsToPlay, $opponent)
    {

        if ($numberOfRounds == $numberOfRoundsToPlay) {
            $remainLife = $this->getLife() - $opponent->getLife();
            echo "Maximum number of rounds was reached\n";
            if ($remainLife > 0)
                echo "$this->name has won.";
            elseif ($remainLife < 0) {
                echo "$opponent->name has won.";
            } else
                echo "It`s draw";
            return 1;
        }
        return 0;

    }
}
//Creating the instances of classes
$myHero = new Hero('Carl');
$theBeast = new Beast('Beast');

//Initiate the counting of rounds from 1
$numberOfRounds = 1;

//Let the user choose the number of rounds he would like
$numberOfRoundsToPlay = readline("How many rounds would you like?\n");

//Verify who is sett to start
$myHero->whoStarts($theBeast);

//Looping to every round
while($numberOfRounds <= $numberOfRoundsToPlay) {

    //Verifying if characters are death and announce the winner if it`s not the case
    if (!$theBeast->stillHasLife()) {

        echo "$myHero->name has won";
        $numberOfRounds = $numberOfRoundsToPlay;
        break;

    } elseif (!$myHero->stillHasLife()) {

        echo "$theBeast->name has won";
        $numberOfRounds = $numberOfRoundsToPlay;
        break;

    } else {

        //If they are still alive will continue fighting
        echo "Round no $numberOfRounds is starting.\n";
        $myHero->play($theBeast,20 ,10);
    }

    //Here is verified if there are rounds to play, and if not, which is the winner
    if ($myHero->itIsDone($numberOfRounds, $numberOfRoundsToPlay, $theBeast))
        $numberOfRounds = +$numberOfRoundsToPlay;

    //Moving on to the next round
    $numberOfRounds++;

}





