<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CoraltravelHotel;

/**
 * SearchHotel represents the model behind the search form of `backend\models\CoraltravelHotel`.
 */
class SearchHotel extends CoraltravelHotel
{
    public $country;
    public $category;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Place', 'HotelCategory', 'GiataCode', 'OperatorSaleCategory', 'tripAdvisorCommentCount', 'disableOnB2C', 'dontShowTripAdvisorComments', 'CountryID', 'country', 'category'], 'integer'],
            [['Name', 'Address', 'Web', 'TripAdvisorCode', 'Phone1', 'Phone2', 'Fax1', 'Fax2', 'CommercialName', 'TaxOffice', 'TaxNumber', 'invoiceAddress', 'email', 'tripAdvisorImage', 'cancelStatusWeb'], 'safe'],
            [['Latitude', 'Longitude', 'tripAdvisorPoint'], 'number'],
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
        $query = CoraltravelHotel::find()
        ->with(['place.area.region.country'])
        ->joinWith(['place.area.region.country']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            '{{%coraltravel_hotel}}.ID' => $this->ID,
            //'Place' => $this->Place,
            'HotelCategory' => $this->category,
            'Latitude' => $this->Latitude,
            'Longitude' => $this->Longitude,
            'GiataCode' => $this->GiataCode,
            'OperatorSaleCategory' => $this->OperatorSaleCategory,
            'tripAdvisorPoint' => $this->tripAdvisorPoint,
            'tripAdvisorCommentCount' => $this->tripAdvisorCommentCount,
            'disableOnB2C' => $this->disableOnB2C,
            'dontShowTripAdvisorComments' => $this->dontShowTripAdvisorComments,
            'CountryID' => $this->CountryID,
        ]);

        $query->andFilterWhere(['{{%coraltravel_country}}.ID' => $this->country]);
        $query->andFilterWhere(['like', '{{%coraltravel_hotel}}.Name', $this->Name])
            ->andFilterWhere(['like', 'Address', $this->Address])
            ->andFilterWhere(['like', 'Web', $this->Web])
            ->andFilterWhere(['like', 'TripAdvisorCode', $this->TripAdvisorCode])
            ->andFilterWhere(['like', 'Phone1', $this->Phone1])
            ->andFilterWhere(['like', 'Phone2', $this->Phone2])
            ->andFilterWhere(['like', 'Fax1', $this->Fax1])
            ->andFilterWhere(['like', 'Fax2', $this->Fax2])
            ->andFilterWhere(['like', 'CommercialName', $this->CommercialName])
            ->andFilterWhere(['like', 'TaxOffice', $this->TaxOffice])
            ->andFilterWhere(['like', 'TaxNumber', $this->TaxNumber])
            ->andFilterWhere(['like', 'invoiceAddress', $this->invoiceAddress])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'tripAdvisorImage', $this->tripAdvisorImage])
            ->andFilterWhere(['like', 'cancelStatusWeb', $this->cancelStatusWeb]);

        return $dataProvider;
    }
}
