<div class="login-page">
    <div class="context">
        <div class="login-box">
            <div class="screen animate__animated animate__zoomIn">
                <div class="screen__content">
                    <form class="login" action="<?php echo base_url();?>index.php/auth/login/loginsystem" id="formlogin" method="post">
                        <h5><strong>SINGLE SIGN ON</strong></h5>
                        <h5><strong>DTechnology</strong></h5>
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>
                            <input type="text" name="username" id="username" class="login__input" placeholder="User name">
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <input type="password" name="password" class="login__input" placeholder="Password">
                        </div>
                        <button id="btn-auth" name="btn-auth" class="button login__submit">
                            <span class="button__text">SIGN <i class="button__icon fas fa-chevron-right"></i></span>
                        </button>				
                    </form>
                </div>
                <div class="screen__background">
                    <span class="screen__background__shape screen__background__shape4"></span>
                    <span class="screen__background__shape screen__background__shape3"></span>		
                    <span class="screen__background__shape screen__background__shape2"></span>
                    <span class="screen__background__shape screen__background__shape1"></span>
                </div>		
            </div>
        </div>
    </div>
</div>