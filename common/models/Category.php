<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_at
 *
 * @property Post[] $posts
 */
class Category extends \yii\db\ActiveRecord
{
    CONST PHP=1;
    CONST PYTHON=2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'name'], 'required'],
            [['pid'], 'integer'],
            [['name', 'created_at'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => '属于',
            'name' => 'Name',
            'created_at' => 'Created At',
        ];
    }

/**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['category_id' => 'id'])->inverseOf('category');
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->created_at = time();
            }
            else
            {
                $this->created_at = time();
            }

            return true;

        }
        else
        {
            return false;
        }
    }

    public function getTree()
    {
        $rows=self::find()->asArray()->all();
        $tree=self::Tree($rows,0,0);
        return $tree;

    }

    public function Tree($rows=[],$pid=0,$level=0)
    {
        static $tree=[];

        foreach($rows as $row){
            if($pid==$row['pid']){
                $row['level']=$level;
                $row['names']=str_repeat('　', $row['level']).$row['name'];
                $tree[]=$row;
                self::Tree($rows,$row['id'],$level+1);
            }
        }
        return $tree;
    }
}
