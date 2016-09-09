<?php

namespace backend\modules\borrowreturn\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\borrowreturn\models\Booking;

/**
 * BookingSearch represents the model behind the search form about `backend\modules\borrowreturn\models\Booking`.
 */
class BookingSearch extends Booking
{
    /**
     * @inheritdoc
     */
	  
	 /* adzpire gridview relation sort-filter
		public $weu;
		public $wecr;
	 
		add rule
		[['weu', 'wecr'], 'safe'],

		in function search()  //weU = wasterecycle_user userPro = user_profile
		$query->joinWith(['weU', 'weCr.userPro']); // weCr.userPro - 2layer relation
		$dataProvider->sort->attributes['weu'] = [
			'asc' => ['wasterecycle_user.wu_name' => SORT_ASC],
			'desc' => ['wasterecycle_user.wu_name' => SORT_DESC],
		];
		$dataProvider->sort->attributes['wecr'] = [
			'asc' => ['user_profile.firstname' => SORT_ASC],
			'desc' => ['user_profile.firstname' => SORT_DESC],
		];
		//add grid filter condition ->orFilterWhere for search wu_name or wu_lastname
		->andFilterWhere(['like', 'wasterecycle_user.wu_name', $this->weu])
		->orFilterWhere(['like', 'wasterecycle_user.wu_lastname', $this->weu])
		->andFilterWhere(['like', 'user_profile.firstname', $this->wecr])
		->orFilterWhere(['like', 'user_profile.lastname', $this->wecr]);
        
	 */
    public function rules()
    {
        return [
            [['id', 'entry_status', 'user_id', 'belongto_id', 'position_id', 'isin_university'], 'integer'],
            [['booking_at', 'purpose', 'university_place', 'acquire_at', 'return_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Booking::find();

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
            'id' => $this->id,
            'entry_status' => $this->entry_status,
            'booking_at' => $this->booking_at,
            'user_id' => $this->user_id,
            'belongto_id' => $this->belongto_id,
            'position_id' => $this->position_id,
            'isin_university' => $this->isin_university,
            'acquire_at' => $this->acquire_at,
            'return_at' => $this->return_at,
        ]);

        $query->andFilterWhere(['like', 'purpose', $this->purpose])
            ->andFilterWhere(['like', 'university_place', $this->university_place]);

        return $dataProvider;
    }
}
