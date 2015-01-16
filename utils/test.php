<?php
$str = 'ApDpr4KzzyWKvCXVx7EDM5SEDp8WlqIc,Ae9G0ZxJxwrhH7KRkaog2Kxlq1msC9jZ,AV0YHNSSAQe6fce8UWZpOLjOZ1o9DULB,AXDpjY5xiWzs46SvMz4GWZzNPqq0w7YX,AjSzFAhIeLMnZCtkCeT2zoi08SNjc5s3,AqrzJZSqPpDeJXwYOB7YUJIBefVbQtf0,AsGfGY4WaNxIZU4texxoo2rklLtwJU9f,A2m2GMPekZAkaqtt4sIXFhDJBRINLp68,AotH54VldBgRmg86zZdG00LdPhBANv61,AEUeUpeCE9DtX4F75CE7PngRQs1Ujwpf,AhsaFLQqJc9PVJiRqRr41WuyPtNb2A4P,ARX6MXRdzIYQH0AL59IC3sTkCMJ2FZxz,AR3lRj3Bq1nobj8WAGLDaHE3R57Mn11y,AYlkEirnTTgCpuJc0pnkM3UfvWVUiJ9i,A20KCSmxfx6byDBnBoB4abS2iBYjF7dT,AZSOHUr4yjZN8BpnsxINfsf6Opqi8Xcm,AaZZrGxtCkfqfnJtg2Be2PO7OSlQRbEp,AA1BKAEvT5aFNP9pZRgEeBZ1iZEUer2u,A8zQFXsT1WzpOBk2yNyZrSpE00By8qqn,ACgH7XlZHccqeOwy2fq5QRf5DS0hgygJ';

$arr = explode(',', $str);

print_r($arr);

print_r(array_flip($arr));
echo "\r\n" . join(',', $arr);

echo "\r\n" . microtime();
echo "\r\n" . microtime();