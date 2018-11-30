<?php
class Personnage
{
    private $_force ;
    private $_localisation;
    private $_experience;
    private $_degats;
    private $_textADire;

    const FORCE_PETITE = 20 ;
    const FORCE_MOYENNE = 50 ;
    const FORCE_GRANDE = 80 ;

    public function __construct($forceInitial)
    {
        //echo 'Voici le constructeur ! <br />';
        $this->setForce($forceInitial);
    }

    public function deplacer()
    {
       return $this->_localisation;
    }

    public function setDeplacement($localisation)
    {
        $this->_localisation = $localisation;
    }

    public function frapper(Personnage $persoAFrapper)
    {
        $persoAFrapper->_degats += $this->_force;
    }

    public function afficherExperience()
    {
        echo $this->_experience;
    }

    public function gagnerExperience()
    {
        $this->_experience++;
    }

    public function setForce($force)
    {
        if (!is_int($force))
        {
            trigger_error('La force d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }
        if ($force > 100)
        {
            trigger_error('La force d\'un personnage ne peut dépasser 100', E_USER_WARNING);
            return;
        }
        if (in_array($force, [self::FORCE_PETITE, self::FORCE_MOYENNE, self::FORCE_GRANDE]))
        {
        $this->_force = $force;
        }
    }

    public function setExperience($experience)
    {
        if (!is_int($experience))
        {
            trigger_error('L\'expérience d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }
        if ($experience > 100)
        {
            trigger_error('L\'expérience d\'un personnage ne peur dépasser 100', E_USER_WARNING);
            return;
        }
        $this->experience = $experience;
    }

    public function degats()
    {
        return $this->_degats;
    }

    public function setDegats($degats)
    {
        if (!is_int($degats))
        {
            trigger_error('Le niveau de dégâts d\'un personnage dout être un nombre entier', E_USER_WARNING);
            return;
        }
        $this->degats = $degats;
    }

    public function force()
    {
        return $this->_force;
    }

    public function experience()
    {
        return $this->_experience;
    }

    public static function parler()
    {
        echo 'Je suis un personnage !';
        echo self::$_textADire;
    }
}

$perso1 = new Personnage(60);
$perso2 = new Personnage(100);


$perso1->setForce(10);
$perso1->setExperience(2);

$perso2->setForce(90);
$perso2->setExperience(58);

$perso1->frapper($perso2);
$perso1->gagnerExperience();

$perso2->frapper($perso1);
$perso2->gagnerExperience();

$perso1->deplacer();

echo 'Le personnage 1 a ', $perso1->force(), ' de force, contrairement au personnage 2 qui a ',
    $perso2->force(),' de force.<br />';
echo 'Le personnage 1 a ', $perso1->experience(), ' d\'expérience, contrairement au personnage 2 qui a ',
    $perso2->experience(), ' d\'expérience. <br />';
echo 'Le personnage 1 a ', $perso2->degats(), ' de dégâts, contrairement au personnage 2 qui a ',
    $perso2->degats(), ' de dégâts. <br />';
//if ( $perso1->experience() == 2){
//    echo 'Tu peux te déplacer jusqu\'à ', $perso1->deplacer(), '.';
//}else{
//    echo 'Bad move ! Retour à la case prison ! ';
//}
