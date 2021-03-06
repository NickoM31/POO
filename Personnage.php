<?php

abstract class Personnage
{
    protected $atout,
        $degats,
        $id,
        $nom,
        $timeEndormi,
        $type;

    const CEST_MOI = 1;
    const PERSONNAGE_TUE = 2;
    const PERSONNAGE_FRAPPE = 3;
    const PERSONNAGE_ENSORCELE = 4;
    const PAS_DE_MAGIE = 5;
    const PERSO_ENDORMI = 6;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
        $this->type = strtolower(static::class);
    }

    public function estEndormi()
    {
        return $this->timeEndormi > time();
    }

    public function frapper(Personnage $perso)
    {
        if ($perso->id == $this->id)
        {
            return self::CEST_MOI;
        }

        if ($this->estEndormi())
        {
            return self::PERSO_ENDORMI;
        }

        return $perso->recevoirDegats();
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function nomValide()
    {
        return !empty($this->nom);
    }

    public function recevoirDegats()
    {
        $this->degats += 5;

        if ($this->degats >= 100)
        {
            return self::PERSONNAGE_TUE;
        }

        return self::PERSONNAGE_FRAPPE;
    }

    public function reveil()
    {
        $secondes = $this->timeEndormi;
        $secondes -= time();

        $heures = floor($secondes / 3600);

        $secondes -= $heures * 3600;

        $minutes = floor($secondes / 60);

        $secondes -= $minutes * 60;

        $heures .= $heures <= 1 ? ' heure' : ' heures';

        $minutes .= $minutes <= 1 ? ' minute' : ' minutes';

        $secondes .= $secondes <= 1 ? ' seconde' : ' secondes';

        return $heures . ', ' . $minutes . ' et ' . $secondes;
    }

    public function atout()
    {
        return $this->atout;
    }

    public function degats()
    {
        return $this->degats;
    }

    public function id()
    {
        return $this->id;
    }

    public function nom()
    {
        return $this->nom;
    }

    public function timeEndormi()
    {
        return $this->timeEndormi;
    }

    public function type()
    {
        return $this->type;
    }

    public function setAtout($atout)
    {
        $atout = (int) $atout;

        if ($atout >= 0 && $atout <= 100)
        {
            $this->atout = $atout;
        }
    }

    public function setDegats($degats)
    {
        $degats = (int) $degats;

        if ($degats >= 0 && $degats <= 100)
        {
            $this->degats = $degats;
        }
    }

    public function setId($id)
    {
        $id = (int) $id;

        if ($id > 0)
        {
            $this->id = $id;
        }
    }

    public function setNom($nom)
    {
        if (is_string($nom))
        {
            $this->nom = $nom;
        }
    }

    public function setTimeEndormi($time)
    {
        $this->timeEndormi = (int) $time;
    }
    }