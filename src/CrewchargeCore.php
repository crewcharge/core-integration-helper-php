<?php
namespace Crewcharge;
use \Exception as Exception;

define("CREWCHARGE_ENDPOINT", "https://app.crewcharge.com");

class CrewchargeCore
{
    /**
     * Attaches a new user with Crewcharge or modifies the existing user preferences.
     *
     * @param {String} api_key - Your API key within Crewcharge.
     *
     * @param {String} uid - Identifier of the user that can be a user id or email.
     *
     * @param {Object} attributes - Contains information about the user.
     * You can attach any attributes, but the needed ones are {@see recommended_user_attributes}
     *
     * @param {Boolean} test_user - Refers to whether the user must be attached as a test user within Crewcharge.
     *
     * @return {Object} Returns error or success message.
     *
     * 1. Error Example
     * {
     *     ok: false,
     *     error: "Invalid options"
     * }
     *
     * 2. Success Example
     *
     * {
     *     ok: true,
     *     message: "All good! 👍"
     * }
     *
     *
     */

    public static function attachUserAttributes(
        $api_key,
        $uid,
        $attributes,
        $test_user = false
    ) {
        $url = CREWCHARGE_ENDPOINT . "/api/v1/users/attach-attributes";

        try {
            $curl = curl_init();

            $payload = array("attributes"=>$attributes,
            "test_user"=>$test_user,
            "uid"=>$uid);


            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($payload),
                CURLOPT_HTTPHEADER => [
                    "api-key: $api_key",
                    "Content-Type: application/json",
                ],
            ]);

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
        } catch (Exception $e) {
            return "Caught exception:" + $e->getMessage();
        }
    }

    /**
         * Attaches a new user with Crewcharge or modifies the existing user preferences.
         *
         * @param {String} api_key - Your API key within Crewcharge.
         *
         * @param {String} uid - Identifier of the user that can be a user id or email.
         *
         * @param {Object} privacy_preferences - Refers to modifying user's preferences with collecting data
         * on analytics, email, feedback, sms, etc. Valid values are {@see valid_privacy_preferences}
         *
         * @return {Object} Returns error or success message.
         *
         * 1. Error Example
         * {
         *     ok: false,
         *     error: "Invalid privacy options"
         * }
         *
         * 2. Success Example
         *
         * {
         *     ok: true,
         *     message: "All good! 👍"
         * }
         *
         *
         */

        public static function changePrivacyPreferences(
            $api_key,
            $uid,
            $privacy_preferences,
        ) {
            $url = CREWCHARGE_ENDPOINT . "/api/v1/users/attach-attributes";

            try {
                $curl = curl_init();

                $payload = array(
                "privacy_preferences"=>$privacy_preferences,
                "uid"=>$uid);


                curl_setopt_array($curl, [
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($payload),
                    CURLOPT_HTTPHEADER => [
                        "api-key: $api_key",
                        "Content-Type: application/json",
                    ],
                ]);

                $response = curl_exec($curl);

                curl_close($curl);
                echo $response;
            } catch (Exception $e) {
                return "Caught exception:" + $e->getMessage();
            }
        }

    /**
    * @param analytics_tag is your tag obtained for this project.
    * @param uid pass the user id of your customer / email.
    * @param trigger_key the key you want to track (Obtain this from your Crewcharge Console)
    *
    * @return {Promise<Response|{ok: boolean, error: string}>}
    */
    public static function logTrigger($analytics_tag, $uid, $trigger_key)
    {
        $url = CREWCHARGE_ENDPOINT . "/api/v1/log";

        try {
            $curl = curl_init();

            $payload = array("analytics_tag"=>$analytics_tag, "uid"=>$uid, "trigger_key"=>$trigger_key);

            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS =>json_encode($payload),
                CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
            ]);

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
        } catch (Exception $e) {
            return "Caught exception:" + $e->getMessage();
        }
    }

}

?>
