<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a id="logo" class="navbar-brand" href="http://sebastian1012.bplaced.net/homepage-neu/"></a>
        </div>
        <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-center">
                    <li<?php if(isset($index_page)){ echo " class='active'";} ?>>
                        <a href="index.php">
                            <span class="glyphicon glyphicon-home"></span><?php echo $language['navigation_home']; ?></a>
                    </li>
            <?php
            if(isset($admin_logged_in) AND $admin_logged_in==true){
            ?>
                    <li<?php if(isset($admin2_page)){ echo " class='active'";} ?>>
                        <a href="admin_system.php">
                            <span class="glyphicon glyphicon-wrench"></span><?php echo $language['admin_link']; ?></a>
                    </li>
                    <li<?php if(isset($admin1_page)){ echo " class='active'";} ?>>
                        <a href="admin-user.php">
                            <span class="glyphicon glyphicon-cog"></span> <?php echo $language['user_admin_work']; ?></a>             
                    </li>
            <?php  } else{
             if(isset($you_logged_in) AND $you_logged_in==true){ 
            ?>
                    <li<?php if(isset($admin2_page)){ echo " class='active'";} ?>>
                        <a href="admin_system.php">
                            <span class="glyphicon glyphicon-wrench"></span><?php echo $language['admin_not_login_link']; ?></a>
                    </li>
            <?php
             }
            }
            ?>
            <?php  
            if(isset($you_logged_in) AND $you_logged_in==true){ 
             
            if($login_time_active==true){
            ?>
            <li id="clock_to_end">
                     <a title="<?php echo $language['reset_time_to_click']; ?>" href="javascript:location.reload()">
                            <span class="glyphicon glyphicon-time" id='resttime'></span></a>
            </li>
            <?php
                if(isset($resttime)){
                    echo $resttime;
                }
            }
            ?>
                    <li<?php if(isset($profil_page)){ echo " class='active'";} ?>>
                        <a href="profil.php">
                            <span class="glyphicon glyphicon-user"></span><?php echo $language['work_profil']; ?></a>
                    </li>
                    <li<?php if(isset($delete_page)){ echo " class='active'";} ?>>
                        <a href="delete.php?delete">
                            <span class="glyphicon glyphicon-remove"></span><?php echo $language['_go_to_kill']; ?></a>
                    </li>
                    <li<?php if(isset($logout_page)){ echo " class='active'";} ?>> 
                        <a href="logout.php?logout">
                            <span class="glyphicon glyphicon-log-out"></span><?php echo $language['logout']; ?></a>
                    </li>
 
                   <li<?php if(isset($geheime_page)){ echo " class='active'";} ?>>
                        <a href="<?php echo $nach_login; ?>">
                            <span class="glyphicon glyphicon-link"></span><?php echo $nach_login_text; ?></a>
                    </li>
            <?php 
 
            }else{  ?>
                    <li<?php if(isset($index_page)){ echo " class='active'";} ?>>
                        <a href="index.php">
                            <span class="glyphicon glyphicon-log-in"></span><?php echo $language['link_login']; ?></a>
                    </li>
                    <li<?php if(isset($register_page)){ echo " class='active'";} ?>>
                        <a href="register.php">
                            <span class="glyphicon glyphicon-check"></span><?php echo $language['no_accound']; ?></a>
                    </li>
 
                    <li<?php if(isset($passwordreset)){ echo " class='active'";} ?>>
                        <a href="passwordreset.php">
                            <span class="glyphicon glyphicon-log-out"></span><?php echo $language['pw_forgotten']; ?></a>
                    </li>
 
                    <?php   }  ?>
                    
                         <?php  
             if(isset($you_logged_in) AND $you_logged_in==true){        
             }else{
     
                       if(isset($admin_logged_in) AND $admin_logged_in==true){ 
                    ?>
                        <li<?php if(isset($logout_page_admin)){ echo " class='active'";} ?>> 
                           <a href="logout.php?logout">
                              <span class="glyphicon glyphicon-log-out"></span><?php echo $language['admin_logout']; ?></a>
                        </li>
                    <?php
                    }
             }                    
                    ?>
            </ul>
        </div>
    </div>
</div>