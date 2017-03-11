<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $confirmed_at
 * @property string $unconfirmed_email
 * @property integer $blocked_at
 * @property string $registration_ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $last_login_at
 * @property integer $status
 * @property string $password_reset_token
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificada
 * @property string $Fecha_Eliminada
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Ultima_Sesion
 * @property string $password_repeat
 * @property integer $Codigo_Rol
 * @property string $pwdDes
 * @property integer $estado
 */
class Usuario extends \yii\db\ActiveRecord
{

    public $password_repeat;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash','password_repeat'], 'required'],

            [['id', 'confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'last_login_at', 'status', 'Codigo_Rol', 'estado'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificada', 'Fecha_Eliminada', 'Ultima_Sesion'], 'safe'],
            [['username', 'email', 'password_hash', 'unconfirmed_email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['password_reset_token'], 'string', 'max' => 256],
            [['Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'pwdDes'], 'string', 'max' => 250],

            ['username', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 caracteres del Nombre del Usuario'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato de correo no válido'],
            ['password_hash', 'match', 'pattern' => "/^.{6,255}$/", 'message' => 'Mínimo 6 caracteres para la contraseña'],
            ['password_repeat', 'match', 'pattern' => "/^.{6,255}$/", 'message' => 'Mínimo 6 caracteres para la contraseña'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password_hash', 'message' => 'Las contraseñas no coinciden.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Contraseña',
            'password_repeat' => 'Repetir Contraseña',
            'auth_key' => 'Auth Key',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'last_login_at' => 'Last Login At',
            'status' => 'Status',
            'password_reset_token' => 'Password Reset Token',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificada' => 'Fecha  Modificada',
            'Fecha_Eliminada' => 'Fecha  Eliminada',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Ultima_Sesion' => 'Ultima  Sesion',
            'Codigo_Rol' => 'Codigo  Rol',
            'pwdDes' => 'Pwd Des',
            'estado' => 'Estado',
        ];
    }

    public function ActualizarPass($Codigo, $PassDes, $PassEncryt, $Fecha_Modi, $Usu_Modi)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand("UPDATE user SET 
                            password_hash = '" . $PassEncryt . "',
                            Usuario_Modificado = '" . $Usu_Modi . "',
                            Fecha_Modificada = '" . $Fecha_Modi . "',
                            pwdDes = '" . $PassDes . "'
                            WHERE id = '" . $Codigo . "';")->execute();
        $transaction->commit();

    }
}
