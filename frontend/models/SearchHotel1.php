<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Ticket;

/**
 * SearchTicket represents the model behind the search form of `frontend\models\Ticket`.
 */
class SearchHotel extends Ticket
{
    public $country_id;
    public $location_id;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'person', 'date', 'days', 'pitanie', 'hotel_id', 'hot'], 'integer'],
            [['country_id', 'location_id'], 'integer', 'min' => 1],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    /*public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }*/

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Ticket::find()->with(['hotel', 'hotel.images', 'hotel.raitings']);//, 'hotel.location0.country']);
        $query->joinWith(['hotel.location0']);
        $query->joinWith(['hotel.location0.country']);
          //->where(['hot' => 1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => [
                    'date' => SORT_DESC
                ]
            ],            
        ]);

        $this->load($params);
        /*echo "\r\nL = ".$this->load($params);
        echo "\r\nV = ".$this->validate();
        echo "\r\n";
          print_r($params);
          print_r($this->getErrors());
          echo "H = ".$this->hot."\r\n";
        echo "\r\n";*/

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'person' => $this->person,
            'date' => $this->date,
            'days' => $this->days,
            'pitanie' => $this->pitanie,
            'price' => $this->price,
            'hotel_id' => $this->hotel_id,
            'hot' => $this->hot,
            '{{%location}}.country_id' => $this->country_id,
            '{{%location}}.id' => $this->location_id,
        ]);

        return $dataProvider;
    }
}
