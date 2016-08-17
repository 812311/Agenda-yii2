<?php

namespace app\models;

use Yii;
use webvimark\modules\UserManagement\models;
/**
 * This is the model class for table "grupos".
 *
 * @property integer $id
 * @property string $nome
 * @property integer $fk_grupouser
 *
 * @property User $fkGrupouser
 * @property ManyGrupos[] $manyGrupos
 */
class Grupos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['fk_grupouser'], 'integer'],
            [['nome'], 'string', 'max' => 255],
           // [['fk_grupouser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fk_grupouser' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'fk_grupouser' => 'Fk Grupouser',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManyGrupos()
    {
        return $this->hasMany(ManyGrupos::className(), ['fk_manygrupos' => 'id']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkGrupouser()
    {
        return $this->hasOne(User::className(), ['id' => 'fk_grupouser']);
    }

}
