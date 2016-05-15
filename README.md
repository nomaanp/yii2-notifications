# yii2-notifications

Put this code to httpd.conf to enable pretty url for Apache

    DocumentRoot path/to/web

    <Directory "path/to/web">
        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php
    </Directory>