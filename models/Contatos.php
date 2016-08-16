<?php

namespace app\models;

use Yii;
use webvimark\modules\UserManagement\models;
/**
 * This is the model class for table "contatos".
 *
 * @property integer $id
 * @property string $nome
 * @property integer $telefone
 * @property integer $fk_user
 *
 * @property User $fkUser
 * @property ManyGrupos[] $manyGrupos 
 */
class Contatos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contatos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['telefone', 'fk_user'], 'required'],
            [['telefone', 'fk_user'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            //[['fk_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fk_user' => 'id']],
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
            'telefone' => 'Telefone',
            'fk_user' => 'Fk User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkUser()
    {
        return $this->hasOne(User::className(), ['id' => 'fk_user']);
    }


   /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getManyGrupos() 
   { 
       return $this->hasMany(ManyGrupos::className(), ['fk_contato' => 'id']); 
   } 
}
