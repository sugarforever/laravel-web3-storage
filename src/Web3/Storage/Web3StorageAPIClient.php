<?php

namespace Web3\Storage;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class Web3StorageAPIClient
{
    const DOMAIN = "https://api.web3.storage";

    public function getList($apiKey)
    {
        $response = Http::withHeaders([
            "Authorization" => $this->getAuthorizationHeaderValue($apiKey)
        ])->get(Web3StorageAPIClient::DOMAIN . "/user/uploads")->json();

        $stored_files = [];
        foreach ($response as $item) {
            $cid = $item["cid"];
            $ipfs_link = "https://ipfs.io/ipfs/{$cid}/";
            $stored_files[] = $ipfs_link;
        }

        return $stored_files;
    }

    public function upload($apiKey, $fileContent, $fileName)
    {
        $response = Http::withHeaders([
            "Authorization" => $this->getAuthorizationHeaderValue($apiKey)
        ])->attach("file", $fileContent, $fileName)
            ->post(Web3StorageAPIClient::DOMAIN . "/upload")
            ->json();

        $cid = Arr::get($response, "cid");
        $ipfs_link = "https://ipfs.io/ipfs/{$cid}/{$fileName}";
        return $ipfs_link;
    }

    private function getAuthorizationHeaderValue($apiKey)
    {
        return "Bearer " . $apiKey;
    }
}
