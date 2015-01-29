<?php

/**
 * @author Jitendra Singh Bhadouria <jeetusb.singh@gmail.com>
 * @desc HTTP end point listens to the notifiction sent by the AWS SNS.
 */
/**
 * Whenever a HTTP end point register to the SNS, AWS SNS sends asubscription confirmation url.
 * This parses the subscription url and confirm subscription  by requeting back to it.
 */
if ($data->Type == 'SubscriptionConfirmation') {

    $url = $data->SubscribeURL;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
} else {
    /**
     * parse for spam notification.
     */
    $obj = json_decode($data->Message);
    $notificationType = $obj->{'notificationType'};
    $message_id = $obj->{'mail'}->{'messageId'};
    $problem_email = $obj->{'complaint'}->{'complainedRecipients'};
    $problem_email = $problem_email[0]->{'emailAddress'};

    if ($notificationType == 'Complaint') {
        /**
         * For Spam Notification
         * do your code here.
         */
    }
}
