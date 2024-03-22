<div class="lockscreen-wrapper">
    <div class="lockscreen-logo text-white">
        <b>DTechnology</b><br>
        <?php echo $_SESSION['hospitalname'] ?>
    </div>
    <h3 class="text-white text-center">Hai, <?php echo $this->session->userdata('name');?></h3>
    <br>
    <div class="lockscreen-item">
        <div class="lockscreen-image">
            <?php
                if($_SESSION['imgprofile']==="Y"){
                    echo "<img src='".base_url().$_SESSION['fotoprofile']."' class='img-circle elevation-2'>";
                }else{
                    echo "<div class='user-profile-lockscreen'><div class='user-initial-lockscreen'>".$_SESSION['initialuser']."</div></div>";
                }
            ?>
        </div>
        <form method="post" id="formlogin" class="lockscreen-credentials" action="<?php echo base_url();?>index.php/auth/login/loginsystem">
            <input type="hidden" name="username" value="<?php echo $this->session->userdata('username');?>">
            <div class="input-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="password" required>
                <div class="input-group-append">
                    <input type="submit" class="btn btn-danger" style="background:green;" value="LOGIN">
                </div>
            </div>
        </form>
    </div>

    <div>
        <div class="help-block text-center text-white">
            Enter your password to retrieve your session
        </div>
        <div class="text-center">
            <a class="text-white" href="<?php echo base_url();?>index.php/login">Or sign in as a different user</a>
        </div>
        <div class="lockscreen-footer text-center text-white">
            Copyright &copy; 2020 <b>DTechnology</b>
            <br>
            All rights reserved
        </div>
    </div>
</div>