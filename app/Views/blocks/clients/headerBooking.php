<div class="header" style="border-bottom: 1px solid rgba(0,0,0,.1);">
    <div class="logo">
        <img src="https://baosonparadise.vn/Uploads/images/logo.png" alt="">
    </div>
    <div class="right-section">
        <div class="contact-info">
            <span>Hotline: 0565 097 603</span>
        </div>
        <div class="social-media">
            <a href="https://www.facebook.com/congvienthienduongbaoson/">
                <img src="https://th.bing.com/th/id/R.2bad70f2d08429a28dfbebd4c237924b?rik=vgEdhJ%2f%2biiEnQQ&riu=http%3a%2f%2fpngimg.com%2fuploads%2ffacebook_logos%2ffacebook_logos_PNG19748.png&ehk=0ZiZ04ZZ6mSJ5oyPxBh1gy4FSYhegWTWyDpCiI73sbw%3d&risl=&pid=ImgRaw&r=0" alt="Facebook" style="width: 30px;">
            </a>
            <a href="https://www.youtube.com/channel/UC6ZAzgoSBsqPvYaGOhfZ8Lw">
                <img src="https://th.bing.com/th/id/OIP.OVUMFVp8elGfMYh-27fTLAHaFO?rs=1&pid=ImgDetMain" alt="YouTube" style="width: 30px;">
            </a>
            <a href="https://www.instagram.com/thienduong.baoson/?hl=en">
                <img src="https://png.pngtree.com/png-vector/20221018/ourmid/pngtree-instagram-social-platform-icon-png-image_6315976.png" alt="Instagram" style="width: 25px;"></a>
        </div>
        <a class="buy-ticket"><i class="fa-solid fa-cart-shopping"></i>
            <p>MUA VÉ</p> <span>0</span>
        </a>
        <div class="user-menu">
            <img src="https://th.bing.com/th/id/OIP.N_YBvMrwwjlxzOtw-UoHawAAAA?w=435&h=435&rs=1&pid=ImgDetMain" alt="User" style="width: 33px; margin-right: 5px;">
            <ul class="drop-item" style="position: absolute;">
                <li>
                    <a href="<?php echo _HOST_PATH_ ?>\clients\Cart?id=<?php
                                                                        $userId = getFlashData('userIdLogin');
                                                                        echo $userId;
                                                                        setFlashData('userIdLogin', $userId);
                                                                        ?>">Đơn vé
                    </a>
                </li>
                <li>
                    <a href="<?php echo _HOST_PATH_ ?>/auth/Logout?id=<?php
                                                                        $userId = getFlashData('userIdLogin');
                                                                        echo $userId;
                                                                        setFlashData('userIdLogin', $userId);
                                                                        ?>">Đăng xuất
                    </a>
                </li>
            </ul>
        </div>
        <div class="language">
            <img src="https://media.istockphoto.com/vectors/vietnamese-flag-vector-id864417828?k=6&m=864417828&s=612x612&w=0&h=AbGtQWE0vfKupO0Tpp8ga49MVZq4O2P7HIkIOUxl2rk=" alt="Vietnamese" style="width: 34px; margin-right: 5px;">
            <i class="fa-solid fa-caret-down"></i>
        </div>
    </div>
</div>