<?php

namespace backend\modules\borrowreturn\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\borrowreturn\models\Borrowreturn;

/**
 * BorrowreturnSearch represents the model behind the search form about `backend\modules\borrowreturn\models\Borrowreturn`.
 */
class BorrowreturnSearch extends Borrowreturn
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
            [['booking_id', 'confirm_status', 'confirm_staff_id', 'deliver_status', 'deliver_staff_id', 'return_status', 'return_staff_id'], 'integer'],
            [['confirm_comment', 'confirm_at', 'deliver_at', 'return_loss', 'return_because', 'return_at', 'entry_note'], 'safe'],
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
        $query = Borrowreturn::find();

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
            'booking_id' => $this->booking_id,
            'confirm_status' => $this->confirm_status,
            'confirm_staff_id' => $this->confirm_staff_id,
            'confirm_at' => $this->confirm_at,
            'deliver_status' => $this->deliver_status,
            'deliver_staff_id' => $this->deliver_staff_id,
            'deliver_at' => $this->deliver_at,
            'return_status' => $this->return_status,
            'return_staff_id' => $this->return_staff_id,
            'return_at' => $this->return_at,
        ]);

        $query->andFilterWhere(['like', 'confirm_comment', $this->confirm_comment])
            ->andFilterWhere(['like', 'return_loss', $this->return_loss])
            ->andFilterWhere(['like', 'return_because', $this->return_because])
            ->andFilterWhere(['like', 'entry_note', $this->entry_note]);

        return $dataProvider;
    }
}
