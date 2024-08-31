<?php

/**
 * Inquire Transfer Slip validity and details
 *
 * @param string  $clientId       Application Client ID
 * @param string  $clientSecret   Application Client Secret
 * @param string  $payload        Payload String from QR Code
 *
 * @return object|null Returns validity and details on successful, or null on failure
 */
function suba_inquiry($clientId, $clientSecret, $payload) {
  $ch = curl_init('https://suba.rdcw.co.th/v1/inquiry');

  curl_setopt($ch, CURLOPT_USERPWD, "{$clientId}:{$clientSecret}");
  curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['payload' => $payload]));
  curl_setopt($ch, CURLOPT_ENCODING, '');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $response = @json_decode(curl_exec($ch));
  curl_close($ch);

  if ($response && isset($response->valid)) {
    return $response;
  }

  return null;
}

?>

