<?php
/**
 * This view is used by console/controllers/NotificationController.php
 * The following variables are available in this view:
 */
/* @var $name string the new notification class name
 * @var $namespace string the new notification namespace
 */

echo "<?php\n";
?>

namespace <?=$namespace?>;

class <?=$name?> extends BaseNotification
{
    public function notify()
    {
        // TODO: Implement notify() method.
    }
}
