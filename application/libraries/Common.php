<?php

/**
 * Format class
 *
 * Help convert between various formats such as XML, JSON, CSV, etc.
 *
 * @author  	Phil Sturgeon
 * @license		http://philsturgeon.co.uk/code/dbad-license
 */
class Common {

    public function android_push($token, $load, $key)
     {
        $key = 'AAAAOV5s2ng:APA91bHDOzpehQu_TGDaSntqwIX1xb-KrYkL6lai2OyYhhIkLw4SFXJuz83wKrYvZ3fMtLPtPLW2KhKmLu23dpcORVPq3FmwpgOt_ih6j9QZeLz1hqAUZzaHsZRfWS7V9e7blIDonLxl';
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' => $token,
            'notification' => $load
        );
        $headers = array(
            'Authorization: key=' . $key,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        
       //echo $result; die;
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

    public function Generate_hash($length) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' . rand(0, 99999);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

}

?>