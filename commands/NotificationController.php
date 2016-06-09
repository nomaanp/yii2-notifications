<?php
namespace app\commands;

use app\models\notifications\BaseNotification;
use app\models\notifications\NotificationType;
use Yii;
use yii\base\Exception;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;
use yii\helpers\VarDumper;

class NotificationController extends Controller
{

    /**
     * @var string the directory storing the notification classes. This can be either
     * a path alias or a directory.
     */
    public $notificationPath = '@app/models/notifications';

    /**
     * @var string the template file for generating new notifications.
     * This can be either a path alias (e.g. "@app/migrations/template.php")
     * or a file path.
     */
    public $templateFile = '@app/views/notification-type/template.php';

    /**
     * This method is invoked right before an action.
     * It checks the existence of the [[notificationPath]].
     * @param \yii\base\Action $action the action to be executed.
     * @throws Exception if directory specified in migrationPath doesn't exist and action isn't "create".
     * @return boolean whether the action should continue to be executed.
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $path = Yii::getAlias($this->notificationPath);
            if (!is_dir($path)) {
                FileHelper::createDirectory($path);
            }
            $this->notificationPath = $path;
            return true;
        } else {
            return false;
        }
    }

    public function actionCreate($name)
    {
        $className = Inflector::camelize($name);
        if (!preg_match('/^\w+$/', $name)) {
            throw new \Exception('The notification type name should contain letters, digits and/or underscore characters only.');
        }
        $file = $this->notificationPath . DIRECTORY_SEPARATOR . $className . '.php';
        if (file_exists($file)) {
            $this->stdout("File $file already exists. Please choose another name\n", Console::FG_RED);
            return;
        }
        if ($this->confirm("Create new notification '$file'?")) {
            $content = $this->generateSourceCode([
                'name' => $className,
                'namespace' => BaseNotification::getNamespace(),
            ]);
            file_put_contents($file, $content);

            $model = new NotificationType();

            $model->title = $name;
            $model->class = BaseNotification::getNamespace() . '\\' . $className;
            if ($model->save())
            {
                $this->stdout("New notification type created successfully.\n", Console::FG_GREEN);
            } else
            {
                $this->stdout("Error during new notification type creation.\n", Console::FG_RED);
                VarDumper::dump($model->getErrors());
            }
        }
    }

    protected function generateSourceCode($params)
    {
        return $this->renderFile(Yii::getAlias($this->templateFile), $params);
    }
}