<?php

namespace app\models;

use Yii;
use webvimark\modules\UserManagement\models;
/**
 * This is the model class for table "many_grupos".
 *
 * @property integer $id
 * @property integer $fk_contato
 * @property integer $fk_manygrupos
 *
 * @property Contatos $fkContato
 * @property Grupos $fkManygrupos
 */
class ManyGrupos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'many_grupos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_contato', 'fk_manygrupos'], 'required'],
            [['id', 'fk_contato', 'fk_manygrupos'], 'integer'],
           // [['fk_contato'], 'exist', 'skipOnError' => true, 'targetClass' => Contatos::className(), 'targetAttribute' => ['fk_contato' => 'id']],
           // [['fk_manygrupos'], 'exist', 'skipOnError' => true, 'targetClass' => Grupos::className(), 'targetAttribute' => ['fk_manygrupos' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_contato' => 'Fk Contato',
            'fk_manygrupos' => 'Fk Manygrupos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkContato()
    {
        return $this->hasOne(Contatos::className(), ['id' => 'fk_contato']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkManygrupos()
    {
        return $this->hasOne(Grupos::className(), ['id' => 'fk_manygrupos']);
    }
}
