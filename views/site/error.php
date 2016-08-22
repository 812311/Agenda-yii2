<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1> <?=Html::encode($name)?>
     </h1>
    
    <div class="alert alert-danger">
        <?php 
            if (substr_count((string)$name, 'Integrity constraint violation') > 0) {
                
                echo "<b>
                        Check if there is any Contact with this Group, 
                        remove the contact from the group and try delete the Group again.
                     </b>";
            
            }else{
               echo "<p>
                        The above error occurred while the Web server was processing your request.
                    </p>
                    <p>
                        Please contact us if you think this is a server error. Thank you.
                    </p>";
                    nl2br(Html::encode($message));
            }     
        ?>
       
    </div>

    

</div>
