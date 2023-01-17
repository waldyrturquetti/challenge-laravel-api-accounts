<?php

namespace App\Application\Address\VerifyCEP;

use App\Exceptions\ZipCodeInvalidException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Response as ResponseHttpStatus;

class VerifyCepAndFormatAddressHandle
{
    const URL_VIACEP = 'https://viacep.com.br/ws/CEP/json/';

    /**
     * @throws ZipCodeInvalidException
     * @throws GuzzleException
     */
    public function handle(string $zipCode): array
    {
        $client = new Client();
        $url = str_replace('CEP', $zipCode, self::URL_VIACEP);
        $response = $client->get($url);

        if ($response->getStatusCode() != ResponseHttpStatus::HTTP_OK) {
            throw new ZipCodeInvalidException();
        }

        $addressByRequest = json_decode($response->getBody(), true);

        return [
            'zip_code' => $addressByRequest['cep'],
            'street' => $addressByRequest['logradouro'],
            'complement' => $addressByRequest['complemento'],
            'neighborhood' => $addressByRequest['bairro'],
            'city' => $addressByRequest['localidade'],
            'uf' => $addressByRequest['uf']
        ];
    }
}
