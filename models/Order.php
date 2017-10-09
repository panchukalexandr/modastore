<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Exception;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $qty
 * @property double $sum
 * @property string $status
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 */
class Order extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['qty'], 'integer'],
            [['sum'], 'number'],
            [['status'], 'boolean'],
            [['name', 'email', 'phone'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
                ], // метка времени
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
            ]
        ];
    }


    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
//            'id' => 'ID',
//            'created_at' => 'Created At',
//            'updated_at' => 'Updated At',
//            'qty' => 'Qty',
//            'sum' => 'Sum',
//            'status' => 'Status',
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
//            'address' => 'Адресс',
        ];
    }
}
