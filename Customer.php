<?php

class Customer {

    private $user_id;
    private $name;
    private $latitude;
    private $longitude;

    public function populate($data)
    {
        $this->validate($data);

        $this->setUserId($data->user_id)
             ->setName($data->name)
             ->setLatitude($data->latitude)
             ->setLongitude($data->longitude);
        return $this;
    }

    public function validate($data)
    {
        if (!is_object($data)
            ||  !array_map(
                    function ($attribute) {
                        return isset($data->$attribute);
                    },
                    ['user_id', 'name', 'latitude', 'longitude']
                )
        ) {
            throw new InvalidArgumentException(
                'Parameters user_id, name, latitude, longitade are necessary to populate a customer'
            );
        }
    }

    public function isNear($km, $latitude, $longitude)
    {
        $distance = GreatCircle::distance($latitude, $longitude, $this->getLatitude(), $this->getLongitude(), "KM");
        return $distance <= $km;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     *
     * @return self
     */
    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     *
     * @return self
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     *
     * @return self
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }
}