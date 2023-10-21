<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/'.explode('/', $_SERVER['PHP_SELF'])[1]."/config/const.php"); 
class JWT
{
    /**
     * Headers for JWT.
     *
     * @var array
     */
    private $headers;

    /**
     * Secret for JWT.
     *
     * @var string
     */
    private $secret;

    public function __construct()
    {
        $this->headers = [
            'alg' => 'HS256', // we are using a SHA256 algorithm
            'typ' => 'JWT', // JWT type
            'iss' => 'http://localhost/QuanLyTienLuong_PHP', // token issuer
            'aud' => 'dakhoathientrang.com' // token audience
        ];
        $this->secret = SECRET_KEY;
    }

    /**
     * Generate JWT using a payload.
     *
     * @param array $payload
     * @return string
     */
    public function generate(array $payload): string
    {
        $headers = $this->encode(json_encode($this->headers)); // encode headers
        $payload["exp"] = time() + 60; // add expiration to payload
        $payload = $this->encode(json_encode($payload)); // encode payload
        $signature = hash_hmac('SHA256', "$headers.$payload", $this->secret, true); // create SHA256 signature
        $signature = $this->encode($signature); // encode signature

        return "$headers.$payload.$signature";
    }

    /**
     * Encode JWT using base64.
     *
     * @param string $str
     * @return string
     */
    private function encode(string $str): string
    {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '='); // base64 encode string
    }

    /**
     * Check if JWT is valid, return true | false.
     *
     * @param string $jwt
     * @return int
     */
    public function is_valid(string $jwt): int
    {
        $token = explode('.', $jwt); // explode token based on JWT breaks
        if (!isset($token[1]) && !isset($token[2])) {
            echo "<script>console.log('Debug Objects: " . "fails if the header and payload is not set" . "' );</script>";
            return 0; // fails if the header and payload is not set
        }
        $headers = base64_decode($token[0]); // decode header, create variable
        $payload = base64_decode($token[1]); // decode payload, create variable
        $clientSignature = $token[2]; // create variable for signature

        if (!json_decode($payload)) {
            echo "<script>console.log('Debug Objects: " . "fails if payload does not decode" . "' );</script>";
            return 0; // fails if payload does not decode
        }

        if ((json_decode($payload)->exp - time()) < 0) {
            return -1; // fails if expiration is greater than 0, setup for 1 minute
        }

        if (isset(json_decode($payload)->iss)) {
            if (json_decode($headers)->iss != json_decode($payload)->iss) {
                echo "<script>console.log('Debug Objects: " . "fails if issuers are not the samee" . "' );</script>";
                return 0; // fails if issuers are not the same
            }
        } else {
            echo "<script>console.log('Debug Objects: " . "fails if issuer is not set " . "' );</script>";
            return 0; // fails if issuer is not set 
        }

        if (isset(json_decode($payload)->aud)) {
            if (json_decode($headers)->aud != json_decode($payload)->aud) {
                echo "<script>console.log('Debug Objects: " . "fails if audiences are not the same " . "' );</script>";
                return 0; // fails if audiences are not the same
            }
        } else {
            echo "<script>console.log('Debug Objects: " . "fails if audience is not set" . "' );</script>";
            return 0; // fails if audience is not set
        }

        $base64_header = $this->encode($headers);
        $base64_payload = $this->encode($payload);

        $signature = hash_hmac('SHA256', $base64_header . "." . $base64_payload, $this->secret, true);
        $base64_signature = $this->encode($signature);

        return $base64_signature === $clientSignature ?  1 : 0;
    }
}
