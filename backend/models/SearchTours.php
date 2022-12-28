<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Tours;

/**
 * SearchTours represents the model behind the search form of `backend\models\Tours`.
 */
class SearchTours extends Tours
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'FlightDate', 'HotelCheckInDate', 'AreaID', 'PlaceID', 'PackageNight', 'HotelID', 'HotelCategoryID', 'MealID', 'RoomID', 'AccID', 'Adult', 'Child', 'FlightAllotmentStatus', 'BackFlightAllotmentStatus', 'HotelAllotmentStatus', 'HotelStopSaleStatus', 'ToCountryID', 'SeatClassID', 'SaleStatus', 'EarlyBookingEndDate', 'BusinessFlightAllotmentStatus', 'BusinessBackFlightAllotmentStatus', 'HotelNight', 'PromotionStatus', 'main', 'created_at'], 'integer'],
            [['PackagePrice', 'PackagePriceOld'], 'number'],
            [['ChildAges', 'AirportRoute', 'EarlyBookingText', 'FlightLeftAllotmentText', 'BackFlightLeftAllotmentText', 'B2BUrl', 'B2CUrl'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tours::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ],
            /*'pagination' => [
                'params' => [
                    'data-pjax' => 0,
                ],
            ],*/
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        /*$query->andFilterWhere([
            'id' => $this->id,
            'FlightDate' => $this->FlightDate,
            'HotelCheckInDate' => $this->HotelCheckInDate,
            'AreaID' => $this->AreaID,
            'PlaceID' => $this->PlaceID,
            'PackageNight' => $this->PackageNight,
            'HotelID' => $this->HotelID,
            'HotelCategoryID' => $this->HotelCategoryID,
            'MealID' => $this->MealID,
            'RoomID' => $this->RoomID,
            'AccID' => $this->AccID,
            'Adult' => $this->Adult,
            'Child' => $this->Child,
            'PackagePrice' => $this->PackagePrice,
            'FlightAllotmentStatus' => $this->FlightAllotmentStatus,
            'BackFlightAllotmentStatus' => $this->BackFlightAllotmentStatus,
            'HotelAllotmentStatus' => $this->HotelAllotmentStatus,
            'HotelStopSaleStatus' => $this->HotelStopSaleStatus,
            'ToCountryID' => $this->ToCountryID,
            'SeatClassID' => $this->SeatClassID,
            'SaleStatus' => $this->SaleStatus,
            'PackagePriceOld' => $this->PackagePriceOld,
            'EarlyBookingEndDate' => $this->EarlyBookingEndDate,
            'BusinessFlightAllotmentStatus' => $this->BusinessFlightAllotmentStatus,
            'BusinessBackFlightAllotmentStatus' => $this->BusinessBackFlightAllotmentStatus,
            'HotelNight' => $this->HotelNight,
            'PromotionStatus' => $this->PromotionStatus,
            'main' => $this->main,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'ChildAges', $this->ChildAges])
            ->andFilterWhere(['like', 'AirportRoute', $this->AirportRoute])
            ->andFilterWhere(['like', 'EarlyBookingText', $this->EarlyBookingText])
            ->andFilterWhere(['like', 'FlightLeftAllotmentText', $this->FlightLeftAllotmentText])
            ->andFilterWhere(['like', 'BackFlightLeftAllotmentText', $this->BackFlightLeftAllotmentText])
            ->andFilterWhere(['like', 'B2BUrl', $this->B2BUrl])
            ->andFilterWhere(['like', 'B2CUrl', $this->B2CUrl]);*/

        return $dataProvider;
    }
}
