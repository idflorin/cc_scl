<?php 
if ($f == 'login') {
    $data_ = array();
    $phone = 0;
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = Wo_Secure($_POST['username']);
        $password = $_POST['password'];
        $result   = Wo_Login($username, $password);
        if ($result === false) {
            $errors[] = $error_icon . $wo['lang']['incorrect_username_or_password_label'];
        } else if (Wo_UserInactive($_POST['username']) === true) {
            $errors[] = $error_icon . $wo['lang']['account_disbaled_contanct_admin_label'];
        } else if (Wo_VerfiyIP($_POST['username']) === false) {
            $_SESSION['code_id'] = Wo_UserIdForLogin($username);
            $data_               = array(
                'status' => 600,
                'location' => Wo_SeoLink('index.php?link1=unusual-login')
            );
            $phone               = 1;
        } else if (Wo_TwoFactor($_POST['username']) === false) {
            $_SESSION['code_id'] = Wo_UserIdForLogin($username);
            $data_               = array(
                'status' => 600,
                'location' => $wo['config']['site_url'] . '/unusual-login?type=two-factor'
            );
            $phone               = 1;
        } else if (Wo_UserActive($_POST['username']) === false) {
            $_SESSION['code_id'] = Wo_UserIdForLogin($username);
            $data_               = array(
                'status' => 600,
                'location' => Wo_SeoLink('index.php?link1=user-activation')
            );
            $phone               = 1;
        }
        if (empty($errors) && $phone == 0) {
            $userid              = Wo_UserIdForLogin($username);
            $ip                  = Wo_Secure(get_ip_address());
            $update              = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `ip_address` = '{$ip}' WHERE `user_id` = '{$userid}'");
            $session             = Wo_CreateLoginSession(Wo_UserIdForLogin($username));
            $_SESSION['user_id'] = $session;
            setcookie("user_id", $session, time() + (10 * 365 * 24 * 60 * 60));
            setcookie('ad-con', htmlentities(serialize(array(
                'date' => date('Y-m-d'),
                'ads' => array()
            ))), time() + (10 * 365 * 24 * 60 * 60));
            $data = array(
                'status' => 200
            );
            if (!empty($_POST['last_url'])) {
                $data['location'] = $_POST['last_url'];
            } else {
                $data['location'] = $wo['config']['site_url'];
            }
        }
    }
    header("Content-type: application/json");
    if (!empty($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else if (!empty($data_)) {
        echo json_encode($data_);
    } else {
        echo json_encode($data);
    }
    exit();
}